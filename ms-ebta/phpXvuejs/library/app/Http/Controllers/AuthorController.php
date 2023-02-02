<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function api()
    {
        $author = Author::all();
        $datatable = datatables()->of($author)->addIndexColumn();

        return  $datatable->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $author = Author::with('books')->get();
        return view('admin.author.index', compact('author'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $route = 'publishers';
        return view('crud.create', [
            'route' => 'author'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        // validasi
        $this->validate($request, [
            'name' => ['required','min:5','max:20'],
            'phone_number' => ['required','numeric'],
            'address' => ['required'],
            'email' => ['required','email', 'unique:authors']
        ]);
        // save data ke database
        $author= new Author;
        $author->name = $request->name;
        $author->phone_number = $request->phone_number;
        $author->address = $request->address;
        $author->email = $request->email;
        $author->save();
        // redirect
        return redirect('authors')->with('success', 'Postingan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        // $author = Author::with('books')->where('id', $author)->get();
        if ($request->email === $author->email) {
            $this->validate($request, [
                'name' => ['required','min:5','max:20'],
                'phone_number' => ['required','numeric'],
                'address' => ['required'],
            ]);
        } else {
            $this->validate($request, [
                'name' => ['required','min:5','max:20'],
                'phone_number' => ['required','numeric'],
                'address' => ['required'],
                'email' => ['required','email', 'unique:authors']
            ]);
        }

        // return $request;
        // Author::where('id', $author->id)->update($author);

 
        $author->update($request->all()); // perlu menambahkan fillable atau guarded di model
        
        return redirect('/authors')->with('success', 'Postingan berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        // return $author;
        $author->delete();
        return redirect('authors')->with('success', 'Postingan berhasil dihapus');;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $author = Author::onlyTrashed()->get();
        $trash = true;
        return view('.admin.author.index', compact('author', 'trash'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore()
    {
        // return $_GET;
        $restore = Author::onlyTrashed()->where('id', $_GET['id'])->restore();
        // return $restore;
        return redirect('authors/trash')->with('success', 'Data berhasil dimutakhirkan');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAll()
    {
        // return $_GET;
        $restore = Author::onlyTrashed()->restore();
        // return $restore;
        return redirect('authors/trash')->with('success', 'Seluruh data berhasil dimutakhirkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function delete()
    {
        Author::onlyTrashed()->where('id', $_GET['id'])->firstOrFail()->forceDelete();
        return redirect('authors/trash')->with('success', 'Data berhasil dihapus permanen');
    }
}
