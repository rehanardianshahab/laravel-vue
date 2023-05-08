@extends('layouts.admin')
@section('header', 'Penjualan')

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="container-fluid">
  <div id="controller">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a href="{{ route('transactions.new') }}" class="btn btn-outline-primary pull-right"><i class="fa-solid fa-square-plus"></i>&nbsp; Tambah Penjualan</a>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <table id="datatable" class="table table-striped table-bordered w-100">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">kode Member</th>
                    <th class="text-center">Total Item</th>
                    <th class="text-center">Total Harga</th>
                    <th class="text-center">Diskon</th>
                    <th class="text-center">Total Bayar</th>
                    <th class="text-center">Diterima</th>
                    <th class="text-center">Kasir</th>
                    <th class="text-center">Opsi</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>


<script type="text/javascript">
  var actionUrl = '{{ url('sales') }}';
  var apiUrl = '{{ url('api/sales') }}';

  var columns = [
    {data: 'DT_RowIndex', class: 'text-center', orderable: true},
    {data: 'created_at', class: 'text-center', orderable: true},
    {data: 'member_code', class: 'text-center', orderable: true},
    {data: 'total_item', class: 'text-center', orderable: true},
    {data: 'total_price', class: 'text-center', orderable: true},
    {data: 'discount', class: 'text-center', orderable: true},
    {data: 'payment', class: 'text-center', orderable: true},
    {data: 'cash', class: 'text-center', orderable: true},
    {data: 'cashier', class: 'text-center', orderable: true},
    {render: function (index, row, data, meta) {
      return `
        <form action="/sales/${data.id}" method="post">
            <a href="/sales/${data.id}" class="btn btn-sm btn-info">
              Detail
            </a>
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            @csrf
            @method('DELETE')
        </form>`;
    }, orderable:false, width: '200px', class: 'text-center'},
  ];

</script>
<script src="{{ asset('js/data.js') }}"></script>

@endsection