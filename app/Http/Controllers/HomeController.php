<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application store.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeFront()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('layouts.front_store')->with('products', $products);
    }
}
