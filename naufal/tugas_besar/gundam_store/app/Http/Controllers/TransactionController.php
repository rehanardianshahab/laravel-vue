<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Member;
use App\Models\GundamProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaction.index');
    }

    public function api() {
        $transactions = Transaction::select('transactions.*', 'members.name', 'transaction_details.*', 'gundam_products.price', 'gundam_products.product_name')
                            ->join('members', 'transactions.member_id', '=', 'members.id')
                            ->join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
                            ->join('gundam_products', 'transaction_details.gundam_product_id', '=', 'gundam_products.id')
                            // ->orderBy('transactions.id')
                            ->groupBy('transactions.id')
                            ->get();
        
        $datatables = datatables()
                            ->of($transactions)
                            ->addIndexColumn();
        
        return $datatables->make(true);
    }

    public function dataCreate() {
        $products = GundamProduct::all();

        return response()->json($products);
    }

    public function dataPrice(Request $request) {
        $prices = GundamProduct::select('id', 'price')->get();

        return response()->json($prices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::find(Auth::user()->id);
        $date_today = date('d/m/Y');
        
        return view('transaction.create', compact('members', 'date_today'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'purchase_date' => 'required',
            'repayment_date' => 'required',
            'member_id' => 'required',
            'gundam_product_id' => 'required',
            'purchase_qty' => 'required',
            'total_price' => 'required'
        ]);

        $transactions = Transaction::create([
            'purchase_date' => $request->purchase_date,
            'repayment_date' => $request->repayment_date,
            'status' => 0,
            'member_id' => $request->member_id
        ]);

        $transDetails = TransactionDetail::create([
            'transaction_id' => $transactions->id,
            'gundam_product_id' => $request->gundam_product_id,
            'purchase_qty' => $request->purchase_qty,
            'total_price' => $request->total_price
        ]);

        return redirect('transactions');
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
}
