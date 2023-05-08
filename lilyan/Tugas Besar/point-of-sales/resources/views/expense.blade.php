@extends('layouts.admin')
@section('header', 'Pengeluaran')

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
            <a href="#" @click="addData()" class="btn btn-outline-primary pull-right"><i class="fa-solid fa-square-plus"></i>&nbsp; Tambah Pengeluaran</a>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <table id="datatable" class="table table-striped table-bordered w-100">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Jenis Pengeluaran</th>
                    <th class="text-center">Nominal</th>
                    <th class="text-right">Opsi</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" :action="actionUrl" autocomplete="off" @submit="submitForm($event, data.id)">
            <div class="modal-header">
              <h4 class="modal-title">Pengeluaran</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              @csrf
              <input type="hidden" name="_method" value="PUT" v-if="editStatus">
                {{-- <div class="form-group">
                  <label>Tanggal</label>
                  <input type="date" name="created_at" class="form-control" placeholder="Masukan tanggal" :value="data.created_at" required="">
                </div>  --}}
                <div class="form-group">
                    <label>Jenis Pengeluaran</label>
                    <input type="text" name="description" class="form-control" placeholder="Masukan jenis pengeluaran" :value="data.description" required="">
                </div> 
                <div class="form-group">
                    <label>Nominal</label>
                    <input type="number" name="nominal" class="form-control" placeholder="Masukan nominal" :value="data.nominal" required="">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark"></i>&nbsp; Tutup</button>
              <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i>&nbsp; Simpan</button>
            </div>
            </form>
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

<script type="text/javascript">
  var actionUrl = '{{ url('expenses') }}';
  var apiUrl = '{{ url('api/expenses') }}';

  var columns = [
    {data: 'DT_RowIndex', class: 'text-center', orderable: true},
    {data: 'created_at', class: 'text-center', orderable: true},
    {data: 'description', class: 'text-center', orderable: true},
    {data: 'nominal_angka', class: 'text-center', orderable: true},
    {render: function (index, row, data, meta) {
      return `
      <a href="#" class="btn btn-warning btn-sm" onclick="controller.editData(event,
      ${meta.row})">
      <i class="fa-regular fa-pen-to-square"></i> Edit
      </a>
      <a class="btn btn-danger btn-sm" onclick="controller.deleteData(event,
      ${data.id})">
      <i class="fa-solid fa-trash-can"></i> Delete
      </a>`;
    }, orderable:false, width: '200px', class: 'text-center'},
  ];
</script>

<script src="{{ asset('js/data.js') }}"></script>

@endsection