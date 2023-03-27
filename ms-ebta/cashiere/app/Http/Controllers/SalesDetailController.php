<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\salesDetail;

use Illuminate\Http\Request;

class SalesDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function dataProduct()
    {
        $product = Product::orderBy('name')->get();
        return datatables()->of($product)
                ->editColumn('code', function ($product)
                {
                    return '<span class="badge bg-warning text-dark">'.$product->code.'</span>';
                })
                ->addColumn('sale', function ($product)
                {
                    return money_format($product->selling_price, '.', 'Rp ', ',-');
                })->editColumn('action', function ($product)
                {
                    return 
                    '
                        <a href="#" data-id="'.$product->id.'" class="choseProduct btn btn-primary btn-xs btn-flat">
                            Pilih
                        </a>
                    ';
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'code'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        if (! $product) {
            // abort(404);
            return response()->json('data gagal disimpan', 400);
        }

        $detail = new SalesDetail();
        $detail->sale_id = $request->selling_id;
        $detail->product_id = $request->id;
        $detail->selling_price = $product->selling_price;
        $detail->discount = 0;
        $detail->qty = 1;
        $detail->customer_money = 0;
        $detail->subtotal_prices = $detail->selling_price*$detail->qty;
        $detail->save();

        return response()->json('data berhasil disimpan', 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
