@extends('master.master')

@section('header', 'PRODUCT TRANSACTIONS')

@section('css')
<link href="{{ asset('assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<a href="/transactions" class="btn btn-sm btn-primary mt-3">Back to Transaction</a>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-primary">
                  <h4 class="text-white">Details</h4>
                </div>
                <div class="card-body">
                  <div class="row font-weight-bold">
                    <div class="col-md-4">
                      <p>Invoice Number</p>
                    </div>
                    <div class="col-md-2">
                      <p>:</p>
                    </div>
                    <div class="col-md-6">
                      <p>{{ $transactions[0]->invoice_number }}</p>
                    </div>
                  </div>

                  <div class="row font-weight-bold">
                    <div class="col-md-4">
                      <p>Name</p>
                    </div>
                    <div class="col-md-2">
                      <p>:</p>
                    </div>
                    <div class="col-md-6">
                      <p>{{ $transactions[0]->name }}</p>
                    </div>
                  </div>

                  <div class="row font-weight-bold">
                    <div class="col-md-4">
                      <p>Purchase Date</p>
                    </div>
                    <div class="col-md-2">
                      <p>:</p>
                    </div>
                    <div class="col-md-6">
                      <p>{{ convert_date($transactions[0]->purchase_date) }}</p>
                    </div>
                  </div>

                  <div class="row font-weight-bold">
                    <div class="col-md-4">
                      <p>Repayment Date</p>
                    </div>
                    <div class="col-md-2">
                      <p>:</p>
                    </div>
                    <div class="col-md-6">
                      <p>{{ convert_date($transactions[0]->repayment_date) }}</p>
                    </div>
                  </div>

                  <div class="row font-weight-bold">
                    <div class="col-md-4">
                      <p>Status Payment</p>
                    </div>
                    <div class="col-md-2">
                      <p>:</p>
                    </div>
                    <div class="col-md-6">
                      <p>{{ show_stat($transactions[0]->status) }}</p>
                    </div>
                  </div>

                  <div class="row">
                    <table class="table">
                      <thead>
                        <tr class="text-center">
                          <th scope="col">#</th>
                          <th scope="col">Product Name</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Price</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($transactions as $key => $transaction)
                        <tr class="text-center">
                          <th scope="row">{{ $key+1 }}</th>
                          <td>{{ $transaction->product_name }}</td>
                          <td>{{ $transaction->purchase_qty }}</td>
                          <td>{{ change_currency($transaction->price) }}</td>
                        </tr>
                        @endforeach
                        <tr class="text-center">
                          <th colspan="3">Total Price</th>
                          <td>{{ change_currency($transactions[0]->total_price) }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  {{-- <a href="/export-pdf/{{ $transactions[0]->id }}" class="btn btn-sm btn-success">Get PDF</a> --}}
                  <a href="/pdf/{{ $transactions[0]->id }}" class="btn btn-sm btn-success">Get PDF</a>
                  {{-- <a href="javascript:void(0)" class="nav-link btn btn-sm btn-success" onclick="export2Pdf()">Download PDF</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
  const export2Pdf = async () => {
 
    let printHideClass = document.querySelectorAll('.print-hide');
    printHideClass.forEach(item => item.style.display = 'none');
    await fetch('http://localhost:8000/export-pdf', {
      method: 'GET'
    }).then(response => {
      if (response.ok) {
        response.json().then(response => {
          var link = document.createElement('a');
          link.href = response;
          link.click();
          printHideClass.forEach(item => item.style.display='');
        });
      }
    }).catch(error => console.log(error));
  }
</script> --}}
@endsection