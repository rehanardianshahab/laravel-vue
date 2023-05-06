<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Setting;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sale.index');
    }

    public function api()
    {
        $sale = Sale::with('members')->orderBy('id', 'desc')->get();

        // $dataMapping = [];
        // foreach($sale as $sales) {
        //     if($sales['members']) {
        //         $dataMapping[]['member_code'] = $sales->member_code;
        //     }
        // }

        $datatables = datatables()->of($sale)
        ->addColumn('total_item', function ($sale) {
            return ($sale->total_item);
        })
        ->addColumn('total_price', function ($sale) {
            return currency_IDR($sale->total_price);
        })
        ->addColumn('payment', function ($sale) {
            return currency_IDR($sale->payment);
        })
        ->addColumn('member_code', function ($sale) {
            $member = $sale->members->member_code ?? '';
            return $member;
        })
        ->addColumn('cash', function ($sale) {
            return currency_IDR($sale->cash);
        })
        ->addColumn('created_at', function ($sale) {
            return format_tanggal($sale->created_at, false);
        })
        ->editColumn('cashier', function ($sale) {
                return $sale->users->name ?? '';
            })
        ->addIndexColumn();
        
        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sale = new Sale();
        $sale->member_id = null;
        $sale->total_item = 0;
        $sale->total_price = 0;
        $sale->discount = 0;
        $sale->payment = 0;
        $sale->cash = 0;
        $sale->user_id = auth()->id();
        $sale->save();

        session(['id' => $sale->id]);
        return redirect()->route('sale_details.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $sale = Sale::findOrFail($request->sale_id);
        $sale->member_id = $request->member_id;
        $sale->total_item = $request->total_item;
        $sale->total_price = $request->total;
        $sale->discount = $request->discount;
        $sale->payment = $request->payment;
        $sale->cash = $request->cash;
        $sale->update();

        $saleDetail = SaleDetail::where('sale_id', $sale->id)->get();
        foreach ($saleDetail as $item) {
            $item->discount = $request->discount;
            $item->update();

            $product = Product::find($item->product_id);
            $product->stock -= $item->amount;
            $product->update();
        }
        return redirect()->route('sales.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saleDetail = SaleDetail::select('sale_details.*', 'products.product_code', 'products.name_product')
                                ->join('products', 'sale_details.product_id', '=', 'products.id')
                                ->where('sale_id', '=', $id)
                                ->get();
        
        // return $saleDetail;
        return view('sale.show', compact('saleDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function notaKecil()
    {
        $setting = Setting::first();
        // $sale = Sale::select('sales.*', 'members.member_code')
        //     ->join('members', 'members.id', '=', 'sales.member_id')
        //     ->get();
        // $saleDetail = SaleDetail::select('sale_details.*', 'products.product_code', 'products.name_product')
        //                         ->join('products', 'sale_details.product_id', '=', 'products.id')
        //                         ->where('sale_id', '=', $id)
        //                         ->get();
        $sale = Sale::find(session('id'));
        if (! $sale) {
            abort(404);
        }
        $saleDetail = SaleDetail::with('products')
            ->where('sale_id', session('id'))
            ->get();

        return view('sale.nota_kecil', compact('saleDetail', 'sale', 'setting'));
    }
}
