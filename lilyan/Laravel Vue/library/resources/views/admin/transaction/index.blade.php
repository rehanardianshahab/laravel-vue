@extends('layouts.admin')
@section('header', 'Transaction')

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
  @role('admin')
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">

                @if (session('status'))
                    <div class="alert alert-success alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa fa-check"></i> Success!</h4>
                      {{ session('status') }}
                    </div>
                @endif
                
              <div class="card-header">
                <div class="row">
                  <div class="col-md-8">
                    <a href="{{ url('transactions/create') }}" class="btn btn-primary pull-right">Create New Transaction</a>
                  </div>
                  
                  <div class="row">
                    <div class="col">
                      <form class="form-inline" action="{{ url('transactions') }}" method="GET">
                        @csrf
                        {{-- Filter Status --}}
                          <select name="status" class="form-control">
                            <option value="">Filter Status</option>
                            <option value="1">Sudah Dikembalikan</option>
                            <option value="0">Belum Dikembalikan</option>
                          </select>
                        
                        {{-- Filter Tanggal Pinjam --}}
                          <input class="form-control ml-3" type="date" name="date_start">
    
                        {{-- Button Filter --}}
                        <button type="submit" class="btn btn-info ml-3">Filter</button>
                      </form>
                    </div>
                  </div>

                </div>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th class="text-center">Tanggal Pinjam</th>
                      <th class="text-center">Tanggal Kembali</th>
                      <th class="text-center">Nama Peminjam</th>
                      <th class="text-center">Durasi Peminjaman (hari)</th>
                      <th class="text-center">Total Buku</th>
                      <th class="text-center">Total Bayar</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($transactions as $key => $transaction)
                                
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td class="text-center">{{ date_formater($transaction->date_start) }}</td>
                      <td class="text-center">{{ date_formater($transaction->date_end) }}</td>
                      <td>{{ $transaction->member->name }}</td>
                      <td class="text-center">{{ durasi_hari($transaction->date_start, $transaction->date_end) }}</td>
                      <td class="text-center">{{ $transaction->total_buku }}</td>
                      <td class="text-center">{{ currency_IDR($transaction->total_harga) }}</td>
                      <td>{{ detail_status($transaction->status) }}</td>

                      {{-- Action --}}
                      <td width="10%">
                        <div class="btn-group" role="group" aria-label="Basic example">

                        @if ($transaction->status == 1)
                        <a href="{{ url('transactions/'.$transaction->id.'/show') }}" class="btn btn-sm btn-success ml-5">Detail</a>
                        
                        
                        @elseif ($transaction->status == 0)
                        <a href="{{ url('transactions/'.$transaction->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ url('transactions/'.$transaction->id.'/show') }}" class="btn btn-sm btn-success ml-1">Detail</a>
                        
                        <form action="{{ url('transactions', ['id' => $transaction->id]) }}" method="post">
                          @method('delete')
                          @csrf
                          <button type="submit" class="btn btn-sm btn-danger ml-1"
                          value="Delete" onclick="return confirm('Are you sure?')">Hapus</button>
                        </form>
                        @endif
                        
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  @endrole
@endsection

@section('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script type="text/javascript">
  $(function () {
    $("#datatable").DataTable();
  });
</script>
@endsection