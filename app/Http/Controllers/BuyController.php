<?php

namespace App\Http\Controllers;

use App\DataTables\BuyDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateBuyRequest;
use App\Http\Requests\UpdateBuyRequest;
use App\Repositories\BuyRepository;
use App\Models\BuyProduct;
use App\Models\Product;
use App\Models\Cart;
use Flash;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use Response;

class BuyController extends AppBaseController
{
    /** @var  BuyRepository */
    private $buyRepository;

    public function __construct(BuyRepository $buyRepo)
    {
        $this->buyRepository = $buyRepo;
    }

    /**
     * Display a listing of the Buy.
     *
     * @param BuyDataTable $buyDataTable
     * @return Response
     */
    public function index(BuyDataTable $buyDataTable)
    {
        return $buyDataTable->render('buys.index');
    }

    /**
     * Store a newly created Buy in storage.
     *
     * @param CreateBuyRequest $request
     *
     * @return Response
     */
    public function store(CreateBuyRequest $request)
    {
        $input = $request->all();
        $buyInput["user_id"] = request()->user_id;
        $cart = Cart::where('user_id', $buyInput["user_id"])->first();
        $buyInput["is_delivered"] = false;
        $buyInput["total_value"] = 0;
        foreach($cart->products as $product => $quantity){
            $product_model = Product::find($product);
            $price = $product_model->price * $quantity;
            $buyInput["total_value"] += $price;
        }
        $buyInput["date"] = Carbon::now();

        $buy = $this->buyRepository->create($buyInput);

        foreach($cart->products as $product => $quantity){
            $product_model = Product::find($product);
            $buy_product_input["buy_id"] = $buy->id;
            $buy_product_input["product_id"] = $product;
            $buy_product_input["product_quantity"] = $quantity;
            $buy_product_input["product_price"] = $product_model->price;
            BuyProduct::create($buy_product_input);
            $product_model->stock -= $buy_product_input["product_quantity"];
            $product_model->save();
        }
        return response()->json([
            "buy" => true
        ], 200);
    }

    /**
     * Display the specified Buy.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $buy = $this->buyRepository->find($id);

        if (empty($buy)) {
            Flash::error('Compra não encontrada.');

            return redirect(route('buys.index'));
        }

        return view('buys.show')->with('buy', $buy);
    }

    public function deliver($id)
    {
        $buy = $this->buyRepository->find($id);
        $buy->is_delivered = true;
        $buy->save();
        return redirect(route('buys.delivered'));
    }
}
