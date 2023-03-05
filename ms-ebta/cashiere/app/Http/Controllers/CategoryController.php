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
                        '<button id="a" data-idedit="'.$category->id.'" class="editData btn btn-xs btn-info btn-flat"><i class="bi bi-pencil-square"></i></button>'
                        .'<button data-iddelete="'.$category->id.'" class="deleteData btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>'
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
        //set validation
        $validator = Validator::make($request->all(), [
            'name'   => ['required','unique:categories'/*, 'min:5'*/],
        ]);

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
        $category = Category::select('*')->where('id', $id)->get();
        return datatables::of($category)->make(true);
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
    public function update(Request $request,  Category $category)
    {
        //find post by ID
        $category = Category::findOrFail($category->id);

        if ($request->name == $category->name) {
            
        } else {
            //set validation
            $validator = Validator::make($request->all(), [
                'name'   => ['required','unique:categories'/*, 'min:5'*/],
            ]);
            //response error validation
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        }

        if($category) {

            //update $category
            $category->update([
                'name'     => $request->name
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Category Updated',
                'data'    => $category  
            ], 200);

        }

        //data $category not found
        return response()->json([
            'success' => false,
            'message' => 'Category Not Found',
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();

        return response()->json('Success updating data', 204);
    }
}
