<?php

namespace App\Http\Controllers;

use App\Models\PurchasingDetail;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PurchasingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchasing_id = session('id');
        $product = Product::orderBy('name')->get();
        $supplier = Supplier::find(session('id_supplier'));
        $method = session('method');
        $action = session('action');
        if (!$supplier) {
            abort(404);
        }
        return view('content.purchasingDetail.index', compact('purchasing_id', 'product', 'supplier', 'method', 'action'));
    }

    public function data($id)
    {
        $purchasingDetail = PurchasingDetail::with('product')->where('purchasing_id', $id)->get();
        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($purchasingDetail as $key => $value) {
            $row = array();
            $row['DT_RowIndex']   = $key+1;
            $row['code']          = '<span class="badge badge-success">'.$value->product['code'].'</span>';
            $row['product_name']  = $value->product['name'];
            $row['pricing_label'] = money_format($value->pricing_label, '.', 'Rp ', ',-');
            $row['item_qty']      = '<input type="number" min="1" name="item_qty'.$value->id.'" data-id="'.$value->id.'" class="form-control input-sm edit-qty" value="'.$value->item_qty.'">';
            $row['subtotal']      = money_format($value->subtotal, '.', 'Rp ', ',-');
            $row['action']        = '<div class="btn-group d-flex justify-content-around rounded" role="group" aria-label="Basic example">'.
                                        '<button onclick="deleteData(`'.route('purchasing_detail.destroy', $value->id).'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>'
                                    .'</div>';
            $data[] = $row;

            $total += $value->pricing_label * $value->item_qty;
            $total_item += $value->item_qty;
        }
        $data[] = [
            'code' => '
                <div class="total invisible">'. $total .'</div>
                <div class="total_item invisible">'. $total_item .'</div>',
            'product_name' => '',
            'pricing_label' => '',
            'item_qty' => '',
            'subtotal' => '',
            'action' => '',
        ];
        
        return datatables()
                ->of($data)
                ->addIndexColumn()
                ->rawColumns(['action', 'code', 'item_qty'])
                ->make(true);
        return datatables()
                ->of($purchasingDetail)
                ->addIndexColumn()
                ->addColumn('product_name', function ($purchasingDetail)
                {
                    return $purchasingDetail->product['name'];
                })
                ->addColumn('pricing_label', function ($purchasingDetail)
                {
                    return 'Rp. '.$purchasingDetail->pricing_label;
                })
                ->addColumn('item_qty', function ($purchasingDetail)
                {
                    return '<input type="number" min="1" name="item_qty'.$purchasingDetail->id.'" data-id="'.$purchasingDetail->id.'" class="form-control input-sm edit-qty" value="'.$purchasingDetail->item_qty.'">';
                })
                ->addColumn('subtotal', function ($purchasingDetail)
                {
                    return 'Rp. '.$purchasingDetail->subtotal;
                })
                ->addColumn('code', function ($purchasingDetail)
                {
                    return '<span class="badge badge-success">'.$purchasingDetail->product['code'].'</span>';
                })
                ->addColumn('action', function ($purchasingDetail)
                {
                    return 
                    '<div class="btn-group d-flex justify-content-around rounded" role="group" aria-label="Basic example">'.
                        '<button onclick="deleteData(`'.route('purchasing_detail.destroy', $purchasingDetail->id).'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>'
                    .'</div>';
                })->rawColumns(['action', 'code', 'item_qty'])
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

        $detail = new PurchasingDetail();
        $detail->purchasing_id = $request->purchasing_id;
        $detail->product_id = $request->id;
        $detail->pricing_label = $product->buying_price;
        $detail->item_qty = 1;
        $detail->subtotal = $product->buying_price*$detail->item_qty;
        $detail->save();

        return response()->json('data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchasingDetail $purchasingDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchasingDetail $purchasingDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $detail = PurchasingDetail::find($id);
        if ($request->item_qty == null) {
            $request->item_qty = 1;
        }
        $detail->item_qty = $request->item_qty;
        $detail->subtotal = $detail->pricing_label * $request->item_qty;
        $detail->update();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // return $id;
        $purchasingDetail = PurchasingDetail::find($id);
        $purchasingDetail->delete();

        return response()->json('Success updating data', 204);
    }

    public function loadForm(string $discount, string $total)
    {
        $total_payment = $total - ($discount/100 * $total);
        $data = [
            'total_price' => money_format($total, '.', 'Rp ', ',-'),
            'total_payment' => $total_payment,
            'total_payment_rp' => money_format($total_payment, '.', 'Rp ', ',-'),
            'read_money' => ucwords(terbilang($total_payment, ' Rupiah')),
        ];
        return response()->json($data);
    }
}
