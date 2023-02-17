<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Publisher;
use App\Models\Catalog;
use App\Models\Author;
use App\Models\Book;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
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

    
    // api notif
    public function api()
    {
        $dl = Transaction::select('transactions.id', 'name', 'date_end', 'status')
                ->Join("members", function($join){
                        $join->on('transactions.member_id', '=', 'members.id');
                    })
                ->RightJoin("transaction_details", function($join){
                        $join->on("transaction_details.transaction_id", "=", "transactions.id");
                    })
                ->groupBy('transactions.id')
                ->where("transaction_details.status", '=', false)
                ->orderBy('date_end', 'desc')
                ->get();
        // return $dl;
        $dateNow = date('Y-m-d');
        $notif = [];
        foreach ($dl as $key => $value) {
            if ( strtotime($value->date_end) < strtotime($dateNow) ) {
                $tenggang = strtotime($dateNow)-strtotime($value->date_end);
                array_push($notif, notif($tenggang, $value->name));
            }
        }
        
        return $notif;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return Member::with('User')->get();
        // return User::with('Member')->get();
        // return Member::with('Transactions')->get();
        // return Transaction::with('Member')->get();
        // return Transaction::with('TransactionDetail')->get();
        // return TransactionDetail::with('Transaction')->get();
        // return Book::with('TransactionDetails')->get();
        // return Publisher::with('Books')->get();
        // return Book::with('Publisher')->get();
        // return Catalog::with('Books')->get();
        // return Book::with('Catalog')->get();
        // return Author::with('Books')->get();
        // return Book::with('Author')->get();
        // return Book::with('Author', 'Catalog', 'Publisher', 'TransactionDetails')->get();
        
        //////////////////////// query builder \\\\\\\\\\\\\\\\\\\\\\\\
        // no.1
        // return Member::select('members.id', 'members.name')
        //         ->join('users','users.member_id', '=', 'members.id')
        //         ->get();
        // no.2
        // $data = Member::select('*')
        //         ->leftjoin('users', 'users.member_id', '=', 'members.id')
        //         ->where('users.id', '=', NULL)
        //         ->get();
        // no.3
        // return Member::select('members.id', 'members.name')
        //         ->leftjoin('users', 'users.member_id', '=', 'members.id')
        //         ->where('users.id', '=', NULL)
        //         ->get();
        // no.4
        // $data = Member::select('members.id', 'members.name', 'members.phone_number')
        //         ->join('transactions', 'transactions.member_id', '=', 'members.id')
        //         ->orderBy('members.id', 'asc')
        //         ->get();
        // no.5
        // return Member::select("*")
        //             ->join("transactions", function($join){
        //                 $join->on("transactions.member_id", "=", "members.id");
        //             })
        //             ->select("members.id", "members.name", Member::raw("COUNT(`transactions`.`member_id`) as `jumlah_pinjam`"))
        //             ->groupBy("transactions.member_id")
        //             ->having("jumlah_pinjam", ">", 1)
        //             ->get();
            // atau
        // return Member::select("members.id", "members.name", Member::raw("COUNT(`transactions`.`member_id`) as `jumlah_pinjam`"))
        //             ->join("transactions", "transactions.member_id", "=", "members.id")
        //             ->groupBy("transactions.member_id")
        //             ->having("jumlah_pinjam", ">", 1)
        //             ->get();
        // no.6
        // $data = Member::select("name", "phone_number", "address", "date_start", "date_end")
        //             ->join("transactions", function($join){
        //                     $join->on("members.id", "=", "transactions.member_id");
        //                 })
        //             ->get();
        // no.7
        // return Member::select("name", "phone_number", "address", "date_start", "date_end")
        //             ->join("transactions", "members.id", "=", "transactions.member_id")
        //             ->where("date_end", "=", 6)
        //             ->get();
        // no.8
        // $data = Member::select("name", "phone_number", "address", "date_start", "date_end")
        //             ->join("transactions", "members.id", "=", "transactions.member_id")
        //             ->where("date_end", "=", 5)
        //             ->get();
        // no.9
        // Member::select("name", "phone_number", "address", "date_start", "date_end")
        //             ->join("transactions", "members.id", "=", "transactions.member_id")
        //             ->where("date_end", "=", 6)
        //             ->where("date_start", "=", 6)
        //             ->get();
        // no.10
        // $data = Member::select("name", "phone_number", "address", "date_start", "date_end")
        //             ->join("transactions", "members.id", "=", "transactions.member_id")
        //             ->where("address", "like", "%bandung%")
        //             ->get();
        // no.11
        // Member::select("name", "phone_number", "address", "date_start", "date_end")
        //             ->join("transactions", "members.id", "=", "transactions.member_id")
        //             ->where("address", "like", "%bandung%")
        //             ->where("gender", "=", "p")
        //             ->get();
        // no.12
        // $data = Member::select("members.name", "members.phone_number", "members.address", "transactions.date_start", "transactions.date_end", "books.isbn", "transaction_details.qty")
        //         ->join("transactions", "members.id", "=", "transactions.member_id")
        //         ->join("transaction_details", "transactions.id", "=", "transaction_details.transaction_id")
        //         ->join("books", "books.id", "=", "transaction_details.book_id")
        //         ->where("transaction_details.qty", ">=", 2)
        //         ->get();
        // no.13
        // $data = Member::select("members.name", "members.phone_number", "members.address", "transactions.date_start", "transactions.date_end", "books.isbn", "transaction_details.qty", "books.title", "books.price", Member::raw('books.price * transaction_details.qty as total_price'))
        //         ->join("transactions", "members.id", "=", "transactions.member_id")
        //         ->join("transaction_details", "transactions.id", "=", "transaction_details.transaction_id")
        //         ->join("books", "books.id", "=", "transaction_details.book_id")
        //         ->where("transaction_details.qty", ">=", 2)
        //         ->get();
        // no.14
        // return Member::select("members.name", "members.phone_number", "members.address", "transactions.date_start", "transactions.date_end", "books.isbn", "transaction_details.qty", "books.title", "publishers.name", "authors.name", "catalogs.name")
        //         ->join("transactions", "members.id", "=", "transactions.member_id")
        //         ->join("transaction_details", "transactions.id", "=", "transaction_details.transaction_id")
        //         ->join("books", "books.id", "=", "transaction_details.book_id")
        //         ->join("publishers", "publishers.id", "=", "books.publisher_id")
        //         ->join("authors", "authors.id", "=", "books.author_id")
        //         ->join("catalogs", "catalogs.id", "=", "books.catalog_id")
        //         ->get();
        // no.15
        // $data = Catalog::select("catalogs.*", "books.title")
        //         ->join("books", "books.catalog_id", "=", "catalogs.id")
        //         ->get();
        // no.16
        // return Book::select("Books.*", "publishers.name")
        //         ->leftJoin("publishers", "books.publisher_id", "=", "publishers.id")
        //         ->get();
        // no.17
        // $data = Book::select(Book::raw("COUNT(author_id) as total_authors_15"))
        //         ->where('author_id','=','15')
        //         ->groupBy('author_id')
        //         ->get();
        // no.18
        // return Book::select("*")
        //         ->where("price", ">", "10000")
        //         ->get();
        // no.19
        // return Book::select("*")
        //         ->where("publisher_id", "=", 4)
        //         ->where("qty", "=", 10)
        //         ->get();
        // no.20
        // return Member::select("*")
        //         ->whereMonth('created_at', '=', '12')
        //         ->get();

        // return $data;
            $members = Member::count();
            $books = Book::count();
            $publishers = Publisher::count();
            $authors = Author::count();
            $transactions = Transaction::count();

            // donut chart
            $data_donut = [$members, $authors, $publishers];
            $label_donut = ["Pembaca", "Penulis", "Penerbit"];

            // area chart
            $label_area = ['peminjaman', 'pengembalian'];
            $data_area = [];

            foreach($label_area as $key =>$value) {
                $data_area[$key]['label'] = $label_area[$key];
                $data_area[$key]['backgroundColor'] = $key == 0 ? 'rgba(60,141,188,0.9)' : 'rgba(210, 214, 222, 1)';
                $data_area[$key]['borderColor'] = $key == 0 ? 'rgba(60,141,188,0.8)' : 'rgba(210, 214, 222, 1)';
                $data_month = [];
                
                foreach(range(1,12) as $month) {
                    if($key == 0) {
                        $data_month[] = Transaction::select(DB::raw("COUNT(*) as total"))
                                    ->whereMonth('date_start', $month)->first()->total;
                    } else {
                        $data_month[] = TransactionDetail::select(DB::raw("COUNT(*) as total"))
                                    ->whereNotNull('tgl_kembali')->whereMonth('tgl_kembali', $month)->first()
                                    ->total;
                    }
                }

                $data_area[$key]['data'] = $data_month;
            }

            // bar chart
            // $allData_bar = Author::select('authors.id', 'name', 'author_id')
            //             ->Leftjoin('books', 'books.author_id', '=', 'authors.id')
            //             ->orderBy('authors.id')->get();
            $countData_bar = Author::select('authors.id', 'name', 'author_id')
                        ->Leftjoin('books', 'books.author_id', '=', 'authors.id')
                        ->select('books.author_id', DB::raw('count(*) as total'), 'authors.name')
                        ->groupBy('books.author_id', 'authors.id')
                        ->orderBy('authors.name')->get();
                foreach($countData_bar as $value) {
                    if($value->author_id == null) {
                        $value->total = 0;
                    }
                }
            $label_bar = Author::select('authors.name')->orderBy('authors.name')->get();;
            $labels_bar = [];
            $backgroundBar = [];
            $data_count = [];
            $data_bar = [];
            // return $label_bar;
            // return $allData_bar;
            // return $countData_bar;

            foreach($label_bar as $key => $value) {
                array_push($labels_bar, $value->name);
            }
            // return $labels_bar;

            foreach($countData_bar as $key =>$value) {
                array_push($backgroundBar, "rgb(".rand(0,255).",".rand(0,255).",".rand(0,255).")");
                array_push($data_count, $value->total);
            }
            $data_bar['labels_bar'] = $labels_bar;
            $data_bar['backgroundColor'] = $backgroundBar;
            $data_bar['data'] = $data_count;
            // return $data_bar;

        // return $data_bar;

        // db_publishers
        $countData_publisher = Publisher::select('publishers.id', 'name', 'publisher_id')
                        ->Leftjoin('books', 'books.publisher_id', '=', 'publishers.id')
                        ->select('books.publisher_id', DB::raw('count(*) as total'), 'publishers.name')
                        ->groupBy('books.publisher_id', 'publishers.id')
                        ->orderBy('publishers.name')->get();
                foreach($countData_publisher as $value) {
                    if($value->publisher_id == null) {
                        $value->total = 0;
                    }
                }
        // return $countData_publisher;
        $labels_publisher = [];
            foreach($countData_publisher as $key => $value) {
                array_push($labels_publisher, $value->name);
            }
        // return $labels_publisher;
        $backgroundPublisher = [];
        $data_count = [];
        $data_publisher = [];

        foreach($countData_publisher as $key =>$value) {
            array_push($backgroundPublisher, "rgb(".rand(0,255).",".rand(0,255).",".rand(0,255).")");
            array_push($data_count, $value->total);
        }
        $data_publisher['labels_publisher'] = $labels_publisher;
        $data_publisher['backgroundColor'] = $backgroundPublisher;
        $data_publisher['data'] = $data_count;

        // return $data_publisher;
            
        return view('home', compact(
            "members", "books", "publishers", "authors", "transactions",
            // donut chart
            "data_donut", "label_donut",
            // area chart
            "data_area",
            // bar chart
            "data_bar",
            // par publisher
            "data_publisher",
        ));
    }
}
