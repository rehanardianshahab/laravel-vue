<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
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
    public function index()
    {
        // $publisher = Publisher::select('name', 'id')->get();
        // return view('admin/book/index', compact('publisher'));
        return view('admin/book/index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function api()
    {
        $book = Book::all();
        return json_encode($book);
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
      if (auth()->user()->hasrole('administrator')) {
        $this->validate($request, [
            'isbn' => ['required','unique:books'],
            'title' => ['required','unique:books'],
            'year' => ['required'],
            'publisher_id' => ['required'],
            'author_id' => ['required'],
            'catalog_id' => ['required'],
        ]);
        Book::create($request->all());
        return redirect('books')->with('success', 'Data berhasil ditambahkan');
      } else {
        return abort('403');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
      if (auth()->user()->hasrole('administrator')) {
        // return $request->isbn;
        // validasi required laravel
        if ($request->isbn != $book->isbn) {
            $this->validate($request, [
                'isbn' => ['required','unique:books'],
            ]);
        }
        if ($request->title != $book->title) {
            $this->validate($request, [
                'title' => ['required','unique:books'],
            ]);
        }
        $this->validate($request, [
            'year' => ['required'],
            'publisher_id' => ['required'],
            'author_id' => ['required'],
            'catalog_id' => ['required'],
        ]);

        // update data
        $book->update($request->all()); // perlu menambahkan fillable atau guarded di model
      } else {
        return abort('403');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
      if (auth()->user()->hasrole('administrator')) {
        $book->delete();
      } else {
        return abort('403');
      }
    }
}
