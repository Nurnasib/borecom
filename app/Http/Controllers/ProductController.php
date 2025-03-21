<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('admin.product.list',['products'=>$products]);
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
            'status' => 'required|string|max:255',
            'stock' => 'nullable|integer', // Specified as 'integer' to match migration
            'description' => 'nullable', //
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products_images', 'public');
        }
        $additionalImages = [];
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $additionalImages[] = $image->store('products_images', 'public');
            }
        }
        $category = Category::where('id',$validatedData['category_id'])->first();
        $validatedData['category_name'] = $category->category_name;
        $validatedData['created_by'] = auth()->user()->id;
        $validatedData['image'] = $imagePath ?? null;
        $validatedData['additional_images'] = json_encode($additionalImages);

        try {
            Products::create($validatedData);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

        return redirect('admin/product')->with('success', 'Product created successfully!');
    }
    public function show($id)
    {
        $product = Products::where('id', $id)->first();
        return view('admin.product.detail',['product'=>$product]);
    }
    public function productDetail($id)
    {
        $product = Products::where('id', $id)->first();
        return view('product.detail',['product'=>$product]);
    }
    public function cartAddProduct($id)
    {
        $product = Products::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Get cart from session or initialize an empty array
        $cart = session()->get('cart', []);

        // If product exists in cart, remove it; otherwise, add it
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product removed from cart!');
        }
        $cart[$id] = [
            'id' => $product->id,
            'name' => $product->product_name,
            'price' => $product->price,
            'image' => $product->image,
            'quantity' => 1
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart!');
    }


    public function edit($id)
    {
        $product = Products::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
            'price' => 'required|integer',
            'delivery_charge' => 'required|integer|max:255',
            'required_advance' => 'required|string|max:255',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'nullable|integer',
            'description' => 'nullable|string|max:5000', //
        ]);

        $product = Products::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $additionalImages = $product->additional_images ? json_decode($product->additional_images, true) : [];
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $additionalImages[] = $image->store('products_images', 'public');
            }
        }
        $validatedData['additional_images'] = json_encode($additionalImages);

        $category = Category::find($validatedData['category_id']);
        $validatedData['category_name'] = $category ? $category->category_name : $product->category_name;

        $product->update($validatedData);

        return redirect('admin/product')->with('success', 'Product updated successfully!');
    }
}
