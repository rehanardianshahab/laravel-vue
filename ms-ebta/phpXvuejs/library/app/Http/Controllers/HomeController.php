<?php

namespace App\Http\Controllers;

// use App\Models\User;
use App\Models\Member;
use App\Models\Transaction;
// use App\Models\TransactionDetail;
// use App\Models\Publisher;
use App\Models\Catalog;
// use App\Models\Author;
use App\Models\Book;

use Illuminate\Http\Request;

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
        return view('home');
    }
}
