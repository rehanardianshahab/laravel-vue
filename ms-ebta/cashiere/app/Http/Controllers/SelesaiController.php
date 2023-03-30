<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\salesDetail;
use App\Models\sale;
use App\Models\setting;

class SelesaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function settingData()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function notaKecil(string $id)
    {
        $setting = Setting::first();
        $sale = sale::find($id);
        $detail = SalesDetail::with('product')
            ->where('sale_id', $id)
            ->get();
        
        return view('print.nota_kecil', compact('setting', 'sale', 'detail'));
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

    public function settingget()
    {
        $setting = Setting::first();
        return $setting;
    }

    public function discount(Request $request)
    {
        // return $request;
        $setting = Setting::first();
        $setting->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data updated',
            'data'    => $setting  
        ], 200);
    }
}
