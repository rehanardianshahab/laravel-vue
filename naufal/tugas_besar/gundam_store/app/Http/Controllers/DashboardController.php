<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\GundamProduct;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_users = User::count();
        $total_transactions = Transaction::count();
        $total_products = GundamProduct::count();
        $total_manufacturers = Manufacturer::count();

        $topManufacture = GundamProduct::select(DB::raw("COUNT(gundam_products.manufacturer_id) as total_manufacture"), 'gundam_products.manufacturer_id', 'manufacturers.manufacture_company')
                            ->join('manufacturers', 'gundam_products.manufacturer_id', '=', 'manufacturers.id')
                            ->groupBy('manufacturer_id')
                            ->orderBy('total_manufacture', 'desc')
                            ->limit(5)
                            ->get();
        
        $prodManufacture = GundamProduct::select(DB::raw("COUNT(gundam_products.manufacturer_id) as total_manufacture"), 'gundam_products.manufacturer_id', 'manufacturers.manufacture_company')
                            ->join('manufacturers', 'gundam_products.manufacturer_id', '=', 'manufacturers.id')
                            ->groupBy('manufacturer_id')
                            ->orderBy('total_manufacture', 'desc')
                            ->get();

        return view('dashboard', compact('total_users', 'total_transactions', 'total_products', 'total_manufacturers', 'topManufacture', 'prodManufacture'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
