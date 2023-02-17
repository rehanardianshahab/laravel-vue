<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use DB;

class TransactionDetailController extends Controller
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
        $transaction = DB::table("transaction_details")
                        ->join("books", function($join){
                            $join->on("books.id", "=", "transaction_details.book_id");
                        })
                        ->join("transactions", function($join){
                            $join->on("transaction_details.transaction_id", "=", "transactions.id");
                        })
                        ->join("members", function($join){
                            $join->on("transactions.member_id", "=", "members.id");
                        })
                        ->select("transaction_details.*", "transactions.date_start", "transactions.date_end", "members.name", "books.title", "transactions.member_id")
                        ->where("transaction_details.transaction_id", "=", $_GET['trans_id'])
                        ->orderBy('transaction_details.transaction_id')
                        ->get();
        // return $transaction;

        // ||||||||||||||||| Data Utaama |||||||||||||||||||||||||||
        $tanggal = array();
        foreach ($transaction as $key => $value) {
            // alat pengecekan
            $date[$key] = array($value);
            $ind = $key-1;
            
            // pengecekan
            if ($ind == -1) {
                $tglsmtr = $value->tgl_kembali;
                $idtrans = $value->transaction_id;
                if ($value->status == 0) {
                    $status = 'Belum Dikembalikan';
                } else {
                    $status = 'Sudah Dikembalikan';
                }

                if ( $key == count($transaction)-1 ) {
                    array_push($tanggal, [
                        // 'key' => $key,
                        'transaction_id' => $idtrans,
                        'member_id' => $value->member_id,
                        'tgl_kembali' => $tglsmtr,
                        'tgl_pinjam' => $value->date_start,
                        'dl' => $value->date_end,
                        'status' => $status,
                        'nama' => $value->name,
                    ]);
                }
            } else {
                if ($value->transaction_id == $date[$ind][0]->transaction_id) {
                    if ($tglsmtr == null || $tglsmtr == '-') {
                        $tglsmtr = '-';
                        $status = 'Belum Dikembalikan';
                    } elseif ($value->tgl_kembali == null ) {
                        $tglsmtr = '-';
                        $status = 'Belum Dikembalikan';
                    } elseif (strtotime($value->tgl_kembali) > strtotime($tglsmtr)) {
                        $tglsmtr = $value->tgl_kembali;
                        $status = 'Sudah Dikembalikan';
                    }

                    if ( $key == count($transaction)-1 ) {
                        array_push($tanggal, [
                            // 'key' => $key,
                            'transaction_id' => $idtrans,
                            'member_id' => $value->member_id,
                            'tgl_kembali' => $tglsmtr,
                            'tgl_pinjam' => $value->date_start,
                            'dl' => $value->date_end,
                            'status' => $status,
                            'nama' => $value->name,
                        ]);
                    }
                    
                } else {
                    array_push($tanggal, [
                        // 'key' => $key,
                        'transaction_id' => $idtrans,
                        'member_id' => $value->member_id,
                        'tgl_kembali' => $tglsmtr,
                        'tgl_pinjam' => $value->date_start,
                        'dl' => $value->date_end,
                        'status' => $status,
                        'nama' => $value->name,
                    ]);
                    
                    $tglsmtr = $value->tgl_kembali;
                    $idtrans = $value->transaction_id;
                    $status = 'Sudah Dikembalikan';
                    
                    if ($value->tgl_kembali == null) {
                        $tglsmtr = '-';
                        $status = 'Belum Dikembalikan';
                    }

                    if ( $key == count($dateend)-1 ) {
                        array_push($tanggal, [
                            // 'key' => $key,
                            'transaction_id' => $idtrans,
                            'member_id' => $value->member_id,
                            'tgl_kembali' => $tglsmtr,
                            'tgl_pinjam' => $value->date_start,
                            'dl' => $value->date_end,
                            'status' => $status,
                            'nama' => $value->name,
                        ]);
                    }
                }
            }
        }
        $data_utama = $tanggal;
        // return $data_utama;

        // ||||||||||||||||||||||||| data buku ||||||||||||||||||||||||||||||||||
        $buku = [];
        foreach ($transaction as $key => $value) {
            if ($value->tgl_kembali == null) {
                $tanggal = 'belum dikembalikan';
            } else {
                $tanggal = $value->tgl_kembali;
            }
            array_push($buku, [
                'detil_id' => $value->id,
                'book_id' => $value->book_id,
                'title' => $value->title,
                'status' => $value->status,
                'jumlah' => $value->qty_pinjam,
                'tanggal' => $tanggal
            ]);
        }
        // return $buku;

        // |||||||||||||||||||||||||| data akhir ||||||||||||||||||||||||||||
        $conclute = [];
        foreach ($data_utama as $key => $value) {
            array_push($conclute, [
                'member_id' => $value['member_id'],
                'transaction_id' => $value['transaction_id'],
                'tgl_kembali' => $value['tgl_kembali'],
                'tgl_pinjam' => $value['tgl_pinjam'],
                'dl' => $value['dl'],
                'status' => $value['status'],
                'nama' => $value['nama'],
                'buku' => $buku,
            ]);
        }

        // ||||||||||||| return API |||||||||||||
        return $conclute;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('.admin.transaction.detil');
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
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionDetail $transactionDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionDetail $transactionDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionDetail $transactionDetail)
    {
        // $transactionDetail->update($request->all());
        // $transactionDetail->delete();
        $this->validate($request, [
            'status' => ['required'],
            'tgl_kembali' => ['required']
        ]);
        $transactionDetail->update($request->all());

        return redirect()->back()->with('success', 'Buku berhasil Dikembalikan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionDetail $transactionDetail)
    {
        //
    }
}
