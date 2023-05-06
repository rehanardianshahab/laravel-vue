<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Member;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = Product::count();
        $supplier = Supplier::count();
        $member = Member::count();
        $sale = Sale::count();
        
        $dataBars = $this->barChart();

        return view('dashboard', compact('product', 'supplier', 'member', 'sale', 'dataBars'));
    }

    public function barChart()
    {
        $barChartlabel = ['pemasukan', 'pengeluaran'];
        $dataBars = [];
        foreach ($barChartlabel as $key => $value) {
            $dataBars[$key]['label'] = $barChartlabel[$key];
            $dataBars[$key]['backgroundColor'] = $key == 0 ? "lightgray" : "lightblue" ;
            $dataSets = [];
            for ($i=1; $i < 12; $i++) {
                if ($key == 0) {
                    array_push($dataSets, Sale::whereMonth('created_at', $i)->sum('payment'));
                } else {
                    array_push($dataSets, Expense::whereMonth('created_at', $i)->sum('nominal'));
                }

            }
            $dataBars[$key]['data'] = $dataSets;
        }

        return $dataBars;
    }
}
