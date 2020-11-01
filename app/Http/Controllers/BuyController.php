<?php

namespace App\Http\Controllers;

use App\DataTables\BuyDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateBuyRequest;
use App\Http\Requests\UpdateBuyRequest;
use App\Repositories\BuyRepository;
use App\Models\BuyProduct;
use Flash;
use App\Http\Controllers\AppBaseController;
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
        $buy = $this->buyRepository->create($input);
        foreach($input["product_ids"] as $key => $product_id){
        $buy = $this->buyRepository->create($input);
            $buy_product_input["buy_id"] = $buy->id;
            $buy_product_input["product_id"] = $product_id;
            $buy_product_input["product_quantity"] = $input["product_quantities"][$key];
            $buy_product_input["product_price"] = $input["product_prices"][$key];
            BuyProduct::create($buy_product_input);
            $product = Product::find($product_id);
            $product->stock -= $buy_product_input["product_quantity"];
            $product->save();
        }

        Flash::success('Buy saved successfully.');

        return redirect(route('buys.index'));
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
            Flash::error('Buy not found');

            return redirect(route('buys.index'));
        }

        return view('buys.show')->with('buy', $buy);
    }
}
