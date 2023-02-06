<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $transactions = Transaction::all();

        return view ('admin.transaction.index', compact('transactions'));     
    
    //     $transactions = Transaction::selectRaw('transactions.id, transactions.member_id, transactions.date_start, transactions.date_end, transactions.status, members.name, transaction_details.qty as total_buku, transaction_details.qty*books.price as total_bayar')
    //         ->join('transaction_details','transactions.id','=','transaction_details.transaction_id')
    //         ->join('members','members.id','=','transactions.member_id')
    //         ->join('books', 'books.id','=','transaction_details.book_id')
    //         ->get();     

    //     // dd($transactions);
  
    //    return view ('admin.transaction.index', compact('transactions'));
    }

    public function api(Request $request)
    {
        if ($request->status == '1' || $request->status == '0') {
                      
            $transactions = Transaction::selectRaw('transactions.id, transactions.member_id, transactions.date_start, transactions.date_end, transactions.status, members.name, transaction_details.qty as total_buku, transaction_details.qty*books.price as total_bayar')
                ->join('transaction_details','transactions.id','=','transaction_details.transaction_id')
                ->join('members','members.id','=','transactions.member_id')
                ->join('books', 'books.id','=','transaction_details.book_id')
                ->where('status', $request->status)
                ->get();
                
        } elseif ($request->date_start ) {
           $transactions = Transaction::selectRaw('transactions.id, transactions.member_id, transactions.date_start, transactions.date_end, transactions.status, members.name, transaction_details.qty as total_buku, transaction_details.qty*books.price as total_bayar')
                ->join('transaction_details','transactions.id','=','transaction_details.transaction_id')
                ->join('members','members.id','=','transactions.member_id')
                ->join('books', 'books.id','=','transaction_details.book_id')
                ->where('date_start','=', $request->date_start)
                ->get();
        } else {
            $transactions = Transaction::selectRaw('transactions.id, transactions.member_id, transactions.date_start, transactions.date_end, transactions.status, members.name, transaction_details.qty as total_buku, transaction_details.qty*books.price as total_bayar')
                ->join('transaction_details','transactions.id','=','transaction_details.transaction_id')
                ->join('members','members.id','=','transactions.member_id')
                ->join('books', 'books.id','=','transaction_details.book_id')
                ->get();
        }
        // print_r($transactions);

        $datatables = datatables()->of($transactions)
                                ->addColumn('durasi', function($transaction) {
                                return lama_pinjam($transaction->date_start, $transaction->date_end);
                                 })
                                ->addColumn('status', function($transaction) {
                                return status($transaction->status);
                                 })
                                 ->addColumn('total_bayar', function($transaction) {
                                    return numberWithSpaces($transaction->total_bayar);
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
        $transactions = Transaction::all();
        $tranDetails = TransactionDetail::all();
        $books = Book::all();
        $members = Member::all();
      
        return view ('admin.transaction.create', compact('transactions','books', 'tranDetails','members'));
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
            'member_id' => 'required',
            'date_start' => 'required|date', 
            'date_end' => 'required|date', 
            'book_id' => 'required',
            'status' => 'required',
        ]);

        $transaction = Transaction::create([
            'member_id' => $request->member_id,
            'date_start' => $request->date_start, 
            'date_end' => $request->date_end,
            'status' => $request->status, 
        ]);

        $books = $request->book_id;

        foreach($books as $key => $book) {
            TransactionDetail::create([
                'book_id' => $request->$book,
                'transaction_id' => $transaction->id,
                'qty' => 1,              
            ]);  
        }

        return redirect('transactions');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id, Transaction $transaction)
    {
        $transaction = Transaction::find($id);
        $members = Member::all();
        $tranDetails = TransactionDetail::select('*')->where('transaction_id', $id)->get();
        $books = Book::all();

        return view ('admin.transaction.show')
                    ->with('transaction', $transaction)
                    ->with('members', $members)
                    ->with('tranDetails', $tranDetails)
                    ->with('books', $books);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Transaction $transaction)
    {
        
        $transaction = Transaction::find($id);
        $members = Member::all();
        $books = Book::all();
        $tranDetails = TransactionDetail::select('*')->where('transaction_id', $id)->get();
        
        return view ('admin.transaction.edit')
                    ->with('transaction', $transaction)
                    ->with('members', $members)
                    ->with('tranDetails', $tranDetails)
                    ->with('books', $books);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Transaction $transaction)
    {
        $this->validate($request,[
            'member_id' => 'required',
            'date_start' => 'required|date', 
            'date_end' => 'required|date', 
            'book_id' => 'required',
            'status' => 'required',
        ]);


        $transaction = DB::table('transactions')
                        ->where('id', $id)
                        ->update([
                            'member_id' => $request->member_id,
                            'date_start' => $request->date_start, 
                            'date_end' => $request->date_end,
                            'status' => $request->status,
                        ]);
     
                     
        $tranDetails = DB::table('transaction_details')
                        ->update([
                            'book_id' => $request->book_id,
                            'transaction_id' => $id,
                            'qty'=> 1,
                        ]);     
        
        return redirect('transactions');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect('transactions');
    }
}
