<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Member;
use App\Models\Publisher;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $total_anggota = Member::count();
        $total_buku = Book::count();
        $total_peminjaman = Transaction::whereMonth('date_start', date('m'))->count();
        $total_penerbit = Publisher::count();

        // Data Donut
        $data_donut = Book::select(DB::raw("COUNT(publisher_id) as total"))
        ->groupBy('publisher_id')
        ->orderBy('publisher_id', 'asc')
        ->pluck('total');

        $label_donut = Publisher::orderBy('publishers.id', 'asc')
        ->join('books', 'books.publisher_id', '=', 'publishers.id')
        ->groupBy('name')->pluck('name');

        // Data Bar
        $label_bar = ['Peminjaman', 'Pengembalian'];
        $data_bar = [];

        foreach ($label_bar as $key => $value) {
            $data_bar[$key]['label'] = $label_bar[$key];
            $data_bar[$key]['backgroundColor'] = $key == 0 ? 'rgba(60, 141, 188, 0.9)' : 'rgba(210, 214, 222, 1)';
            $data_month = [];

            foreach (range(1,12) as $month) {
                if ($key == 0) {
                    $data_month[] = Transaction::select(DB::raw("COUNT(*) as total"))
                    ->whereMonth('date_start', $month)
                    ->first()->total;
                } else {
                    $data_month[] = Transaction::select(DB::raw("COUNT(*) as total"))
                    ->whereMonth('date_end', $month)
                    ->first()->total;
                }           
            }

            $data_bar[$key]['data'] = $data_month;
        }

        // Data Pai
        $data_pie = Book::select(DB::raw("COUNT(author_id) as total"))
        ->groupBy('author_id')
        ->orderBy('author_id', 'asc')
        ->pluck('total');

        $label_pie = Author::orderBy('authors.id', 'asc')
        ->join('books', 'books.author_id', '=', 'authors.id')
        ->groupBy('name')->pluck('name');

        return view('home', compact('total_buku','total_anggota','total_peminjaman','total_penerbit',
        'data_donut','label_donut','data_bar','data_pie', 'label_pie'));
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
