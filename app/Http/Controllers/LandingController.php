<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function landing() {
        $data['products'] = Products::where('status', 'active')->take(16)->get();
        $data['products_grouped'] = Products::where('status', 'active')->with('subCategory')->get()->groupBy('sub_category_id');
        return view('Landing.landing', $data);
    }
    public function loadMore(Request $request)
    {
        $offset = $request->offset ?? 0;
        $limit = 8;

        $products = Products::latest()->where('status', 'active')->skip($offset)->take($limit)->get();
        $totalProducts = Products::count();

        $html = view('Landing.products_card', compact('products'))->render();

        return response()->json([
            'html' => $html,
            'hasMore' => $totalProducts > ($offset + $limit),
        ]);
    }
}
