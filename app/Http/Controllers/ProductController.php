<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
//        dd(Auth::user());

        if (!auth()->check()) {
            return back()->withErrors(['error' => 'Unauthorized! Please login.']);
        }
        // Validate the request
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'delivery_charge' => 'required|numeric',
            'color' => 'nullable|string|max:50',
            'size' => 'nullable|string|max:50',
            'required_advance' => 'required|string',
            'status' => 'required|string|in:active,inactive,out_of_stock,discontinued',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Fetch category
        $category = Category::find($validatedData['category_id']);
        if (!$category) {
            return back()->withErrors(['category_id' => 'Invalid category selected.']);
        }

        // Ensure 'created_by' is set
        $validatedData['created_by'] = auth()->id();
        $validatedData['category_name'] = $category->category_name;

        // Handle image upload and store the image in 'storage/app/public/products'
        if ($request->hasFile('product_image')) {
            // Store image and get the path
            $filePath = $request->file('product_image')->store('products', 'public');
            $validatedData['product_image'] = $filePath; // Save the file path to the database
        }

        try {
            Products::create($validatedData);
            return redirect()->route('product.create')->with('success', 'Product added successfully.');
        } catch (\Exception $exception) {
            Log::error('Product creation failed: ' . $exception->getMessage());
            return back()->withErrors(['error' => 'Something went wrong. ' . $exception->getMessage()]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = Products::findOrFail($id);
        $categories = Category::all(); // Fetch all categories for dropdown
        return view('admin.product.edit', compact('product', 'categories'));
    }


    public function update(Request $request, $id)
    {
        // Ensure user is authenticated
        if (!auth()->check()) {
            return back()->withErrors(['error' => 'Unauthorized! Please login.']);
        }

        // Validate the request
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'delivery_charge' => 'required|numeric',
            'color' => 'nullable|string|max:50',
            'size' => 'nullable|string|max:50',
            'required_advance' => 'required|string',
            'status' => 'required|string|in:active,inactive,out_of_stock,discontinued',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the product
        $product = Products::findOrFail($id);

        // Fetch category
        $category = Category::find($validatedData['category_id']);
        if (!$category) {
            return back()->withErrors(['category_id' => 'Invalid category selected.']);
        }

        // Assign updated values
        $validatedData['created_by'] = auth()->id();
        $validatedData['category_name'] = $category->category_name;

        // Handle image upload
        if ($request->hasFile('product_image')) {
            // Delete the old image if exists
            if ($product->product_image) {
                Storage::disk('public')->delete($product->product_image);
            }

            // Store new image
            $filePath = $request->file('product_image')->store('products', 'public');
            $validatedData['product_image'] = $filePath;
        }

        try {
            // Update product
            $product->update($validatedData);
            return redirect()->route('product.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $exception) {
            Log::error('Product update failed: ' . $exception->getMessage());
            return back()->withErrors(['error' => 'Something went wrong. ' . $exception->getMessage()]);
        }
    }

    public function destroy($id)
    {
        if (!auth()->check()) {
            return back()->withErrors(['error' => 'Unauthorized! Please login.']);
        }


        $product = Products::findOrFail($id);

        try {
            if ($product->product_image) {
                Storage::disk('public')->delete($product->product_image);
            }
            $product->delete();
            return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $exception) {
            Log::error('Product deletion failed: ' . $exception->getMessage());
            return back()->withErrors(['error' => 'Something went wrong. ' . $exception->getMessage()]);
        }
    }
}
