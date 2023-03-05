<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::leftJoin('categories', 'categories.id', 'products.category_id')
        ->select('products.*', 'categories.name as category')
        ->orderBy('id', 'desc')->get();

        // return $product;
        return datatables::of($product)
                ->addIndexColumn()
                ->addColumn('select_all', function ($item)
                {
                    return '<input type="checkbox" name="id_products[]" value="'.$item->id.'">';
                })
                ->addColumn('code', function ($item)
                {
                    return '<span class="badge bg-warning text-dark">'.$item->code.'</span>';
                })
                ->addColumn('buy', function ($item)
                {
                    return money_format($item->buying_price, '.', 'Rp ', ',-');
                })
                ->addColumn('sale', function ($item)
                {
                    return money_format($item->selling_price, '.', 'Rp ', ',-');
                })
                ->addColumn('category', function ($item)
                {
                    return $item->category;
                })
                ->addColumn('discountWpres', function ($item)
                {
                    if ($item->discount == 0) {
                        return $item->discount;
                    } else {
                        return $item->discount. " %";
                    };
                })
                ->addColumn('action', function ($product)
                {
                    return 
                    '<div class="btn-group d-flex justify-content-around rounded" role="group" aria-label="Basic example">'.
                        '<button id="a" data-idedit="'.$product->id.'" class="editData btn btn-xs btn-info btn-flat"><i class="bi bi-pencil-square"></i></button>'
                        .'<button data-iddelete="'.$product->id.'" class="deleteData btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>'
                    .'</div>';
                })->rawColumns(['action', 'code', 'select_all'])
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
            'name' => ['required','unique:products'],
            'category_id' => ['required'],
            'buying_price' => ['required'],
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // get product data
        $code = Product::latest()->first();

        if ($code == null) {
            $code = 0;
        } else {
            $code = $code->id;
        }
        $request['code'] = 'PDK'.'.'.$request->category_id.'.'.add_nol((int)$code+1, 5);
        
        //save to database
        $product = Product::create($request->all());

        //success save to database
        if($product) {

            return response()->json([
                'success' => true,
                'message' => 'Data $product berhasil di buat',
                'data'    => $product
            ], 201);

        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Data $product gagal di buat',
        ], 409);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::select('*')->where('id', $id)->get();
        return datatables::of($product)->make(true);
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
        //find post by ID
        $product = Product::findOrFail($id);

        if ($request->name == $product->name) {
            
        } else {
            //set validation
            $validator = Validator::make($request->all(), [
                'name' => ['required','unique:products'],
                'category_id' => ['required'],
                'buying_price' => ['required'],
            ]);
            //response error validation
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        }

        if($product) {

            //update to database
            $product->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'product Updated',
                'data'    => $product  
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
        $product = Product::find($id);
        $product->delete();

        return response()->json('Success updating data', 204);
    }
}
