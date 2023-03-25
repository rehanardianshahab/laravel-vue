<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\PurchasingDetail;
use App\Models\Product;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::orderBy("name")->get();

        return view("content.purchase.index", compact("supplier"));
    }

    public function dataSupplier()
    {
        $supplier = Supplier::orderBy("name")->get();

        return response()->json([
            'success' => true,
            'data'    => $supplier
        ], 201);
    }

    public function data()
    {
        $purchasing = Purchase::orderBy('id', 'desc')->with('supplier')->get();
        $purchasing->sesi = true;
        foreach ($purchasing as $key => $value) {
            if ((Session::has('id'))) {
                $value['sesi'] = 1;
            } else {
                $value['sesi'] = 0;
            }
        }
        // return $purchasing;
        return datatables()
                ->of($purchasing)
                ->addIndexColumn()
                ->addColumn('date', function ($purchasing)
                {
                    return tanggal_indonesia($purchasing->created_at, false);
                })
                ->editColumn('supplier', function ($purchasing)
                {
                    return $purchasing->supplier->name;
                })
                ->editColumn('total_price', function ($purchasing)
                {
                    return money_format($purchasing->total_price, '.', 'Rp ', ',-');  
                })
                ->editColumn('total_payment', function ($purchasing)
                {
                    return money_format($purchasing->total_payment, '.', 'Rp ', ',-');  
                })
                ->editColumn('discount', function ($purchasing)
                {
                    return $purchasing->discount."%";
                })
                ->addColumn('action', function ($purchasing)
                {
                    return 
                    '<div class="btn-group">
                        <button onclick="deleteData()" class="btn btn-xs btn-danger btn-flate p-1"><i class="fa fa-trash"></i> Delete </button>
                        <button onclick="detilData()" class="btn btn-xs btn-info btn-flate p-1"><i class="fa fa-eye"></i> Item </button>
                    </div>';
                })->rawColumns(['action'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // return $id;
        $purchasing = new Purchase();
        $purchasing->supplier_id   = $id;
        $purchasing->total_items   = 0;
        $purchasing->total_price   = 0;
        $purchasing->discount      = 0;
        $purchasing->total_payment = 0;
        $purchasing->save();

        Session::put('id', 'id_supplier');

        $purchaseNews = Purchase::latest()->get();;
        $purchaseNews_id = $purchaseNews[0]->id;

        session(['id' => $purchaseNews_id]);
        session(['id_supplier' => $purchasing->supplier_id]);
        // return session('id');
        // return session('id');
        return response()->json([
            'success' => true,
            'message' => 'Purchasing Updated',
            'data'    => $purchasing  
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $purchase = Purchase::findOrFail($request->id);
        $purchase->total_items = $request->total_item;
        $purchase->total_price = $request->total_payment;
        $purchase->total_payment = $request->bayar;
        $purchase->discount = $request->discount;
        $purchase->update();
        // return $purchase;
        // return $request;

        $detail = PurchasingDetail::where('purchasing_id', $purchase->id)->get();
        foreach ($detail as $key => $value) {
            $product = Product::find($value->product_id);
            $product->stock += $value->item_qty;
            $product->update();
        }

        Session::forget(['id', 'id_supplier']);
        // return $product;
        return redirect()->route('purchase.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        // $detail = PurchasingDetail::where('purchasing_id', $purchase->id)->get();
        $detail = PurchasingDetail::with('product')->where('purchasing_id', $purchase->id)
                                    ->join('purchases', 'purchasing_details.purchasing_id', '=', 'purchases.id')
                                    ->get();
        // return $purchase;
        return datatables()
        ->of($detail)
        ->addIndexColumn()
        ->addColumn('code', function ($purchasing)
        {
            return '<span class="badge badge-success">'.$purchasing->product['code'].'</span>';
        })
        ->editColumn('pricing_label', function ($purchasing)
        {
            return money_format($purchasing->pricing_label, '.', 'Rp ', ',-');
        })
        ->editColumn('subtotal', function ($purchasing)
        {
            return money_format($purchasing->subtotal, '.', 'Rp ', ',-');
        })
        ->editColumn('name', function ($purchasing)
        {
            return $purchasing->product['name'];
        })
        ->rawColumns(['code'])
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        $purchase->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return response(null, 204);
    }
}
