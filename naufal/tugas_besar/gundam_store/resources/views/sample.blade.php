<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Detail Transaction</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
      /* .flex-container {
        display: flex;
      } */
      
      p {
        text-align: justify;
      }

      .table {
        text-align: center;
      }
    </style>
</head>
<body>
    {{-- <div style="margin: 0 auto;display: block;width: 500px;">
        <table width="100%" border="1">
            <tr>
                <td colspan="2">
                    <img src="{{$imagePath}}" style="width:200px;"> 
                </td>
            </tr>
            <tr>
                <td>Name:</td>
                <td>{{$name}}</td>
            </tr>
            <tr>
                <td>Address:</td>
                <td>{{$address}}</td>
            </tr>
            <tr>
                <td>Mobile Number:</td>
                <td>{{$mobileNumber}}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{$email}}</td>
            </tr>
        </table>
    </div> --}}

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card row">
                    <div class="card-header bg-primary">
                      <h4 class="text-white">Details</h4>
                    </div>
                    <div class="card-body">
                      <div class="row font-weight-bold">
                        <div class="col-md-4">
                          <p>Invoice Number : {{ $transactions[0]->invoice_number }}</p>
                        </div>
                        {{-- <div class="col-md-2">
                          <p>:</p>
                        </div>
                        <div class="col-md-6">
                          <p>{{ $transactions[0]->invoice_number }}</p>
                        </div> --}}
                      </div>
    
                      <div class="row font-weight-bold">
                        <div class="col-md-4">
                          <p>Name : {{ $transactions[0]->name }}</p>
                        </div>
                        {{-- <div class="col-md-2">
                          <p>:</p>
                        </div>
                        <div class="col-md-6">
                          <p>{{ $transactions[0]->name }}</p>
                        </div> --}}
                      </div>
    
                      <div class="row font-weight-bold">
                        <div class="col-md-4">
                          <p>Purchase Date : {{ convert_date($transactions[0]->purchase_date) }}</p>
                        </div>
                        {{-- <div class="col-md-2">
                          <p>:</p>
                        </div>
                        <div class="col-md-6">
                          <p>{{ $transactions[0]->purchase_date }}</p>
                        </div> --}}
                      </div>
    
                      <div class="row font-weight-bold">
                        <div class="col-md-4">
                          <p>Repayment Date : {{ convert_date($transactions[0]->repayment_date) }}</p>
                        </div>
                        {{-- <div class="col-md-2">
                          <p>:</p>
                        </div>
                        <div class="col-md-6">
                          <p>{{ $transactions[0]->repayment_date }}</p>
                        </div> --}}
                      </div>
    
                      <div class="row font-weight-bold">
                        <div class="col-md-4">
                          <p>Status Payment : {{ show_stat($transactions[0]->status) }}</p>
                        </div>
                        {{-- <div class="col-md-2">
                          <p>:</p>
                        </div>
                        <div class="col-md-6">
                          <p>{{ $transactions[0]->status }}</p>
                        </div> --}}
                      </div>
    
                      <div class="row">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Product Name</th>
                              <th scope="col">Quantity</th>
                              <th scope="col">Price</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($transactions as $key => $transaction)
                            <tr>
                              <th scope="row">{{ $key+1 }}</th>
                              <td>{{ $transaction->product_name }}</td>
                              <td>{{ $transaction->purchase_qty }}</td>
                              <td>{{ change_currency($transaction->price) }}</td>
                            </tr>
                            @endforeach
                            <tr>
                              <th colspan="3" class="text-center">Total Price</th>
                              <td>{{ change_currency($transactions[0]->total_price) }}</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="flex-container">
      <div class="container">
        <div class="item"><p>Invoice Number</p></div>
        <div class="item"><p>:</p></div>
        <div class="item"><p>{{ $transactions[0]->invoice_number }}</p></div>
      </div>
      <div class="container">
        <div class="item"><p>Name</p></div>
        <div class="item"><p>:</p></div>
        <div class="item"><p>{{ $transactions[0]->name }}</p></div>
      </div>
      <div class="container">
        <div class="item"><p>Purchase Date</p></div>
        <div class="item"><p>:</p></div>
        <div class="item"><p>{{ $transactions[0]->purchase_date }}</p></div>
      </div>
      <div class="container">
        <div class="item"><p>Repayment Date</p></div>
        <div class="item"><p>:</p></div>
        <div class="item"><p>{{ $transactions[0]->repayment_date }}</p></div>
      </div>
      <div class="container">
        <div class="item"><p>Status Payment</p></div>
        <div class="item"><p>:</p></div>
        <div class="item"><p>{{ $transactions[0]->status }}</p></div>
      </div>
      <div class="datatable">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Product Name</th>
              <th scope="col">Quantity</th>
              <th scope="col">Price</th>
            </tr>
          </thead>
          <tbody>
            @foreach($transactions as $key => $transaction)
            <tr>
              <th scope="row">{{ $key+1 }}</th>
              <td>{{ $transaction->product_name }}</td>
              <td>{{ $transaction->purchase_qty }}</td>
              <td>{{ $transaction->price }}</td>
            </tr>
            @endforeach
            <tr>
              <th colspan="3" class="text-center">Total Price</th>
              <td>{{ $transactions[0]->total_price }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div> --}}
</body>
</html>