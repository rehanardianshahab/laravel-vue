<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use App\Models\Member;
// use App\Models\Publisher;
// use App\Models\Catalog;
// use App\Models\Author;
// use App\Models\Book;

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
        return Transaction::with('Member')->get();
        // return Book::with('Publisher')->get();
        // return Publisher::with('Books')->get();
        // return Catalog::with('Books')->get();
        // return Book::with('Catalog')->get();
        // return Author::with('Books')->get();
        // return Book::with('Author')->get();
        // return Book::with('Author', 'Catalog', 'Publisher')->get();
        return view('home');
    }
}
