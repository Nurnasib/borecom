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
            'required_advance' => 'required|string|max:255',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
            'stock' => 'nullable|integer', // Specified as 'integer' to match migration
            'description' => 'nullable', //
            'image' => 'required|image|max:2048',
            'additional_images.*' => 'image|max:2048',
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
//        return view('admin.product.detail',['product'=>$product]);
    }
    public function productDetail($id)
    {
        $d['product'] = Products::where('id', $id)->where('status', 'active')->first();
        $d['related_products'] = Products::where('category_id',$d['product']->category_id)->where('status', 'active')->limit(4)->get();
        return view('product.detail',$d);
    }
    public function cartBuyNowProduct(Request $request, $id)
    {
        $d = [];
        $subtotal = 0;
        if ($id==11111111){
            $cart = $request->cart;

            foreach ($cart as $value) {
                $subtotal += $value['price'] * $value['quantity'];
                $d[] = [
                    'product' => Products::find($value['product_id']) ?? null,
                    'price' => $value['price'] ?? 1,
                    'qty' => $value['quantity'] ?? 1,
                    'size' => $value['size'] ?? 'm',
                ];
            }
        }else{
            $subtotal += $request->price * $request->qty;
            $d[] = [
                'product' => Products::find($id),
                'price' => $request->price??1,
                'qty' => $request->qty??1,
                'size' => $request->size??'m'
            ];
        }

        session(['products' => $d, 'subtotal' => $subtotal]);
        return response()->json(['redirect' => '/checkout']);
//        return view('product.checkout',['products1'=>$d]);
    }






    public function cartAddProduct(Request $request, $id)
    {
        $product = Products::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $size = $request->size ?? 'm';
        $quantity = $request->qty ?? 1;

        // Get cart from session or initialize an empty array
        $cart = session()->get('cart', []);

        // Generate a unique key for this product with size
        $cartKey = $id.'_'.$size;

        // If product exists in cart, update quantity; otherwise, add it
        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            $cart[$cartKey] = [
                'id' => $product->id,
                'name' => $product->product_name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => $quantity,
                'size' => $size
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    public function edit($id)
    {
        $product = Products::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

//    public function update(Request $request, $id)
//    {
//        $validatedData = $request->validate([
//            'product_name' => 'required|string|max:255',
//            'category_id' => 'required|string|max:255',
//            'price' => 'required|integer',
//            'delivery_charge_in' => 'nullable|integer|max:255',
//            'delivery_charge_out' => 'nullable|integer|max:255',
//            'required_advance' => 'required|string|max:255',
//            'color' => 'nullable|string|max:255',
//            'size' => 'nullable|string|max:255',
//            'status' => 'required|string|max:255',
//            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//            'stock' => 'nullable|integer',
//            'description' => 'nullable|string|max:5000', //
//        ]);
//
//        $product = Products::findOrFail($id);
//
//        if ($request->hasFile('image')) {
//            $imagePath = $request->file('image')->store('products_images', 'public');
//            $validatedData['image'] = $imagePath;
//        }
//
//        $additionalImages = $product->additional_images ? json_decode($product->additional_images, true) : [];
//        if ($request->hasFile('additional_images')) {
//            foreach ($request->file('additional_images') as $image) {
//                $additionalImages[] = $image->store('products_images', 'public');
//            }
//        }
//        $validatedData['additional_images'] = json_encode($additionalImages);
//
//        $category = Category::find($validatedData['category_id']);
//        $validatedData['category_name'] = $category ? $category->category_name : $product->category_name;
//
//        $product->update($validatedData);
//
//        return redirect('admin/product')->with('success', 'Product updated successfully!');
//    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
            'price' => 'required|integer',
            'delivery_charge_in' => 'nullable|integer|max:255',
            'delivery_charge_out' => 'nullable|integer|max:255',
            'required_advance' => 'required|string|max:255',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'nullable|integer',
            'description' => 'nullable|string|max:5000',
        ]);

        $product = Products::findOrFail($id);

        // Handle main image update
        if ($request->hasFile('image')) {
            if ($product->image && \Storage::disk('public')->exists($product->image)) {
                \Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products_images', 'public');
            $validatedData['image'] = $imagePath;
        } else {
            $validatedData['image'] = $product->image;
        }

        // Handle additional images
        $additionalImages = $product->additional_images ? json_decode($product->additional_images, true) : [];

        // Check if any existing images are requested to be removed
        if ($request->filled('remove_additional_images')) {
            foreach ($request->remove_additional_images as $removeImage) {
                if (($key = array_search($removeImage, $additionalImages)) !== false) {
                    // Delete the image from storage
                    if (\Storage::disk('public')->exists($removeImage)) {
                        \Storage::disk('public')->delete($removeImage);
                    }
                    unset($additionalImages[$key]); // Remove from array
                }
            }
            $additionalImages = array_values($additionalImages); // Re-index array
        }

        // Add new uploaded additional images
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $additionalImages[] = $image->store('products_images', 'public');
            }
        }

        $validatedData['additional_images'] = json_encode($additionalImages);

        // Update category name
        $category = Category::find($validatedData['category_id']);
        $validatedData['category_name'] = $category ? $category->category_name : $product->category_name;

        // Update the product
        $product->update($validatedData);

        return redirect('admin/product')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Products::findOrFail($id);

        // Optionally delete associated images from storage (if needed)
        if (\Storage::disk('public')->exists($product->image)) {
            \Storage::disk('public')->delete($product->image);
        }

        if ($product->additional_images) {
            $additionalImages = json_decode($product->additional_images, true);
            foreach ($additionalImages as $image) {
                if (\Storage::disk('public')->exists($image)) {
                    \Storage::disk('public')->delete($image);
                }
            }
        }

        // Delete the product from the database
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }
    public function removeFromCart(Request $request)
    {
        $id = $request->input('id');
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'error' => 'Product not found in cart.']);
    }

}

