<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Member;
use App\Models\GundamProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Barryvdh\DomPDF\Facade as PDF;
use PDF;

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

    public function api(Request $request) {
        if($request->status == '1' || $request->status == '0') {
            $transactions = Transaction::select('transactions.*', 'members.name', 'transaction_details.transaction_id', 'transaction_details.gundam_product_id', 'transaction_details.purchase_qty', 'gundam_products.price', 'gundam_products.product_name')
                                ->join('members', 'transactions.member_id', '=', 'members.id')
                                ->join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
                                ->join('gundam_products', 'transaction_details.gundam_product_id', '=', 'gundam_products.id')
                                // ->orderBy('transactions.id')
                                ->where('transactions.status', '=', $request->status)
                                ->groupBy('transactions.id')
                                ->get();
        } else if ($request->purchase_date) {
                $transactions = Transaction::select('transactions.*', 'members.name', 'transaction_details.transaction_id', 'transaction_details.gundam_product_id', 'transaction_details.purchase_qty', 'gundam_products.price', 'gundam_products.product_name')
                                    ->join('members', 'transactions.member_id', '=', 'members.id')
                                    ->join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
                                    ->join('gundam_products', 'transaction_details.gundam_product_id', '=', 'gundam_products.id')
                                    // ->orderBy('transactions.id')
                                    ->whereMonth('transactions.purchase_date', '=', $request->purchase_date)
                                    ->groupBy('transactions.id')
                                    ->get();
        } else {
            $transactions = Transaction::select('transactions.*', 'members.name', 'transaction_details.transaction_id', 'transaction_details.gundam_product_id', 'transaction_details.purchase_qty', 'gundam_products.price', 'gundam_products.product_name')
                                ->join('members', 'transactions.member_id', '=', 'members.id')
                                ->join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
                                ->join('gundam_products', 'transaction_details.gundam_product_id', '=', 'gundam_products.id')
                                // ->orderBy('transactions.id')
                                ->groupBy('transactions.id')
                                ->get();
        }


            
            $datatables = datatables()->of($transactions)
                                ->addColumn('show_price', function($transaction) {
                                    return change_currency($transaction->total_price);
                                })
                                ->addColumn('show_status', function($transaction) {
                                    return show_stat($transaction->status);
                                })
                                ->addColumn('show_purchase_date', function($transaction) {
                                    return convert_date($transaction->purchase_date);
                                })
                                ->addColumn('show_repayment_date', function($transaction) {
                                    return convert_date($transaction->repayment_date);
                                })
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
            'member_id' => $request->member_id,
            'total_price' => $request->total_price
        ]);

        $products = $request->gundam_product_id;
        $qtys = $request->purchase_qty;

        foreach($products as $key => $product) {
            TransactionDetail::create([
                'transaction_id' => $transactions->id,
                'gundam_product_id' => $product,
                'purchase_qty' => $qtys[$key],
            ]);

            DB::table('gundam_products')->where('id', '=', $product)->decrement('stock_qty', $qtys[$key]);
        }

        // $transDetails = TransactionDetail::create([
        //     'transaction_id' => $transactions->id,
        //     'gundam_product_id' => $request->gundam_product_id,
        //     'purchase_qty' => $request->purchase_qty,
        // ]);

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
        $products = GundamProduct::all();
        $transactions = Transaction::select('transactions.*', 'transaction_details.gundam_product_id', 'transaction_details.purchase_qty', 'members.name', 'gundam_products.product_name', 'gundam_products.price')
                                ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
                                ->join('members', 'transactions.member_id', '=', 'members.id')
                                ->join('gundam_products', 'transaction_details.gundam_product_id', '=', 'gundam_products.id')
                                ->where('transactions.id', '=', $id)
                                ->get();
        // return $transactions;
        return view('transaction.show', compact('products', 'transactions', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = GundamProduct::all();
        $transactions = Transaction::select('transactions.*', 'transaction_details.gundam_product_id', 'transaction_details.purchase_qty', 'members.name', 'gundam_products.product_name', 'gundam_products.price')
                                ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
                                ->join('members', 'transactions.member_id', '=', 'members.id')
                                ->join('gundam_products', 'transaction_details.gundam_product_id', '=', 'gundam_products.id')
                                ->where('transactions.id', '=', $id)
                                ->get();
        // return $transactions;
        return view ('transaction.edit', compact('transactions', 'products', 'id'));
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
        $this->validate($request, [
            'status' => 'required'
        ]);

        $transaction = Transaction::find($id);
        $transaction->status = $request->status;
        $transaction->update();

        return redirect('transactions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        $transaction->delete();

        return redirect('transactions');
    }

    // public function exportPdf($id) {
    //     $transactions = Transaction::select('transactions.*', 'transaction_details.gundam_product_id', 'transaction_details.purchase_qty', 'members.name', 'gundam_products.product_name', 'gundam_products.price')
    //                             ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
    //                             ->join('members', 'transactions.member_id', '=', 'members.id')
    //                             ->join('gundam_products', 'transaction_details.gundam_product_id', '=', 'gundam_products.id')
    //                             ->where('transactions.id', '=', $id)
    //                             ->get();

    //     $pdf = PDF::loadView('sample', compact('transactions'));
    //     // $pdf = PDF::loadView('transaction.show', [$products, $transactions]);
    //     return $pdf->download('invoice.pdf');
    // }

    // public function exportPdf() {
    //     $pdf = PDF::loadView('/show'); // <--- load your view into theDOM wrapper;
    //     $path = public_path('pdf_docs/'); // <--- folder to store the pdf documents into the server;
    //     $fileName =  time().'.'. 'pdf' ; // <--giving the random filename,
    //     $pdf->save($path . '/' . $fileName);
    //     $generated_pdf_link = url('pdf_docs/'.$fileName);
    //     return response()->json($generated_pdf_link);
    // }
}
