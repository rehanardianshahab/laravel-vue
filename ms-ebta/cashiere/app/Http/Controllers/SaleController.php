<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // return 'hai';
        $selling = new Sale();
        $selling->member_id = null;
        $selling->total_item = 0;
        $selling->pricing_total = 0;
        $selling->discount = 0;
        $selling->subtotal_prices = 0;
        $selling->customer_money = 0;
        $selling->user_id = Auth::id();
        // $user = auth('api')->user();
        //$user auth('sanctum')->check();
        // return Auth::check('sanctum');
        $selling->save();

        $saleNews = Sale::orderBy('id', 'desc')->get();;
        $saleNewst = $saleNews[0];

        return response()->json([
            'success' => true,
            'message' => 'saling Updated',
            'data'    => $saleNewst 
        ], 200);
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
