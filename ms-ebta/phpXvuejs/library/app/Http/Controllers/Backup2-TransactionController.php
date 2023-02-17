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
        // ||||||||||||||||||||| Data Utama |||||||||||||||||||||||||||||||||||||||
        $transaction = Transaction::select('transactions.*', 'members.name',/*'transaction_details.status', 'transaction_details.qty_pinjam'*/)
                        ->leftJoin("members", "transactions.member_id", "=", "members.id")
                        // ->leftJoin("books", "transaction_details.book_id", "=", "books.id")
                        // ->leftJoin("transaction_details", "transactions.id", "=", "transaction_details.transaction_id")
                        ->groupBy("transactions.id")
                        ->orderBy('transactions.id')
                        ->get();
        
        // return $transaction;

        // ||||||||||||||||||| Data total Buku |||||||||||||||||||||||||||||||||||||||
        $jumlah = DB::table("transaction_details")
        ->select("transaction_id", DB::raw('sum(qty_pinjam) as total'))
        ->groupBy("transaction_id")
        ->get();

        
        // |||||||||||||||||||| Data Tanggal Pengembalian dan total harga |||||||||||||||||||||
        // $dateend = TransactionDetail::query()->orderBy('transaction_id')->get();
        $dateend = TransactionDetail::select('transaction_details.*', 'books.price')
                    ->leftJoin("books", "books.id", "transaction_details.book_id")
                    ->orderBy('transaction_id')->get();
        // return $dateend;
        $datum = array();
        $tanggal = array();
        $total_harga = '';
        foreach ($dateend as $key => $value) {
            // alat pengecekan
            $date[$key] = array($value);
            $ind = $key-1;
            
            // pengecekan
            if ($ind == -1) {
                $tglsmtr = $value->tgl_kembali;
                $id = $value->transaction_id;
                $status = $value->status;
                $total_harga = $value->price*$value->qty_pinjam;
            } else {
                if ($value->transaction_id == $date[$ind][0]->transaction_id) {
                    if ($tglsmtr == null || $tglsmtr == '-') {
                        $tglsmtr = '-';
                        $status = 0;
                    } elseif ($value->tgl_kembali == null ) {
                        $tglsmtr = '-';
                        $status = 0;
                    } elseif (strtotime($value->tgl_kembali) > strtotime($tglsmtr)) {
                        $tglsmtr = $value->tgl_kembali;
                        $status = $value->status;
                    }
                    $total_harga += $value->price*$value->qty_pinjam;

                    if ( $key == count($dateend)-1 ) {
                        array_push($tanggal, [
                            // 'key' => $key,
                            'transaction_id' => $id,
                            'tgl_kembali' => $tglsmtr,
                            'status' => $status,
                            'harga' => $total_harga,
                        ]);
                    }
                    
                } else {
                    array_push($tanggal, [
                        // 'key' => $key,
                        'transaction_id' => $id,
                        'tgl_kembali' => $tglsmtr,
                        'status' => $status,
                        'harga' => $total_harga,
                    ]);
                    
                    $tglsmtr = $value->tgl_kembali;
                    $id = $value->transaction_id;
                    $status = $value->status;
                    $total_harga = $value->price*$value->qty_pinjam;
                    
                    if ($value->tgl_kembali == null) {
                        $tglsmtr = '-';
                        $status = 0;
                    }

                    if ( $key == count($dateend)-1 ) {
                        array_push($tanggal, [
                            // 'key' => $key,
                            'transaction_id' => $id,
                            'tgl_kembali' => $tglsmtr,
                            'status' => $status,
                            'harga' => $total_harga,
                        ]);
                    }
                }
            }
        }

        // |||||||||||||||||| Data Akhir |||||||||||||||||||||||||||||||||
        $newData = [];
        $total = '';
        $tanggal_kembali = '';
        $total_harga = '';
        foreach ($transaction as $key => $value) {
            foreach ($jumlah as $key => $jml) {
                if ($jml->transaction_id == $value->id) {
                    $total = $jml->total;
                }
            }
            // echo $total;
            foreach ($tanggal as $key => $tgl) {
                // print_r($tgl['harga']);
                if ($tgl['transaction_id'] == $value->id) {
                    $tanggal_kembali = $tgl['tgl_kembali'];
                    $total_harga = $tgl['harga'];
                    $status = $tgl['status'];
                }
            }
            // push
            array_push($newData, [
                'id' => $value->id,
                'name' => $value->name,
                'date_start' => $value->date_start,
                'total' => $total,
                'harga_total' => $total_harga,
                'tgl_kembali' => $tanggal_kembali,
                'status' => $status
            ]);
        }
        // return $newData;
        // sumber daya
        // return $newData;
        // return $transaction;
        // return $tanggal;
        // return $jumlah;

        // return $allItems;
 
        // ||||||||||||||||||||| api untuuk data table ||||||||||||||||||||||||||||||
        $datatable = datatables($newData)->addColumn('durasi', function($newData) {
                        if ($newData['tgl_kembali'] == '-') {
                            return '-';
                        } else {
                            return durasi($newData['date_start'], $newData['tgl_kembali']);
                        }
                    })->addColumn('stat', function($newData) {
                        if ($newData['status'] == 1) {
                            return 'sudah dikembalikan';
                        } else {
                            return 'belum dikembalikan';
                        }
                    })->addColumn('harga', function($newData) {
                        return uang($newData['harga_total'], 'Rp');
                    })->addIndexColumn();

        return  $datatable->make(true);
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
