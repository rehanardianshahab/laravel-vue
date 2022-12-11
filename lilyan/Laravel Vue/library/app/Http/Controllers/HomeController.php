<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Catalog;
use App\Models\Member;
use App\Models\Publisher;
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
        // $members = Member::with('user')->get();
        // $books = Book::with('publisher')->get();
        // $publisher = Publisher::with('books')->get();
        // $books = Book::with('author')->get();
        // $author = Author::with('books')->get();      
        // $catalog = Catalog::with('books')->get();
        $books = Book::with('catalog')->get();

        return $books;
        // return $catalog;
        // return $author;
        // return $books;
        // return $publisher;
        // return $books;
        // return $members;

        return view('home');
    }
}
