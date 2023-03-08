<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    
    public function index(Request $request)
    {
        if(auth()->user()->role('admin')) 
        {

            if ($request->status == '1' || $request->status == '0') {
                $transactions = Transaction::select('transactions.*', 'transaction_details.qty', 'members.name', 
                            DB::raw('count(transaction_details.book_id) as total_buku'), 
                            DB::raw('sum(transaction_details.qty*books.price) as total_harga'))
                            ->join('members', 'members.id', '=', 'transactions.member_id')
                            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
                            ->join('books', 'books.id', '=', 'transaction_details.book_id')
                            ->groupBy('transactions.id')
                            ->where('transactions.status', '=', $request->input('status'))
                            ->get();
            } else if ($request->date_start) {
                $transactions = Transaction::select('transactions.*', 'transaction_details.qty', 'members.name', 
                            DB::raw('count(transaction_details.book_id) as total_buku'), 
                            DB::raw('sum(transaction_details.qty*books.price) as total_harga'))
                            ->join('members', 'members.id', '=', 'transactions.member_id')
                            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
                            ->join('books', 'books.id', '=', 'transaction_details.book_id')
                            ->groupBy('transactions.id')
                            ->where('transactions.date_start', '=', $request->input('date_start'))
                            ->get();
            } else {
                $transactions = Transaction::select('transactions.*', 'transaction_details.qty', 'members.name', 
                            DB::raw('count(transaction_details.book_id) as total_buku'), 
                            DB::raw('sum(transaction_details.qty*books.price) as total_harga'))
                            ->join('members', 'members.id', '=', 'transactions.member_id')
                            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
                            ->join('books', 'books.id', '=', 'transaction_details.book_id')
                            ->groupBy('transactions.id')
                            ->get();
            }
                // return $transactions;
                // dd($transactions);

            return view('admin.transaction.index', compact('transactions'))->with('requestData',$request->status);

        } else {
            return abort('403');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::all();
        $books = Book::all();

        return view('admin.transaction.create', compact('members','books'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required', 
            'book_id' => 'required',
        ]);

              
        $transaction = Transaction::create([
            'member_id' => Request()->member_id,
            'date_start' => Request()->date_start,
            'date_end' => Request()->date_end,
            'status' => 0
        ]);

        $books = $request->book_id;

        foreach($books as $key => $book) {
            TransactionDetail::create([
                'book_id' => $book,
                'transaction_id' => $transaction->id,
                'qty' => 1,
            ]);

            DB::table('books')->where('id', '=', $book)->decrement('qty', 1);
        }
    //    dd($books);

        return redirect('transactions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::with('transaction_details')->find($id);
        $members = Member::all();
        $transactionDetails = TransactionDetail::select('*')->where('transaction_id', '=', $id)
                            ->join('books','books.id','=','transaction_details.book_id')
                            ->get();
        $books = Book::all();

        return view('admin.transaction.show', compact('transaction','members','transactionDetails','books'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $members = Member::all();
        $books = Book::all();
        $id = $transaction->id;
        $transactionDetails = TransactionDetail::select('*')->where('transaction_id', '=', $id)
                            ->join('books','books.id','=','transaction_details.book_id')
                            ->get();

        // return $transactionDetails;
        return view('admin.transaction.edit', compact('transaction','members','books','transactionDetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        // dd($request);
        $request->validate([
            'member_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required', 
            'book_id' => 'required',
            'status' => 'required',
        ]);

        $id = $transaction->id;
        
        $transaction = DB::table('transactions')
                        ->where('id', $id)
                        ->update([
                            'member_id' => $request->member_id,
                            'date_start' => $request->date_start, 
                            'date_end' => $request->date_end,
                            'status' => $request->status,
                        ]);           

        $Delete = TransactionDetail::where('transaction_id', $id)->delete();
                        
            foreach($request->book_id as $value){
                if($request->status == 1) {
                    DB::table('books')->where('id', $value)->increment('qty', 1);
                } else{
                    DB::table('books')->where('id', $value)->decrement('qty', 1);
                }
                $transdetails  = TransactionDetail::create([
                    'book_id' => $value,
                    'qty' => 1,
                    'transaction_id' => $id,
                ]);
            }
                        
        

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
        
        return redirect('transactions')->with('status', 'Data Berhasil Di Hapus !!!');
    }
}
