<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\salesDetail;
use App\Models\sale;
use App\Models\member;
use App\Models\setting;

use Illuminate\Http\Request;

class SalesDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function data(string $id)
    {
        $salesDetail = SalesDetail::with('product')->where('sale_id', $id)->get();
        $data = array();
        $total = 0;
        $total_item = 0;
        
        foreach ($salesDetail as $key => $value) {
            $row = array();
            $row['DT_RowIndex']   = $key+1;
            $row['code']          = '<span class="badge text-bg-success">'.$value->product['code'].'</span>';
            $row['product_name']  = $value->product['name'];
            $row['discount']      = $value->product->discount.' %';
            $row['selling_price'] = money_format($value->selling_price, '.', 'Rp ', ',-');
            $row['sellingPrice']  = $value->selling_price;
            $row['Discount']      = $value->discount;
            $row['Qty']           = $value->qty;
            $row['item_qty']      = '<input type="number" min="1" name="item_qty'.$value->id.'" data-stock="'.$value->product->stock.'"  data-id="'.$value->id.'" data-discount="'.$value->product->discount.'" class="form-control input-sm edit-qty" value="'.$value->qty.'">';
            
            $hargatotal = $value->selling_price*$value->qty;
            $discount = ($value->product->discount/100)*$hargatotal;

            $row['subtotal']      = money_format($hargatotal-$discount, '.', 'Rp ', ',-');
            $row['action']        = '<div class="btn-group d-flex justify-content-around rounded" role="group" aria-label="Basic example">'.
                                        '<button data-id="'.$value->id.'" class="delete btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>'
                                    .'</div>';
            $data[] = $row;

            $total += $hargatotal-$discount;
            $total_item += $value->qty;
        }
        
        // return $data;
        return datatables()
                ->of($data)
                ->addIndexColumn()
                ->rawColumns(['action', 'code', 'item_qty'])
                ->make(true);
    }

    /**
     * Display a listing of the resource.
     */
    public function dataProduct()
    {
        $product = Product::orderBy('name')->where('stock', '>', 0)->get();
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
    public function dataMember()
    {
        $member = Member::orderBy('name')->get();
        return datatables()->of($member)
                ->addColumn('code_label', function ($member)
                {
                    return '<span class="badge bg-warning text-dark">'.$member->code.'</span>';
                })
                ->addColumn('action', function ($member)
                {
                    return 
                    '
                        <a href="#" data-id="'.$member->id.'" class="choseproduct btn btn-primary btn-xs btn-flat">
                            Pilih
                        </a>
                    ';
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'code_label'])
                ->make(true);
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
        $detail->discount = $product->discount;
        $detail->qty = 1;
        $detail->customer_money = 0;
        $detail->subtotal_prices = $detail->selling_price*$detail->qty;
        $detail->save();

        return response()->json('data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $sale = array($sale)[0];
        $code = null;
        if ($sale->member_id != null) {
            $member = Member::where('id', $sale->member_id)->get()[0];
            $code = $member->code;
        } else {
            $code = null;
        }
        $data = $arrayName = array(
            'member_code' => $code,
            'discount' => $sale->discount,
            'member_id' => $sale->member_id
        );
        return response()->json([
            'success' => true,
            'message' => 'Data updated',
            'data'    => $data  
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function memberUpdate(Request $request)
    {
        // ----------------get data--------------------
            $saleData = Sale::where('id', $request->selling_id)->get()[0];
            // return $saleData;
            $setting = Setting::get()[0];
        // --------------------------------------------
        // -----------------update---------------------
            if ($request->member_id == null) {
                $dataUpdate = array(
                    'member_id' => $request->member_id,
                    'discount' => 0,
                );
            } else {
                $dataUpdate = array(
                    'member_id' => $request->member_id,
                    'discount' => $setting->discount,
                );
            }
        // --------------------------------------------
        // -----------------update---------------------
            $saleData->update($dataUpdate);
        // --------------------------------------------
        return response()->json([
            'success' => true,
            'message' => 'Data updated',
            'data'    => $saleData  
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // ----------------get data--------------------
            $data = SalesDetail::where('id', $id)->get();
            $data = $data[0];
        // --------------------------------------------
        // ----------------counting--------------------
            $total = $data->selling_price*$request->qty;
            $hasil = $total-(($data->discount/100)*$total);
        // --------------------------------------------
        // ----------------valuasi---------------------
            $valuation = array(
                'qty' => $request->qty,
                'subtotal_prices' => $hasil
            );
        // --------------------------------------------
        // -----------------update---------------------
            $data->update($valuation);
        // --------------------------------------------
        return response()->json([
            'success' => true,
            'message' => 'Data updated',
            'data'    => $data  
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesDetail $salesDetail)
    {
        $salesDetail->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data deleted',
            'data'    => $salesDetail  
        ], 200);
    }
}
