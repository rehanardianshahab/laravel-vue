<?php

namespace App\Http\Controllers;

use App\Models\GundamProduct;
use App\Models\Category;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GundamProductController extends Controller
{
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
        return view('gundamproduct.index');
    }

    public function api() {
        $products = GundamProduct::select('gundam_products.*', 'categories.category_product', 'manufacturers.manufacture_company')
                            ->join('categories', 'gundam_products.category_id', '=', 'categories.id')
                            ->join('manufacturers', 'gundam_products.manufacturer_id', '=', 'manufacturers.id')
                            ->orderBy('gundam_products.id')
                            ->get();

        $datatables = datatables()->of($products)
                        ->addColumn('show_price', function($product) {
                            return change_currency($product->price);
                        })
                        ->addIndexColumn();

        return $datatables->make(true);
    }

    public function getCategory() {
        $category = Category::all();

        return response()->json($category);
    }

    public function getManufacturer() {
        $manufacturer = Manufacturer::all();

        return response()->json($manufacturer);
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => ['required'],
            'price' => ['required'],
            'stock_qty' => ['required'],
            'category_id' => ['required'],
            'manufacturer_id' => ['required']
        ]);

        GundamProduct::create($request->all());

        return redirect('products');
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
        $this->validate($request, [
            'product_name' => ['required'],
            'price' => ['required'],
            'stock_qty' => ['required'],
            'category_id' => ['required'],
            'manufacturer_id' => ['required']
        ]);

        $products = DB::table('gundam_products')
                        ->where('id', $id)
                        ->update([
                            'product_name' => $request['product_name'],
                            'price' => $request['price'],
                            'stock_qty' => $request['stock_qty'],
                            'category_id' => $request['category_id'],
                            'manufacturer_id' => $request['manufacturer_id']
                        ]);

        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = GundamProduct::find($id);
        $products->delete();

        return redirect('products');
    }
}
