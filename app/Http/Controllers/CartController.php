<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Repositories\CartRepository;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CartController extends AppBaseController
{
    /** @var  CartRepository */
    private $cartRepository;

    public function __construct(CartRepository $cartRepo)
    {
        $this->cartRepository = $cartRepo;
    }

    /**
     * Store a newly created Cart in storage.
     *
     * @param CreateCartRequest $request
     *
     * @return Response
     */
    public function storeOrUpdate(CreateCartRequest $request)
    {
        $input = $request->all();
        $productArray = [
            $input["productId"] => intval($input["quantity"])
        ];

        $user_id = request()->user_id;
        $cart = Cart::where('user_id', $user_id)->first();
        if($cart == null){
            $product = Product::find($input["productId"]);
            $product->stock = $product->stock - $input["quantity"];
            $product->save();
            $cart_input['user_id'] = $user_id;
            $cart_input['products'] = $productArray;
            $cart = Cart::create($cart_input);
            if(!$cart){
                return response()->json([
                    "inserted" => false
                ], 200);
            }
            return response()->json([
                "inserted" => true
            ], 200);
        }

        if($input["type"] == "remove"){
            $product = Product::find($input["productId"]);
            $product->stock += $input["quantity"];
            $product->save();
            $key = array_search($input["productId"], $cart->products);
            unset($cart->products[$key]);
            if(!$cart->save()){
                return response()->json([
                    "inserted" => false
                ], 200);
            }
            return response()->json([
                "inserted" => true
            ], 200);
        }else{
            $product = Product::find($input["productId"]);
            $product->stock = $product->stock - $input["quantity"];
            $product->save();
            $first_key = array_key_first($productArray);
            $cart->products += [$first_key => $productArray[$first_key]];
            if(!$cart->save()){
                return response()->json([
                    "inserted" => false
                ], 200);
            }
            return response()->json([
                "inserted" => true
            ], 200);
        }

    }
}
