<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use DB;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function api()
    {
        $transaction = Transaction::select('transactions.*', 'members.name', /*'transaction_details.status', 'transaction_details.qty_pinjam'*/)
                        ->leftJoin("members", "transactions.member_id", "=", "members.id")
                        // ->leftJoin("books", "transaction_details.book_id", "=", "books.id")
                        ->leftJoin("transaction_details", "transactions.id", "=", "transaction_details.transaction_id")
                        ->groupBy("transactions.id")
                        ->orderBy('transactions.id')
                        ->get();
        
        // return $transaction;

        $dateend = TransactionDetail::query()->orderBy('transaction_id')->get();
        $jumlah = DB::table("transaction_details")
                    ->select("transaction_id", DB::raw('sum(qty_pinjam) as total'))
                    ->groupBy("transaction_id")
                    ->get();

        // return $dateend;
        $datum = array();
        $tanggal = array();
        $coba = [];
        // $tanggal = [];
        foreach ($dateend as $key => $value) {
            // alat pengecekan
            $date[$key] = array($value);
            $ind = $key-1;

            // pengecekan
            if ($ind == -1) {
                $tglsmtr = $value->tgl_kembali;
                $id = $value->transaction_id;
            } else {
                if ($value->transaction_id == $date[$ind][0]->transaction_id) {
                    if ($tglsmtr == null) {
                        $tglsmtr = null;
                    } elseif ($value->tgl_kembali == null) {
                        $tglsmtr = null;
                    } elseif (strtotime($value->tgl_kembali) > strtotime($tglsmtr)) {
                        $tglsmtr = $value->tgl_kembali;
                    }

                    if ( $key == count($dateend)-1 ) {
                        array_push($tanggal, [
                            // 'key' => $key,
                            'transaction_id' => $id,
                            'tgl_kembali' => $tglsmtr,
                        ]);
                    }
                    
                } else {
                    array_push($tanggal, [
                        // 'key' => $key,
                        'transaction_id' => $id,
                        'tgl_kembali' => $tglsmtr,
                    ]);

                    $tglsmtr = $value->tgl_kembali;
                    $id = $value->transaction_id;

                    if ( $key == count($dateend)-1 ) {
                        array_push($tanggal, [
                            // 'key' => $key,
                            'transaction_id' => $id,
                            'tgl_kembali' => $tglsmtr,
                        ]);
                    }
                }
            }
        }
        
        $total = '';
        $tanggal_kembali = '';
        $newData = [];
        foreach ($transaction as $key => $value) {
            foreach ($jumlah as $key => $jml) {
                // print_r($jumlah);
                // echo $jml->transaction_id;
                // echo $value->id;
                if ($jml->transaction_id == $value->id) {
                    $total = $jml->total;
                }
            }
            // echo $total;
            foreach ($tanggal as $key => $tgl) {
                // print_r($tgl['transaction_id']);
                // echo $value->id;
                if ($tgl['transaction_id'] == $value->id) {
                    $tanggal_kembali = $tgl['tgl_kembali'];
                }
            }
            // push
            array_push($newData, [
                'id' => $value->id,
                'name' => $value->name,
                'date_start' => $value->date_start,
                'total' => $total,
                'tgl_kembali' => $tanggal_kembali
            ]);
        }
        return $newData;
        // $newData = new \Illuminate\support\Collection; //Create empty collection which we know has the merge() method
        // $newData = $newData->merge($transaction);
        // $newData = $newData->merge($tanggal);
        // $newData = $newData->merge($jumlah);

        // return $newData;

        // $newData = array_merge($transaction, $jumlah, $tanggal);

        // sumber daya
        // return $newData;
        // return $transaction;
        // return $tanggal;
        // return $jumlah;
        // $allItems = [];

        // return $allItems;
 
        $datatable = datatables($tanggal, $transaction, $tanggal)->addIndexColumn();

        // return  $datatable->make(true);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('.admin.transaction.index');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
