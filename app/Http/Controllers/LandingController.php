<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function landing() {
        $data['products'] = Products::all();
        return view('Landing.landing', $data);
    }
}
