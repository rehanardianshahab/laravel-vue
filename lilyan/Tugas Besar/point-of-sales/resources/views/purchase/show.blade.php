@extends('layouts.admin')
@section('header', 'Detail Pembelian')

@section('content')
<div class="container-fluid">
  <div id="controller">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a href="{{ url('purchases') }}" class="btn btn-outline-primary pull-right"><i class="fa-solid fa-rotate-left"></i>&nbsp; Kembali Ke Daftar Pembelian</a>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <div class="card-responsive">
                <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Kode</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($purchaseDetail as $key => $detail)
                                
                    <tr>
                      <td class="text-center">{{ $key+1 }}</td>
                      <td class="text-center">{{ $detail->product_code }}</td>
                      <td class="text-center">{{ $detail->name_product }}</td>
                      <td class="text-center">{{ currency_IDR($detail->purchase_price) }}</td>
                      <td class="text-center">{{ $detail->amount }}</td>
                      <td class="text-center">{{ currency_IDR($detail->subtotal) }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection