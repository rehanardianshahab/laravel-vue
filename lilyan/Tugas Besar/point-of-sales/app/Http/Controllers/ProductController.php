<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('product.index', compact('categories'));
    }

    public function api()
    {
        $product = Product::select('products.*', 'name_category')
                ->leftJoin('categories', 'categories.id', 'products.category_id' )
                ->orderBy('id', 'asc')
                ->get();
        
        $datatables = datatables()->of($product)
        ->addIndexColumn()
        ->addColumn('select_all', function ($product) {
            return '<input type="checkbox" name="id[]" value="'. $product->id .'">';
        })
        ->addColumn('harga_beli', function ($product) {
            return currency_IDR($product->purchase_price);
        })
        ->addColumn('harga_jual', function ($product) {
            return currency_IDR($product->selling_price);
        })
        ->rawColumns(['select_all']);
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
    public function store(Request $request, Product $product)
    {   
        $product = Product::latest()->first() ?? new Product();
        $request['product_code'] = 'P'. kode((int)$product->id +1, 6);

        $product = Product::create($request->all());
        $categories = Category::all();


        return view('product.index', compact('categories'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());

        $categories = Category::all();

        return view('product.index', compact('product', 'categories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
        $dataproduk = array();
        foreach ($request->id as $id) {
            $product = Product::find($id);
            $dataproduk[] = $product;
        }
        // return $dataproduk;
        $no  = 1;
        $data = ['dataproduk'=>$dataproduk, 'no'=>$no];
        $pdf = Pdf::loadView('product.barcode', $data);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('produk.pdf');
        
    }
}
