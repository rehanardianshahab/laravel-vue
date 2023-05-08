<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Setting;
use Illuminate\Http\Request;

class SaleDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $product = Product::all();
        $product = Product::where('stock', '>', 0)->get();
        $member = Member::all();
        $discount = Setting::first()->discount ?? 0;
        $sale_id = session('id');

        return view('sale_detail.index', compact('product', 'member', 'sale_id', 'discount'));
    }

    public function api($id) 
    {
        $saleDetail = SaleDetail::with('products')
            ->where('sale_id', $id)
            ->get();
        // return $saleDetail;
        
        $data = array();
        $total = 0;
        $total_item = 0;
        
        foreach ($saleDetail as $item)
        {
            $row = array();
            $row['product_code']    = '<span class="badge badge-success">'. $item->products['product_code'] .'</span>';
            $row['name_product']    = $item->products['name_product'];
            $row['selling_price']   = currency_IDR($item->selling_price);
            $row['amount']          = '<input type="number" class="form-control quantity" data-id="'. $item->id .'" 
                                      value="'. $item->amount .'">';
            $row['subtotal']        = currency_IDR($item->subtotal);
            $row['opsi']            = '<div class="text-center">
                                            <button onclick="deleteData(`'. route('sale_details.destroy', $item->id) .'`)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                       </div>';
            $data[] = $row;

            $total += $item->selling_price * $item->amount;
            $total_item += $item->amount;
        }

        $data[] = [
            'product_code' => '
                <div class="total hide">'. $total .'</div>
                <div class="total_item hide">'. $total_item .'</div>',
            'name_product'    => '',
            'selling_price'   => '',
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
        $product = Product::where('id', $request->product_id)->first();
        if (! $product) {
            return response()->json('Data gagal disimpan!', 400);
        }

        $saleDetail = new SaleDetail();
        $saleDetail->sale_id = $request->sale_id;
        $saleDetail->product_id = $product->id;
        $saleDetail->selling_price = $product->selling_price;
        $saleDetail->amount = 1;
        $saleDetail->discount = 0;
        $saleDetail->subtotal = $product->selling_price;
        $saleDetail->save();

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
        $saleDetail = SaleDetail::find($id);
        $saleDetail->amount = $request->amount;
        $saleDetail->subtotal = $saleDetail->selling_price * $request->amount;
        $saleDetail->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $saleDetail = SaleDetail::find($id);
        $saleDetail->delete();


        return response(null, 204);
    }

    public function loadForm($discount = 0, $total, $cash)
    {
        $payment = $total - ($discount / 100 * $total);
        $change = ($cash != 0) ? $cash - $payment : 0;
        $data  = [
            'totalrp' => currency_IDR($total),
            'payment' => $payment,
            'payrp' => currency_IDR($payment),
            'terbilang' => ucwords(terbilang($payment). ' Rupiah'),
            'changerp' => currency_IDR($change),
            'change_terbilang' => ucwords(terbilang($change). ' Rupiah'),
        ];

        return response()->json($data);
        // dd($discount, $total);
    }
}
