<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $catalogs = Catalog::all('book');
        $catalogs = Catalog::with('books')->get();
        // return($catalogs);
        return view('admin/catalog/index', compact("catalogs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = 'catalogs';
        return view('crud/create', compact('route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi required laravel
        $this->validate($request, [
            'name' => ['required']
        ]);

        // return $request; // testing data dari  post

        // cara1: save data ke database
        // $catalog= new Catalog;
        // $catalog->name = $request->name;
        // $catalog->save();

        // cara2: save data ke database
        Catalog::create($request->all()); // perlu menambahkan fillable atau guarded di model

        // redirect
        return redirect('catalogs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function show(Catalog $catalog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function edit(Catalog $catalog)
    {
        $data = Catalog::find($_GET['id']);
        $route = 'catalogs';
        return view('crud/edit', compact('route', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catalog $catalog)
    {
        // validasi required laravel
        $this->validate($request, [
            'name' => ['required']
        ]);
        // update data
        $catalog->update($request->all()); // perlu menambahkan fillable atau guarded di model

        // redirect
        return redirect('catalogs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalog $catalog)
    {
        $catalog->delete();
        return redirect('catalogs');
    }
}
