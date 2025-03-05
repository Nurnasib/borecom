<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Orders::all();
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
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
            'price' => 'required|integer',
            'delivery_charge' => 'required|integer|max:255',
            'required_advance' => 'required|string|max:255',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'status' => 'required|string|max:255'
        ]);
        $category = Category::where('id',$validatedData['category_id'])->first();
        $validatedData['category_name'] = $category->category_name;
        $validatedData['created_by'] = auth()->user()->id;

        try {
            Products::create($validatedData);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

        return redirect('admin/product')->with('success', 'Product created successfully!');
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
