<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\GundamProduct;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    // public function index($id) 
    // {
        
    //     $products = GundamProduct::all();
    //     $transactions = Transaction::select('transactions.*', 'members.name')
    //     ->join('members', 'transactions.member_id', '=', 'members.id')
    //     ->where('transactions.id', '=', $id)
    //     ->get();

    //     $transDetails = TransactionDetail::select('transaction_details.gundam_product_id', 'transaction_details.purchase_qty', 'gundam_products.product_name', 'gundam_products.price')
    //     ->join('gundam_products', 'transaction_details.gundam_product_id', '=', 'gundam_products.id')
    //     ->where('transaction_details.transaction_id' , '=', $id)
    //     ->get();
        
    //     $data = [
    //         'name' => $transactions->name,
    //         'invoice_number' => $transactions->invoice_number,
    //         'purchase_date' => $transactions->purchase_date,
    //         'repayment_date' => $transactions->repayment_date,
    //         'status' => $transactions->status,
    //         'total_price' => $transactions->total_price
    //     ];

    //     foreach($transDetails as $key => $transDetail)
    //     $data2 = [
    //         'product_name' => $transDetail->product_name,
    //         'purchase_qty' => $transDetail->purchase_qty,
    //         'price' => $transDetail->price,
    //     ];
    //     // return $transactions;
    //     $pdf = PDF::loadView('sample', [$data, $data2]);
    //     return $pdf->stream('resume.pdf');
    // }

    // public function index() 
    // {
    //     $data = [
    //         'imagePath'    => public_path('img/profile.png'),
    //         'name'         => 'John Doe',
    //         'address'      => 'USA',
    //         'mobileNumber' => '000000000',
    //         'email'        => 'john.doe@email.com'
    //     ];
    //     $pdf = PDF::loadView('sample', $data);
    //     return $pdf->stream('resume.pdf');
    // }

    public function index($id) 
    {
        
        $transactions = Transaction::select('transactions.*', 'transaction_details.gundam_product_id', 'transaction_details.purchase_qty', 'members.name', 'gundam_products.product_name', 'gundam_products.price')
                                ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
                                ->join('members', 'transactions.member_id', '=', 'members.id')
                                ->join('gundam_products', 'transaction_details.gundam_product_id', '=', 'gundam_products.id')
                                ->where('transactions.id', '=', $id)
                                ->get();

        $data = [
            'transactions' => $transactions
        ];
        // return $transactions;
        $pdf = PDF::loadView('sample', $data);
        return $pdf->stream('invoice.pdf');
    }
}
