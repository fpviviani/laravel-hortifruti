<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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

    /**
     * Show the application cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function cartFront()
    {
        $user_id = request()->user_id;
        $cart = Cart::where('user_id', $user_id)->first();
        $products = [];
        foreach($cart->products as $product => $quantity){
            $product_model = Product::find($product);
            $product_array =
                [
                    "quantity" => $quantity,
                    "price" => $product_model->price * $quantity,
                    "name" => $product_model->name,
                    "photo" => $product_model->photo
                ];
            array_push($products, $product_array);
        }
        $logged = Auth::user();
        $client = User::find($user_id);
        if($logged->id != $user_id && $logged->name != "Super Admin"){
            $products = Product::where('stock', '>', 0)->get();
            return view('layouts.front_store')->with('products', $products);
        }else{
            return view('layouts.front_cart', compact($client, 'client'))->with('products', $products);
        }
    }
}
