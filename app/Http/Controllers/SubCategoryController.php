<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::with('category')->latest()->paginate(10);
        return view('admin.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sub_category_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive',

        ]);

        SubCategory::create([
            'sub_category_name' => $request->sub_category_name,
            'category_id' => $request->category_id,
            'note' => $request->note,
            'status' => $request->status ?? 'active', // default fallback if empty
        ]);

        return redirect()->route('subcategories.index')->with('message', 'Sub-category created successfully.');
    }

    public function edit($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::all();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sub_category_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategory = SubCategory::findOrFail($id);
        $subcategory->update([
            'sub_category_name' => $request->sub_category_name,
            'category_id' => $request->category_id,
            'note' => $request->note,
            'status' => $request->status,

        ]);

        return redirect()->route('subcategories.index')->with('message', 'Sub-category updated successfully.');
    }

    public function destroy($id)
    {
        SubCategory::findOrFail($id)->delete();
        return redirect()->route('subcategories.index')->with('message', 'Sub-category deleted successfully.');
    }
}
