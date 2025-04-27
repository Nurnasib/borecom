<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Clients;
use App\Models\Orders;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Orders::with('payment')->get();
        return view('admin.order.list',['orders'=>$orders]);
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.add',['categories'=>$categories]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'qty' => 'required|integer',
            'address' => 'required|string',
            'phone' => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            $c['email'] = $request->email;
            $c['phone'] = $request->phone;
            $c['firstName'] = $request->f_name;
            $c['lastName'] = $request->l_name;

            $client = Clients::create($c);

            $validatedData['client_id'] = $client->id;
            $validatedData['order_code'] = 'AD' . rand(11111, 99999);
            $validatedData['color'] = $request->color;
            $validatedData['pieces'] = $request->pieces;
            $validatedData['weight'] = $request->weight;
            $validatedData['size'] = $request->size;
            $validatedData['address'] = $request->address;
            $validatedData['city'] = $request->city;
            $validatedData['email'] = $request->email;
            $validatedData['phone'] = $request->phone;
            $validatedData['f_name'] = $request->f_name;
            $validatedData['l_name'] = $request->l_name;

            $order = Orders::create($validatedData);

            $p['order_id'] = $order->id;
            $p['client_id'] = $client->id;
            $p['transactionId'] = $request->transactionId;
            $p['price'] = $request->price;
            $p['delivery_charge'] = $request->delivery_charge;
            $p['grand_total'] = $request->price * $request->qty;

            Payments::create($p);

            DB::commit();

            return redirect()->back()->with('success', 'Order created successfully!');

        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $exception->getMessage());
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
