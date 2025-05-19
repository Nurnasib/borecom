<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Clients;
use App\Models\Orders;
use App\Models\Payments;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{

    public function index()
    {
        $orders = Orders::with(['payment', 'product','client'])->latest()->get();
        return view('admin.order.list', ['orders' => $orders]);
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.add',['categories'=>$categories]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string'
        ]);
        $products = session('products', []);
        $subtotal = session('subtotal', 0);

        try {
            DB::beginTransaction();

            $c['email'] = $request->email;
            $c['phone'] = $request->phone;
            $c['firstName'] = $request->f_name;
            $c['lastName'] = $request->l_name;

            $client = Clients::create($c);
            $validatedData['order_code'] = 'AD' . rand(11111, 99999);
            $validatedData['client_id'] = $client->id;
            foreach ($products as $product) {
                $order = Orders::create([
                    'product_id' => $product['product']['id'],
                    'qty' => $product['qty'],
                    'order_code' => $validatedData['order_code'],
                    'client_id' => $client->id,
                    'color' => $request->color,
                    'pieces' => $request->pieces,
                    'weight' => $request->weight,
                    'size' => $request->size,
                    'address' => $request->address,
                    'city' => $request->city,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'f_name' => $request->f_name,
                    'l_name' => $request->l_name,
                ]);
            }
            $p['order_code'] = $validatedData['order_code'];
            $p['client_id'] = $client->id;
            $p['transactionId'] = $request->transactionId;
            $p['price'] = $subtotal;
            if ($products[0]['product']['city']!='Dhaka'||$products[0]['product']['city']!='dhaka') {
                $p['delivery_charge'] = $products[0]['product']['delivery_charge_out'];
            }else{
                $p['delivery_charge'] = $products[0]['product']['delivery_charge_in'];
            }
            $p['grand_total'] = $subtotal+$request->delivery_charge;

            Payments::create($p);

            DB::commit();

            session()->forget('products');
            session()->forget('subtotal');

            return redirect()->route('orders.by.slug', ['slug' => $p['order_code']])->with('success', 'Order created successfully!');

        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find the order by ID
        $order = Orders::findOrFail($id);

        // Get all products for the dropdown
        $products = Products::all();

        // Return the edit view with order data and products
        return view('admin.order.edit', compact('order', 'products'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'f_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'transactionId' => 'required|string|max:255',
            'delivery_charge' => 'required|numeric',
            'qty' => 'required|numeric|min:1',
            'city' => 'required|string|max:255',
            'address' => 'required|string',
            'status' => 'required|string|in:pending,processing,shipped,out_for_delivery,completed,canceled,returned,refunded',
        ]);

        try {
            // Find the order by its ID
            $order = Orders::findOrFail($id);

            // Find the product by its ID
            $product = Products::find($request->input('product_id'));
            if (!$product) {
                return redirect()->back()->withErrors(['product_id' => 'Product not found.']);
            }

            // Update order details
            $order->product_id = $request->input('product_id');
            $order->f_name = $request->input('f_name');
            $order->qty = $request->input('qty');
            $order->city = $request->input('city');
            $order->address = $request->input('address');
            $order->status = $request->input('status');

            // Update payment details
            $order->payment->price = $request->input('price');
            $order->payment->transactionId = $request->input('transactionId');
            $order->payment->delivery_charge = $request->input('delivery_charge');

            // Save payment info
            $order->payment->save();

            // Save the order details
            $order->save();

            // Return a success message and redirect
            return redirect()->route('order.index')->with('message', 'Order updated successfully!');
        } catch (\Exception $e) {
            // Log any errors that occur
            return $e->getMessage() ;

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Find the order by its ID
            $order = Orders::findOrFail($id);

            // If the order has associated payment, delete it as well
            if ($order->payment) {
                $order->payment->delete();
            }

            // Delete the order
            $order->delete();

            // Redirect with success message
            return redirect()->route('order.index')->with('message', 'Order deleted successfully!');
        } catch (\Exception $e) {
            // Log any errors that occur
            \Log::error('Error deleting order: ', ['message' => $e->getMessage()]);

            // Redirect back with error message
            return redirect()->route('order.index')->withErrors(['error' => 'An error occurred while deleting the order. Please try again.']);
        }
    }


    public function updateStatus(Request $request, $id)
    {
        $order = Orders::findOrFail($id);

        // Validate the incoming request
        $request->validate([
            'status' => 'required|string|in:processing,cancelled,delivered,pending,placed',
        ]);

        // Update the order status
        $order->status = $request->status;
        $order->save();

        // Redirect back with a success message
        return redirect()->route('order.index')->with('message', 'Order status updated successfully!');
    }
    public function getOrdersBySlug(Request $request)
    {
        $orders = Orders::where('order_code', $request->slug)->with(['payment', 'product'])->get();
        return view('Landing.orders', ['orders' => $orders]);
    }
    public function getOrdersBySlugsss($slug)
    {
        $orders = Orders::where('order_code', $slug)->with(['payment', 'product'])->get();
        return view('Landing.orders', ['orders' => $orders]);
    }
}
