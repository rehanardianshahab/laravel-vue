<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return "hallo";
        $category = Category::orderBy('id', 'desc')->get();

        return datatables::
                of($category)
                ->addIndexColumn()
                ->addColumn('action', function ($category)
                {
                    return 
                    '<div class="btn-group d-flex justify-content-around rounded" role="group" aria-label="Basic example">'.
                        '<button onclick="editForm(`'.route('category.update', $category->id).'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-edit"></i></button>'
                        .'<button onclick="deleteData(`'.route('category.destroy', $category->id).'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>'
                    .'</div>';
                })->rawColumns(['action'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
