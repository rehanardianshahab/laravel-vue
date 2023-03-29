<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SalesDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function datatable()
    {
        $sale = Sale::with('member')->orderBy('updated_at')->get();
        return datatables()->of($sale)
                ->addColumn('date', function ($sale)
                {
                    return tanggal_indonesia($sale->updated_at, false);
                })
                ->addColumn('sale', function ($sale)
                {
                    return money_format($sale->selling_price, '.', 'Rp ', ',-');
                })
                ->addColumn('member_code', function ($sale)
                {
                    if ($sale->member_id == null) {
                        $code = '-';
                    } else {
                        $code = $sale->member->code;
                    }
                    return $code;
                })
                ->editColumn('pricing_total', function ($sale)
                {
                    return money_format($sale->pricing_total, '.', 'Rp ', ',-');
                })
                ->editColumn('subtotal_prices', function ($sale)
                {
                    return money_format($sale->subtotal_prices, '.', 'Rp ', ',-');
                })
                ->editColumn('customer_money', function ($sale)
                {
                    return money_format($sale->customer_money, '.', 'Rp ', ',-');
                })
                ->editColumn('discount', function ($sale)
                {
                    return $sale->discount.'%';
                })
                ->editColumn('action', function ($sale)
                {
                    if ($sale->active == 1) {
                        return 
                        '<div class="btn-group d-flex justify-content-center">
                            <a href="#" data-total="'.$sale->total_item.'" data-iddelete="'.$sale->id.'" class="deleteData btn btn-xs btn-danger btn-flate p-1"> Delete </a>
                            <a href="#" data-idfinish="'.$sale->id.'" class="finishData btn btn-xs btn-warning btn-flate p-1"> Finish </a>
                        </div>';
                    } else {
                        return '<div class="btn-group d-flex justify-content-center">
                                    <a href="#" data-idsee="'.$sale->id.'" class="see btn btn-xs btn-info btn-flate p-1"><i class="bi bi-eye"></i> item </a>
                                </div>';
                    }
                })->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // return 'hai';
        $selling = new Sale();
        $selling->member_id = null;
        $selling->total_item = 0;
        $selling->pricing_total = 0;
        $selling->discount = 0;
        $selling->subtotal_prices = 0;
        $selling->customer_money = 0;
        $selling->active = true;
        $selling->user_id = Auth::id();
        // $user = auth('api')->user();
        //$user auth('sanctum')->check();
        // return Auth::check('sanctum');
        $selling->save();

        $saleNews = Sale::orderBy('id', 'desc')->get();;
        $saleNewst = $saleNews[0];

        return response()->json([
            'success' => true,
            'message' => 'saling Updated',
            'data'    => $saleNewst 
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Sale::where('id', $id)->get()[0];
        // return $data;
        $data->update($request->all());

        $detail = SalesDetail::where('sale_id', $id)->get();
        foreach ($detail as $key => $value) {
            $product = Product::find($value->product_id);
            $product->stock -= $value->qty;
            
            $product->update();
        }

        return response()->json([
            'success' => true,
            'message' => 'selling Updated',
            'data'    => $data 
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
