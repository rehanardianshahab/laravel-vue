<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function api()
    {
        $member = Catalog::all();
        $datatable = datatables()->of($member)->addIndexColumn();

        return  $datatable->make(true);
    }
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
        // return $request; // testing data dari  post
        $this->validate($request, [
            'name' => ['required','min:5','max:20']
        ]);


        // cara1: save data ke database
        // $catalog= new Catalog;
        // $catalog->name = $request->name;
        // $catalog->save();

        // cara2: save data ke database
        Catalog::create($request->all()); // perlu menambahkan fillable atau guarded di model

        // redirect
        return redirect('catalogs')->with('success', 'Data berhasil ditambahkan');
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
        return redirect('catalogs')->with('success', 'Data berhasil ditambahkan');
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
        return redirect('catalogs')->with('success', 'Data berhasil dihapuskan');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $catalogs = Catalog::onlyTrashed()->get();
        $trash = true;
        return view('.admin.catalog.index', compact('catalogs', 'trash'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore()
    {
        // return $_GET;
        $restore = Catalog::onlyTrashed()->where('id', $_GET['id'])->restore();
        // return $restore;
        return redirect('catalogs/trash')->with('success', 'Data berhasil dimutakhirkan');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAll()
    {
        // return $_GET;
        $restore = Catalog::onlyTrashed()->restore();
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
        Catalog::onlyTrashed()->where('id', $_GET['id'])->firstOrFail()->forceDelete();
        return redirect('catalogs/trash')->with('success', 'Data berhasil dihapus permanen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function deleteAll()
    {
        Catalog::onlyTrashed()->forceDelete();
        return redirect('catalogs/trash')->with('success', 'Semua data berhasil dihapus permanen');
    }
}
