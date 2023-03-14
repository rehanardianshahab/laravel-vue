<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::orderBy('id', 'desc')->get();

        return datatables()
                ->of($supplier)
                ->addIndexColumn()
                ->addColumn('action', function ($supplier)
                {
                    return 
                    '<div class="btn-group d-flex justify-content-around rounded" role="group" aria-label="Basic example">'.
                        '<a href="#" id="a" data-idedit="'.$supplier->id.'" class="editData btn btn-xs btn-info btn-flat"><i class="bi bi-pencil-square"></i></a>'
                        .'<a href="#" data-iddelete="'.$supplier->id.'" class="deleteData btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></a>'
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
            'name' => ['required'],
            'address' => ['required'],
            'phone' => ['required', 'unique:suppliers'],
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // get supplier data
        $code = Supplier::latest()->first();

        if ($code == null) {
            $code = 0;
        } else {
            $code = $code->id;
        }
        $request['code'] = 'MBR'.'.'.add_nol((int)$code+1, 4);
        $request['phone'] = '0'.(string)$request->phone;
        //save to database
        $supplier = Supplier::create($request->all());

        //success save to database
        if($supplier) {

            return response()->json([
                'success' => true,
                'message' => 'Data supplier berhasil di buat',
                'data'    => $supplier
            ], 201);

        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Data supplier gagal di buat',
        ], 409);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::select('*')->where('id', $id)->get();
        return datatables()
                ->of($supplier)->addColumn('telp', function ($item)
                {
                    return substr((string)$item->phone, 1);
                })->rawColumns(['telp'])->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        //find post by ID
        $supplier = Supplier::findOrFail($request->id);

        $request['phone'] = '0'.(string)$request->phone;

        if ($request->phone == $supplier->phone) {
            
        } else {
            //set validation
            $validator = Validator::make($request->all(), [
                'phone' => ['required', 'unique:suppliers'],
            ]);
            //response error validation
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        }

        
        if($supplier) {
            //update to database
            $supplier = $supplier->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'supplier Updated',
                'data'    => $supplier  
            ], 200);

        }

        //data $supplier not found
        return response()->json([
            'success' => false,
            'message' => 'supplier Not Found',
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return response()->json('Success delete data', 204);
    }
}
