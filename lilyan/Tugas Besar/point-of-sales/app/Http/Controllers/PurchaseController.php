<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        $purchase = Purchase::all();
        return view('purchase.index', compact('supplier', 'purchase'));
    }

    public function api()
    {
        $purchase = Purchase::select('purchases.*', 'suppliers.name')
            ->join('suppliers', 'suppliers.id', '=', 'purchases.supplier_id')
            ->get();

        $datatables = datatables()->of($purchase)
        ->addColumn('total_item', function ($purchase) {
            return ($purchase->total_item);
        })
        ->addColumn('total_price', function ($purchase) {
            return currency_IDR($purchase->total_price);
        })
        ->addColumn('payment', function ($purchase) {
            return currency_IDR($purchase->payment);
        })
        ->editColumn('discount', function ($purchase) {
            return ($purchase->discount . ' %');
        })
        ->addColumn('tanggal', function ($purchase) {
            return format_tanggal($purchase->created_at, false);
        })
        ->addIndexColumn();
        
        return $datatables->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $purchase = new Purchase();
        $purchase->supplier_id = $id;
        $purchase->total_item  = 0;
        $purchase->total_price = 0;
        $purchase->discount    = 0;
        $purchase->payment     = 0;
        $purchase->save();

        session(['id' => $purchase->id]);
        session(['supplier_id' => $purchase->supplier_id]);

        return redirect()->route('purchase_details.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $purchase = Purchase::findOrFail($request->purchase_id);
        $purchase->total_item = $request->total_item;
        $purchase->total_price = $request->total;
        $purchase->discount = $request->discount;
        $purchase->payment = $request->payment;
        $purchase->update();

        $purchaseDetail = PurchaseDetail::where('purchase_id', $purchase->id)->get();
        foreach ($purchaseDetail as $item) {
            $product = Product::find($item->product_id);
            $product->stock += $item->amount;
            $product->update();
        }
        return redirect()->route('purchases.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $purchaseDetail = PurchaseDetail::select('purchase_details.*', 'products.product_code', 'products.name_product')
                                ->join('products', 'purchase_details.product_id', '=', 'products.id')
                                ->where('purchase_id', '=', $id)
                                ->get();
        
        // return $purchaseDetail;
        return view('purchase.show', compact('purchaseDetail'));

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
        $purchase = Purchase::find($id);
        $purchase->delete();


        return response(null, 204);
    }
}
