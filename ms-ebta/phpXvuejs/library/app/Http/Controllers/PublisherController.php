<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
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
    
    public function api()
    {
        $publishers = Publisher::all();

        // foreach ($publishers as $key => $publisher) {
        //     $publisher->dibuat = tanggal($publisher->created_at);
        //     // $publisher->dihapus = tanggal($publisher->deleted_at);
        // }

        $datatable = datatables()
                        ->of($publishers)
                        ->addColumn('dibuat', function($publisher) {
                            return tanggal($publisher->created_at);
                        })
                        ->addIndexColumn();

        return  $datatable->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiTrash()
    {
        $publisher = Publisher::onlyTrashed();
        $datatable = datatables()->of($publisher)->addIndexColumn();

        return  $datatable->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $publisher = Publisher::with('books')->get();
        // return view('.admin.publisher.index', compact('publisher'));
        $user = auth()->user();
        // return $user;
        return view('.admin.publisher.index', compact('user'));
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
      if (auth()->user()->hasrole('administrator')) {
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
        redirect('publishers')->with('success', 'Data berhasil ditambahkan');
        return redirect('publishers')->with('success', 'Data berhasil ditambahkan');
      } else {
        return abort('403');
      }
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
      if (auth()->user()->hasrole('administrator')) {
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
      } else {
        return abort('403');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
      if (auth()->user()->hasrole('administrator')) {
        $publisher->delete();
        // return redirect('publishers')->with('success', 'Data berhasil dihapus');
      } else {
        return abort('403');
      }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
      if (auth()->user()->hasrole('administrator')) {
        return view('.admin.publisher.trash');
      } else {
        return abort('403');
      }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore(Publisher $publisher)
    {
      if (auth()->user()->hasrole('administrator')) {
        $restore = Publisher::onlyTrashed()->where('id', $_GET['id'])->restore();
      } else {
        return abort('403');
      }
    }

    public function restoreAll()
    {
      if (auth()->user()->hasrole('administrator')) {
        Publisher::onlyTrashed()->restore();
      } else {
        return abort('403');
      }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAll()
    {
      if (auth()->user()->hasrole('administrator')) {
        // return $_GET;
        $restore = Publisher::onlyTrashed()->restore();
        // return $restore;
        return redirect('publishers/trash')->with('success', 'Seluruh data berhasil dimutakhirkan');
      } else {
        return abort('403');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function delete()
    {
      if (auth()->user()->hasrole('administrator')) {
        Publisher::onlyTrashed()->where('id', $_GET['id'])->firstOrFail()->forceDelete();
      } else {
        return abort('403');
      }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function deleteAll()
    {
      if (auth()->user()->hasrole('administrator')) {
        Publisher::onlyTrashed()->forceDelete();
      } else {
        return abort('403');
      }
    }
}
