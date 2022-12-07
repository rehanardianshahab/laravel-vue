<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // $members = Member::with('user')->get();
        // $books = Book::with('publisher')->get();
        // $publisher = Publisher::with('books')->get();
        // $books = Book::with('author')->get();
        // $author = Author::with('books')->get();
        // $books = Book::with('catalog')->get();
        // $catalog = Catalog::with('books')->get();

        // return $catalog;

        // QUERY BUILDER

        // No 1
        $data = Member::select('*')
                    ->where('role', '=', 'admin')
                    ->get();

        // No 2
        $data2 = Member::select('*')
                    ->where('role', '!=', 'admin')
                    ->get();

        // No 3
        $data3 = Member::select('members.id', 'members.name')
                    ->leftJoin('transactions', 'members.id', '=', 'transactions.member_id')
                    ->where([
                        ['transactions.date_start', NULL],
                        ['transactions.date_end', NULL],
                    ])
                    ->get();

        // No 4
        $data4 = Member::select('members.id', 'members.name', 'members.phone_number')
                    ->leftJoin('transactions', 'members.id', '=', 'transactions.member_id')
                    ->where([
                        ['transactions.date_start', '!=', NULL],
                        ['transactions.date_end', '!=', NULL],
                    ])
                    ->get();

        // No 5
        $data5 = Member::select('members.id', 'members.name', 'members.phone_number', DB::raw('COUNT(transactions.member_id) as jumlah_pinjam'))
        ->join('transactions', 'transactions.member_id', '=', 'members.id')
        ->groupBy('transactions.member_id')
        ->havingRaw('jumlah_pinjam > ?', [1])
        ->get();

        // No 6
        $data6 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
                    ->join('transactions', 'members.id', '=', 'transactions.member_id')
                    ->get();

        // No 7
        $data7 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
                    ->join('transactions', 'members.id', '=', 'transactions.member_id')
                    ->whereMonth('transactions.date_end', '=', '06')
                    ->get();

        // No 8
        $data8 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
                    ->join('transactions', 'members.id', '=', 'transactions.member_id')
                    ->whereMonth('transactions.date_start', '=', '05')
                    ->get();

        // No 9
        $data9 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
                    ->join('transactions', 'members.id', '=', 'transactions.member_id')
                    ->whereMonth('transactions.date_start', '=', '06')
                    ->whereMonth('transactions.date_end', '=', '06')
                    ->get();

        // No 10
        $data10 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
                    ->join('transactions', 'members.id', '=', 'transactions.member_id')
                    ->where('members.address', 'like', '%bandung%')
                    ->get();

        // No 11
        $data11 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
                    ->join('transactions', 'members.id', '=', 'transactions.member_id')
                    ->where([
                        ['members.address', 'like', '%bandung%'],
                        ['members.gender', '=', 'F'],
                    ])
                    ->get();

        // No 12
        $data12 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end', 'transaction_details.book_id', 'transaction_details.qty')
                    ->join('transactions', 'members.id', '=', 'transactions.member_id')
                    ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
                    ->where('transaction_details.qty', '>', 1)
                    ->get();

        // No 13
        $data13 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end', 'transaction_details.book_id', 'transaction_details.qty', 'books.title', 'books.price', DB::raw('transaction_details.qty*books.price as total_price'))
                    ->join('transactions', 'members.id', '=', 'transactions.member_id')
                    ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
                    ->join('books', 'transaction_details.book_id', '=', 'books.isbn')
                    ->orderByRaw('transaction_details.transaction_id')
                    ->get();

        // No 14
        $data14 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end', 'transaction_details.book_id', 'transaction_details.qty', 'books.title', 'publishers.publisher_name', 'authors.author_name', 'catalogs.catalog_name')
                    ->join('transactions', 'members.id', '=', 'transactions.member_id')
                    ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
                    ->join('books', 'transaction_details.book_id', '=', 'books.isbn')
                    ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
                    ->join('authors', 'books.author_id', '=', 'authors.id')
                    ->join('catalogs', 'books.catalog_id', '=', 'catalogs.id')
                    ->get();

        // No 15
        $data15 = Catalog::select('catalogs.id', 'catalogs.catalog_name', 'books.title')
                    ->join('books', 'catalogs.id', '=', 'books.catalog_id')
                    ->get();

        // No 16
        $data16 = Book::select('books.*', 'publishers.publisher_name')
                    ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
                    ->get();

        // No 17
        $data17 = Book::select(DB::raw('COUNT(author_id) as total_id5'))
                    ->where('author_id', '=', 5)
                    ->groupBy('author_id')
                    ->get();

        // No 18
        $data18 = Book::select('*')
                    ->where('price', '>', 20000)
                    ->get();

        // No 19
        $data19 = Book::select('books.*')
                    ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
                    ->where([
                        ['publisher_name', '=', 'Candelario Runte'],
                        ['qty', '>', 10],
                    ])
                    ->get();

        // No 20
        $data20 = Member::select('*')
                    ->whereMonth('members.entry_date', '=', '06')
                    ->get();

        // return $data20;
        return view('home');
    }
}
