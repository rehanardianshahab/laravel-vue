<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase = Purchase::select('purchases.*', 'suppliers.name')
            ->join('suppliers', 'suppliers.id', '=', 'purchases.supplier_id')
            ->get();
        // dd ($purchase);
        $supplier_id = session('supplier_id');
        $purchase_id = session('id');

        // dd ($supplier_id);
        
        $product = Product::all();
        $supplier = Supplier::where('id', $supplier_id)->get();
        
        // return session('id');
        if (! $supplier) {
            abort(404);
        }

        return view('purchase_detail.index', compact('supplier_id', 'product', 'supplier', 'purchase','purchase_id'));
    }

    public function api($id) 
    {
        // $purchaseDetail = PurchaseDetail::select('purchase_details.*', 'products.product_code', 'products.name_product')
        //     ->join('products', 'products.id', '=', 'purchase_details.product_id')
        //     ->get();
        $purchaseDetail = PurchaseDetail::with('products')
            ->where('purchase_id', $id)
            ->get();
        // return $purchaseDetail;
        
        $data = array();
        $total = 0;
        $total_item = 0;
        
        foreach ($purchaseDetail as $item)
        {
            $row = array();
            // $row['DT_RowIndex']     = $key+1;
            $row['product_code']    = '<span class="badge badge-success">'. $item->products['product_code'] .'</span>';
            $row['name_product']    = $item->products['name_product'];
            $row['purchase_price']  = currency_IDR($item->purchase_price);
            $row['amount']          = '<input type="number" class="form-control quantity" data-id="'. $item->id .'" 
                                      value="'. $item->amount .'">';
            $row['subtotal']        = currency_IDR($item->subtotal);
            $row['opsi']            = '<div class="text-center">
                                            <button onclick="deleteData(`'. route('purchase_details.destroy', $item->id) .'`)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                       </div>';
            $data[] = $row;

            $total += $item->purchase_price * $item->amount;
            $total_item += $item->amount;
        }

        $data[] = [
            'product_code' => '
                <div class="total hide">'. $total .'</div>
                <div class="total_item hide">'. $total_item .'</div>',
            'name_product'    => '',
            'purchase_price'  => '',
            'amount'          => '',
            'subtotal'        => '',
            'opsi'            => '',
        ];
        
        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['product_code','amount', 'opsi'])
            ->make(true);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PurchaseDetail $purchaseDetail)
    {
        $product = Product::where('id', $request->product_id)->first();
        if (! $product) {
            return response()->json('Data gagal disimpan!', 400);
        }

        $purchaseDetail = new PurchaseDetail();
        $purchaseDetail->purchase_id = $request->purchase_id;
        $purchaseDetail->product_id = $product->id;
        $purchaseDetail->purchase_price = $product->purchase_price;
        $purchaseDetail->amount = 1;
        $purchaseDetail->subtotal = $product->purchase_price;
        $purchaseDetail->save();

        return response()->json('Data berhasil disimpan!', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $purchaseDetail = PurchaseDetail::find($id);
        $purchaseDetail->amount = $request->amount;
        $purchaseDetail->subtotal = $purchaseDetail->purchase_price * $request->amount;
        $purchaseDetail->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchaseDetail = PurchaseDetail::find($id);
        $purchaseDetail->delete();


        return response(null, 204);
    }

    public function loadForm($discount, $total)
    {
        $payment = $total - ($discount / 100 * $total);
        $data  = [
            'totalrp' => currency_IDR($total),
            'payment' => $payment,
            'payrp' => currency_IDR($payment),
            'terbilang' => ucwords(terbilang($payment). ' Rupiah')
        ];

        return response()->json($data);
        // dd($discount, $total);
    }
}
