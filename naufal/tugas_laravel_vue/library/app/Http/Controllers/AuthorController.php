<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.author.index');
    }

    public function api() {
        $authors = Author::all();
        $datatables = datatables()->of($authors)->addIndexColumn();

        return $datatables->make(true);
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
        $this->validate($request, [
            'author_name' => ['required', 'unique:authors'],
            'email' => ['required', 'unique:authors', 'max:255'],
            'phone_number' => ['required', 'unique:authors', 'max:13'],
            'address' => ['required'],
        ]);

        Author::create($request->all());

        return redirect('authors');
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
        $this->validate($request, [
            'author_name' => ['required', Rule::unique('authors')->ignore($author->id)],
            'email' => ['required', Rule::unique('authors')->ignore($author->id), 'max:255'],
            'phone_number' => ['required', Rule::unique('authors')->ignore($author->id), 'max:13'],
            'address' => ['required'],
        ]);

        $author->update($request->all());

        return redirect('authors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
    }
}
