<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role('admin')) {
            $transactions = Transaction::with('transaction_detail')->get();
    
            return view('admin.transaction.index', compact('transactions'));
        } else {
            return abort('403');
        }
    }

    public function api(Request $request) {
        
        if ($request->status == '1' || $request->status == '0') {
            $transactions = Transaction::select('transactions.*', 'transaction_details.trans_qty', 'members.name', DB::raw('COUNT(transaction_details.book_id) as total_books'), DB::raw('SUM(transaction_details.trans_qty*books.price) as total_prices'))
                        ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
                        ->join('members', 'members.id', '=', 'transactions.member_id')
                        ->join('books', 'books.id', '=', 'transaction_details.book_id')
                        ->groupBy('transactions.id')
                        ->where('transactions.status', '=', $request->status)
                        ->get();
        } else if ($request->date_start) {
            $transactions = Transaction::select('transactions.*', 'transaction_details.trans_qty', 'members.name', DB::raw('COUNT(transaction_details.book_id) as total_books'), DB::raw('SUM(transaction_details.trans_qty*books.price) as total_prices'))
                        ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
                        ->join('members', 'members.id', '=', 'transactions.member_id')
                        ->join('books', 'books.id', '=', 'transaction_details.book_id')
                        ->groupBy('transactions.id')
                        ->whereMonth('date_start', '=', $request->date_start)
                        ->get();
        } else {
            $transactions = Transaction::select('transactions.*', 'transaction_details.trans_qty', 'members.name', DB::raw('COUNT(transaction_details.book_id) as total_books'), DB::raw('SUM(transaction_details.trans_qty*books.price) as total_prices'))
                        ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
                        ->join('members', 'members.id', '=', 'transactions.member_id')
                        ->join('books', 'books.id', '=', 'transaction_details.book_id')
                        ->groupBy('transactions.id')
                        ->get();
        }

        // $transactions = Transaction::select('transactions.*', 'transaction_details.trans_qty', 'members.name', DB::raw('COUNT(transaction_details.book_id) as total_books'), DB::raw('SUM(transaction_details.trans_qty*books.price) as total_prices'))
        //                 ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
        //                 ->join('members', 'members.id', '=', 'transactions.member_id')
        //                 ->join('books', 'books.id', '=', 'transaction_details.book_id')
        //                 ->groupBy('transactions.id')
        //                 ->get();

        $datatables = datatables()->of($transactions)
                            ->addColumn('rent_durations', function($transaction) {
                                return count_days($transaction->date_start, $transaction->date_end);
                            })
                            ->addColumn('show_status', function($transaction) {
                                return show_stat($transaction->status);
                            })
                            ->addColumn('show_price', function($transaction) {
                                return change_currency($transaction->total_prices);
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
        $members = Member::all();
        $books = Book::all();
        return view('admin.transaction.create', compact('members', 'books'));
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
            'date_start' => 'required',
            'date_end' => 'required',
            'book_id' => 'required'
        ]);

        $books = $request->book_id;

        $transaction = Transaction::create([
            'member_id' => $request->member_id,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'status' => 0
        ]);

        foreach($books as $key => $value) {
            TransactionDetail::create([
                'book_id' => $value,
                'trans_qty' => 1,
                'transaction_id' => $transaction->id,
            ]);

            DB::table('books')->where('id', '=', $value)->decrement('qty', 1);
        }

        return redirect('transactions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $id = $transaction->id;
        $transaction_details = TransactionDetail::select('*')->where('transaction_id', '=', $id)->get();

        $members = Member::select('id','name')->where('id', '=', $transaction->member_id)->get();
        foreach($members as $keyMem => $memb) {
            $member = $memb;
        }

        $books = Book::select('id','title')->get();
        // return $transaction;
        return view ('admin.transaction.show', compact('transaction', 'transaction_details', 'member', 'books'));
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
        $transDetails = TransactionDetail::select('*')->where('transaction_id', '=', $id)->get();
        
        $transDetailIds = [];
        foreach($transDetails as $key => $transDetail) {
            $transDetailIds[] = $transDetail->id; 
        }
        
        return view ('admin.transaction.edit', compact('transaction', 'members', 'books', 'transDetails', 'transDetailIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, TransactionDetail $transaction_details)
    {
        $this->validate($request, [
            'member_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'book_id' => 'required',
            'status' => 'required'
        ]);

        $transaction_details = TransactionDetail::select('*')->where('transaction_id', '=', $id)->get();
        $dataID = [];
        foreach($transaction_details as $keyData => $databaseID) {
            $dataID[] = $databaseID->id;
        }

        $books = $request->book_id;
        $transIds = $request->id;

        $transaction = DB::table('transactions')
                        ->where('id', $id)
                        ->update([
                            'member_id' => $request['member_id'],
                            'date_start' => $request['date_start'],
                            'date_end' => $request['date_end'],
                            'status' => $request['status']
                        ]);

        // foreach($transaction_details as $transKey => $transaction_detail) {
        //     foreach($books as $key => $value) {
        //         TransactionDetail::where('id', $transaction_detail->id)
        //             ->where('transaction_id', $id)
        //             ->update([
        //                 'book_id' => $value,
        //                 'trans_qty' => 1,
        //                 'transaction_id' => $id,
        //         ]);
        //     }
        // }

        foreach($transIds as $keyID => $transID) {
            $delTrans = TransactionDetail::find($transID);
            $delTrans->delete();
        }

        foreach($books as $key => $value) {
            $updateTrans = TransactionDetail::create([
                'book_id' => $value,
                'trans_qty' => 1,
                'transaction_id' => $id,
            ]);

            if($request->status == 1) {
                DB::table('books')->where('id', $value)->increment('qty', 1);
            }
        }
        
        return redirect('transactions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        $transaction->delete();

        return redirect('transactions');
    }
}
