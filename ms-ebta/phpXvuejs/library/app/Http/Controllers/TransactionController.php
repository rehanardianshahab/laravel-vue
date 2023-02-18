<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Book;
use App\Models\Member;
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
        $sample = [];
        $tanggal_kembali = '';
        $total_harga = '';
        foreach ($jumlah as $key => $jml) {
            foreach ($transaction as $key => $value) {
                if ($value->id == $jml->transaction_id) {
                    array_push($sample, [
                        "id" => $value->id,
                        "name" => $value->name,
                        "date_start" => $value->date_start,
                        "date_end" => $value->date_end,
                        "total" => $jml->total,
                    ]);
                }
            }
        }
            // // echo $total;
        foreach ($sample as $key => $value) {
            foreach ($tanggal as $key => $tgl) {
                if ($tgl['transaction_id'] == $value['id']) {
                    $tanggal_kembali = $tgl['tgl_kembali'];
                    $total_harga = $tgl['harga'];
                    $status = $tgl['status'];
                }
            }
            // push
            array_push($newData, [
                'id' => $value['id'],
                'name' => $value['name'],
                'date_start' => $value['date_start'],
                'date_end' => $value['date_end'],
                'total' => $value['total'],
                'harga_total' => $total_harga,
                'tgl_kembali' => $tanggal_kembali,
                'status' => $status
            ]);
        }
        // return $newData;

        // ||||||||||||||||||||||| Data akhir filtered ||||||||||||||||||||||||||||||||
        if (isset($_GET['kondisi']) || isset($_GET['tglstart']) || isset($_GET['tglend'])) {
            // filter by kondisi
            $filter = [];
            $tangg = $_GET['tglstart'];
            if ($_GET['kondisi'] == 2) {
                foreach($newData as $key => $data) {
                    array_push($filter, $data);
                }
                // echo $_GET['kondisi'];
            } else {
                foreach($newData as $key => $data) {
                    if ($_GET['kondisi'] == $data['status']) {
                        array_push($filter, $data);
                    }
                }
            }
            // ganti data
            $newData = $filter;
            $filter = [];

            // filter by waktu
            if ($_GET['tglstart'] == 0 ) {
                foreach($newData as $key => $data) {
                    array_push($filter, $data);
                }
            } elseif ($_GET['tglend'] == 0) {
                foreach($newData as $key => $data) {
                    // echo $data['date_start']. '<br>';
                    if ( strtotime($_GET['tglstart']) < strtotime($data['date_start']) || strtotime($_GET['tglstart']) == strtotime($data['date_start']) ) {
                        array_push($filter, $data);
                        // echo $data['date_start']. '<br>';
                    }
                }
            } else {
                foreach($newData as $key => $data) {
                    if ( 
                            (strtotime($_GET['tglstart']) < strtotime($data['date_start']) || strtotime($_GET['tglstart']) == strtotime($data['date_start']))
                            && 
                            (strtotime($data['date_start']) < strtotime($_GET['tglend'])  || strtotime($_GET['tglend']) == strtotime($data['date_start'])) 
                        ) {
                        array_push($filter, $data);
                        // echo $data['date_start']. '<br>';
                    }
                }
            }
            $newData = $filter;
        }
        // return $newData;
        // print_r(tanggalNoTime($tangg));
        // return $newData;
        // sumber daya
        // return $newData;
        // return $transaction;
        // return $tanggal;
        // return $jumlah;
        
        // ||||||||||||||||||||| api untuuk data table ||||||||||||||||||||||||||||||
        $datatable = datatables($newData)->addColumn('durasi', function($newData) {
                        // if ($newData['tgl_kembali'] == '-') {
                        //     return '-';
                        // } else {
                        //     return durasi($newData['date_start'], $newData['tgl_kembali']);
                        // }
                        return durasi($newData['date_start'], $newData['date_end']);
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
        $user = auth()->user();
        return view('.admin.transaction.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAndEdit()
    {
      if (auth()->user()->hasrole('administrator')) {
        // ====================== data nama member dan id transaksi ======================
        $member = Member::select('members.*', 'transactions.id as id_trans')
                    ->Leftjoin('transactions', 'transactions.member_id', '=', 'members.id')
                    ->orderBy('name')->get();
        // return $member;
        $allMember = Member::select('*')->orderBy('name')->get();
        // ====================== jumlah buku ==================================
        $buku = Book::select('id', 'isbn', 'title', 'qty', 'price')->get();

        // ================== buku dalam data dipinjam =========================
        $dipinjam = TransactionDetail::select('book_id', 'id', 'qty_pinjam', 'status')
                    ->where('status', '=', 0)
                    ->orderBy('book_id')
                    ->get();
        // return $dipinjam;
        // =================== menentukan buku yang dipinjam ===================
        $sementara1 = [];
        $sementara2 = [];

        foreach ($dipinjam as $key => $value) {
            // alat pengecekan
            array_push($sementara1, array($value));
            $ind = $key-1;
            
            // pengecekan
            if ($ind == -1) { // apakah dia data pertama?
                // tentukan keunikan data pertama
                $book_id = $value->book_id;
                $id = $value->id;
                $qty_pinjam = $value->qty_pinjam;
                $status = $value->status;

                if( $key == count($dipinjam)-1 ) { // apakah dia data pertama dan terakhir
                    // push sebagai data tunggal
                    array_push($sementara2, [
                        'book_id' => $value->book_id,
                        'id' => $value->id,
                        'qty_pinjam' => $value->qty_pinjam,
                        'status' => $value->status,
                    ]);
                }
            } elseif( $key == count($dipinjam)-1 ) { // apakah dia data terakhir
                if( $sementara1[$ind][0]['book_id'] == $value->book_id ) { // apakah dia data terakhir yg sama seperti data sebelumnya
                    // kalkulasi dengan data sebelumnya lalu push
                    $qty_pinjam = $qty_pinjam + $value->qty_pinjam;
                    array_push($sementara2, [
                        'book_id' => $book_id,
                        'id' => $id,
                        'qty_pinjam' => $qty_pinjam,
                        'status' => $status,
                    ]);
                } else { // dia data terakhir yang unix
                    // push data sebelumnya
                    array_push($sementara2, [
                        'book_id' => $book_id,
                        'id' => $id,
                        'qty_pinjam' => $qty_pinjam,
                        'status' => $status,
                    ]);
                    // push data yang ini sebagai data unix terakhir
                    array_push($sementara2, [
                        'book_id' => $value->book_id,
                        'id' => $value->id,
                        'qty_pinjam' => $value->qty_pinjam,
                        'status' => $value->status,
                    ]);
                }
            } else { // dia adalah data tengah
                if( $sementara1[$ind][0]['book_id'] == $value->book_id ) { // apakah dia data tengah yg sama seperti data sebelumnya
                    // kalkulasi data sebelumnya dengan data ini
                    $qty_pinjam = $qty_pinjam + $value->qty_pinjam;
                } else { // dia adalah data tengah yang unik
                    // push data sebelumnya
                    array_push($sementara2, [
                        'book_id' => $book_id,
                        'id' => $id,
                        'qty_pinjam' => $qty_pinjam,
                        'status' => $status,
                    ]);
                    // tentukan data ini menjadi data unix baru
                    $book_id = $value->book_id;
                    $id = $value->id;
                    $qty_pinjam = $value->qty_pinjam;
                    $status = $value->status;
                }
            }
        }

        // jika selesai semua kembalikan ke variable awal
        $dipinjam = $sementara2;
        $sementara1 = [];
        $sementara2 = [];
        // return $buku;

        // =========================== buku yang tersedia ===============================
        foreach ($buku as $key => $value) {
            foreach ($dipinjam as $key => $pjm) {
                // return $pjm['book_id'];
                if ($pjm['book_id'] == $value['id']) {
                    // $yangdipinjam = $pjm['qty_pinjam'];
                    // $available = $value['qty'] - $yangdipinjam;
                    // $bookid = $pjm['book_id'];
                    array_push($sementara1, [
                        'id' => $pjm['book_id'],
                        "isbn" => $value['isbn'],
                        "qty" => $value['qty'],
                        "title" => $value['title'],
                        'yang_dipinjam' => $pjm['qty_pinjam'],
                        'tersedia' => $value['qty'] - $pjm['qty_pinjam']
                    ]);
                }
            }
        }
        $buku = $sementara1;
        $sementara1 = [];

        // ========================= data akhir/ buku yang vailable =====================
        // cek apakah sisa bukunya masih ada
        foreach ($buku as $key => $value) {
            // jika ada sisa bukunya
            if (($value['tersedia'] > 0) > 0) {
                array_push($sementara1, $value);
            } else {
                $sementara1 = [];
            }
        }
        $buku = $sementara1;
        $sementara1 = [];


        // ==============================Buku yang dipinjam By Id=============================
        $bukuInTrans = '';
        $tanggal = '';
        if ( isset($_GET['trans_id']) ) {
            // echo 'halo';
            $bukuInTrans = TransactionDetail::select('transaction_details.id','transaction_id', 'book_id', 'title', 'qty_pinjam', 'books.price', 'status', 'tgl_kembali')
                            ->join('books', 'books.id', '=', 'book_id')
                            ->where('transaction_id', '=', $_GET['trans_id'])->get();
            $tanggal = Transaction::select('*')
                        ->where('id', '=', $_GET['trans_id'])->get();
        }

        return view('.admin.transaction.form', compact('buku', 'member', 'allMember', 'bukuInTrans', 'tanggal'));
        } else {
            return abort('403');
        }
    }
    public function bukupinjaman(Request $request)
    {
        // ==============================Buku yang dipinjam By Id=============================
        $bukuInTrans = TransactionDetail::select('transaction_details.id','transaction_id', 'book_id', 'title', 'qty_pinjam', 'books.price', 'status', 'tgl_kembali')
                            ->join('books', 'books.id', '=', 'book_id')->get();
        $tanggal = Transaction::select('date_start', 'date_end')->get();
        return $bukuInTrans;
        // return $buku;
        // return $tanggal[0]->date_start;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if (auth()->user()->hasrole('administrator')) {
        $this->validate($request, [
            'name' => ['required'],
            'book' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ]);
        // return $request;

        $transaction = new Transaction;
        $transaction->member_id = $request->name;
        $transaction->date_start = $request->start_date;
        $transaction->date_end = $request->end_date;
        
        $transaction->save();
        
        $id = Transaction::select('id')->orderBy('created_at', 'desc')->first();
        foreach ($request->book as $num => $variable) {
            $transactionDetail = new TransactionDetail;
            $transactionDetail->transaction_id = $id->id;
            $transactionDetail->book_id = $variable;
            $transactionDetail->qty_pinjam = 1;
            $transactionDetail->status = false;

            $transactionDetail->save();
        }

        return redirect('/transactions')->with('success', 'Data berhasil ditambahkan');
      } else {
        return abort('403');
      }
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
      if (auth()->user()->hasrole('administrator')) {
        // return $request;
        $this->validate($request, [
            'end_date' => ['required'],
        ]);
        $transactiones = [];
        $transactiones['date_end'] = $request->end_date;
        // return $transactiones;

        $transaction->update($transactiones);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
      } else {
        return abort('403');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
      if (auth()->user()->hasrole('administrator')) {
        // return $transaction->id;
        $transactiondetail = TransactionDetail::select('*')->where('transaction_id', '=', $transaction->id)->get();
        $transactiondetail->each->delete(); // cara lain : hapus each dan get()
        $transaction->delete();
        // return 'sukses';
        return redirect()->back()->with('success', 'Data berhasil dihapus');
      } else {
        return abort('403');
      }
    }
}
