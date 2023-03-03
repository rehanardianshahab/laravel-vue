<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::orderBy('id', 'desc')->get();
        // return $category;
        return datatables::of($category)
                ->addIndexColumn()
                ->addColumn('action', function ($category)
                {
                    return 
                    '<div class="btn-group d-flex justify-content-around rounded" role="group" aria-label="Basic example">'.
                        '<button onclick="editForm(`'.$category->id.'`)" class="btn btn-xs btn-info btn-flat"><i class="bi bi-pencil-square"></i></button>'
                        .'<button onclick="deleteData(`'.$category->id.'`)" class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>'
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
        // $this->validate($request, [
        //     'name' => ['required','unique:categories'],
        // ]);

        //set validation
        $validator = Validator::make($request->all(), [
            'name'   => ['required','unique:categories'],
        ]);
        
        // $category = new Category();
        // $category->name = $request->name;
        // $category->save();

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $category = Category::create([
            'name' => $request->name,
        ]);

        //success save to database
        if($category) {

            return response()->json([
                'success' => true,
                'message' => 'Data category berhasil di buat',
                'data'    => $category
            ], 201);

        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Data category gagal di buat',
        ], 409);

        // return response()->json('Success adding new data', 200);
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
