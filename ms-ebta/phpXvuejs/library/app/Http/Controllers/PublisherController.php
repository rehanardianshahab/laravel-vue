<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $publisher = Publisher::with('books')->get();
        return view('.admin.publisher.index', compact('publisher'));
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
            'route' => 'publishers'
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
        $this->validate($request, [
            'name' => ['required','min:5','max:20'],
            'phone_number' => ['required','numeric'],
            'address' => ['required'],
            'email' => ['required','email', 'unique:publishers']
        ]);
        // return $request;
        // save data ke database
        $publisher= new Publisher;
        $publisher->name = $request->name;
        $publisher->phone_number = $request->phone_number;
        $publisher->address = $request->address;
        $publisher->email = $request->email;

        $publisher->save();
        // redirect
        return redirect('publishers')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function edit(Publisher $publisher)
    {
        $data = Publisher::find($_GET['id']);
        $route = 'publishers';
        return view('crud/edit', compact('route', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publisher $publisher)
    {
        // validasi required laravel
        if ($request->email === $publisher->email) {
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
                'email' => ['required','email', 'unique:publishers']
            ]);
        }

        // update data
        $publisher->update($request->all()); // perlu menambahkan fillable atau guarded di model

        // redirect
        return redirect('publishers')->with('success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        return redirect('publishers')->with('success', 'Data berhasil dihapus');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $publisher = Publisher::onlyTrashed()->get();
        $trash = true;
        return view('.admin.publisher.index', compact('publisher', 'trash'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore()
    {
        // return $_GET;
        $restore = Publisher::onlyTrashed()->where('id', $_GET['id'])->restore();
        // return $restore;
        return redirect('publishers/trash')->with('success', 'Data berhasil dimutakhirkan');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAll()
    {
        // return $_GET;
        $restore = Publisher::onlyTrashed()->restore();
        // return $restore;
        return redirect('publishers/trash')->with('success', 'Seluruh data berhasil dimutakhirkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function delete()
    {
        Publisher::onlyTrashed()->where('id', $_GET['id'])->firstOrFail()->forceDelete();
        return redirect('publishers/trash')->with('success', 'Data berhasil dihapus permanen');
    }
    
}
