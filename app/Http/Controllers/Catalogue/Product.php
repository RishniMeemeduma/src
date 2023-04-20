<?php

namespace App\Http\Controllers\Catalogue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Product extends Controller
{
    public function index()
    {
        // dd(!empty(session()->get('cart')));
        return view('catalogue.index')
        ->with(['products'=> \App\Models\Product::all(), 'cart' => session()->get('cart')]);
    }


}
