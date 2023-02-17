@extends('layouts.app3')

@section('css')
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" integrity="sha512-Oy+sz5W86PK0ZIkawrG0iv7XwWhYecM3exvUtMKNJMekGFJtVAhibhRPTpmyTj8+lJCkmWfnpxKgT2OopquBHA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- DataTables -->
  <link rel="stylesheet" href="/assetAdminLte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/assetAdminLte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/assetAdminLte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
<div class="container" id="controllerForVue">
    {{-- modal --}}
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Filter Tanggal Peminjaman</h4>
          </div>
          <div class="modal-body">
            <div class="justify-content-center row  mt-3  mb-2">
              <div class="col-md-6 row">
                <div class="form-group">
                  Dari :
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="bi bi-calendar-week-fill"></i></span>
                    <input type="date" class="form-control bg-body" name="start">
                  </div>
                </div>
              </div>
              <div class="form-group col-md-6">
                Hingga :
                <div class="form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="bi bi-calendar-week-fill"></i></span>
                    <input type="date" class="form-control bg-body" name="end" >
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col text-center">
                <button class="btn btn-primary px-3" id="set">Set</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-11 col-sm-12">

          @if (session('success'))
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                {{ session('success') }}
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          @endif

            <div class="card">
                
                <div class="card-header">
                    {{ __('Transaksi Peminjaman') }}
                    {{-- button expand and exit --}}
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    {{ __('Filter your data transaction!') }}
                    <div class="justify-content-center row  mt-3  mb-2">
                        <div class="col-md-6 row">
                          <div class="form-group col-md-9">
                              <a href="{{ url('transactions') }}/create" class="input-group-prepend">
                                <span class="input-group-text px-5 bg-primary"><i class="bi bi-screwdriver"></i></span>
                                <button type="text" class="form-control bg-body">Make New Transaction</button>
                              </a>
                          </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="bi bi-funnel"></i></span>
                              <select class="form-control select2bs4" style="width: 100%;" name="kondisi">
                                <option value="">Select filter</option>
                                <option value="1">Sudah dikembalikan</option>
                                <option value="0">Belum dikembalikan</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="bi bi-calendar-week-fill"></i></span>
                              <input type="button" class="form-control bg-body" data-toggle="modal" data-target="#modal-default" value="filter time" name="filterTime">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header row">
                    {{-- <a href="/transactions/trash" class="col-6 card-title text-danger text-start d-block"><i class="bi bi-trash3"></i> Data transactions</a>
                    <a class="col-6 card-title text-danger text-end d-block" data-toggle="modal" data-target="#modal-default" @click="addData()">Creat New Book</a> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body pt-1 px-1 row">
                  <table id="datatable" class="table table-sm col col-12 m-1">
                    <thead>
                      <tr>
                        <th style="width: 10px" class="text-center">No</th>
                        <th class="text-center" scope="col">Nama</th>
                        <th class="text-center" scope="col">Tgl. Pinjam</th>
                        <th class="text-center" scope="col">Tgl. Kembali</th>
                        <th class="text-center" scope="col">Durasi Pinjam</th>
                        <th class="text-center" scope="col">Total Buku</th>
                        <th class="text-center" scope="col">Total Bayar</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptLink')
{{-- axios --}}
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
{{-- vuejs --}}
<script src="https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.js"></script>
<!-- Remember to include jQuery :) -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script> --}}
<!-- DataTables  & Plugins -->
<script src="/assetAdminLte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assetAdminLte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assetAdminLte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assetAdminLte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/assetAdminLte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assetAdminLte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/assetAdminLte/plugins/jszip/jszip.min.js"></script>
<script src="/assetAdminLte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/assetAdminLte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/assetAdminLte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/assetAdminLte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/assetAdminLte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
@endsection

@section('js')
  <script>
    // $('#reservationtime').daterangepicker()

    let actionUrl = '{{ url('transactions') }}';
    let apiUrl = '{{ url('api/transactions') }}';

    let columns = [
      {data: 'DT_RowIndex', class: 'text-center', orderable:true},
      {data: 'name', class: 'text-center', orderable:true},
      {data: 'date_start', class: 'text-center', orderable:true},
      {data: 'date_end', class: 'text-center', orderable:true},
      {data: 'durasi', class: 'text-center', orderable:true},
      {data: 'total', class: 'text-center', orderable:true},
      {data: 'harga', class: 'text-center', orderable:true},
      {data: 'stat', class: 'text-center', orderable:true},
      {render: function (index, row, data, meta) {
        return `
          <a href="{{ url('transactions/edit') }}?trans_id=${data.id}&status=${data.status}" class="btn btn-warning btn-sm">Edit</a>
          <a href="{{ url('transactions/detil') }}?trans_id=${data.id}" class="btn btn-secondary btn-sm">Detil</a>
          <form action="{{ url('transactions/delete') }}/${data.id}" method="post" class="d-inline">
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin mau menghapus transaksi ini?')">Hapus</button>
            @method('delete')
            @csrf
          </form>
          `;
      }, orderable: false, width: '200px', class: 'text-center'},
    ];

    let controllerVue = new Vue({
      el: '#controllerForVue',
      data: {
        datas: [],// menampung data author
        data: {},// untuk crud
        actionUrl,//dipakai dengan crud
        apiUrl,//dipakai dengan ajax
        editStatus: false,

      },
      mounted: function () {
        this.datatable();
      },
      methods: {
        datatable() {
          const _this = this;
          _this.table = $('#datatable').DataTable({
            ajax: {
              url: _this.apiUrl,
              type: 'GET',
            },//memanggil data dari data api dengan ajax, disimpan di DataTable
            columns: columns
          }).on('xhr', function () {
            _this.datas = _this.table.ajax.json().data;
          });
        },
      }
    });
  </script>
  {{-- filter --}}
  <script>
    // filter status
    condition = '?kondisi=2';
    filterTglStart = '&tglstart=0';
    filterTglend = '&tglend=0';
    $('select[name=kondisi]').on('change', function () {
      kond = $('select[name=kondisi]').val();
      if (kond != '') {
        condition = '?kondisi='+kond;
      }
      apiUrl = '{{ url('api/transactions') }}'+condition+filterTglStart+filterTglend;
      controllerVue.table.ajax.url(apiUrl).load();
    });

    // mengatasi field tanggal input
    if ($('input[name=start]').val() == '') {
      $( 'input[name=end]' ).prop("disabled", true);
    } else {
      $( 'input[name=end]' ).prop("disabled", false);
    }
    $('input[name=start]').on('change', function () {
      if ($('input[name=start]').val() == '') {
        $( 'input[name=end]' ).prop("disabled", true);
        $( 'input[name=end]' ).val('')
      } else {
        $( 'input[name=end]' ).prop("disabled", false);
        $( 'input[name=end]' ).attr("min", $('input[name=start]').val())
      }
    });

    // filter tanggal
    $('#set').click(function () {
      tglstart = $('input[name=start]').val();
      tglend = $('input[name=end]').val();
      if (tglstart != '') {
        filterTglStart = '&tglstart='+tglstart;
      } else {
        filterTglStart = '&tglstart=0';
      }
      if (tglend != '') {
        filterTglend = '&tglend='+tglend;
      } else {
        filterTglend = '&tglend=0';
      }
      apiUrl = '{{ url('api/transactions') }}'+condition+filterTglStart+filterTglend;
      controllerVue.table.ajax.url(apiUrl).load();

      // isi value di button tanggal
      if (tglstart == '') {
        $('input[name=filterTime]').val('Filter Time')
      } else if (tglend == '') {
        $('input[name=filterTime]').val(tglstart)
      } else {
        $('input[name=filterTime]').val(tglstart+' s/d '+tglend)
      }
      
      // hilangkan modal
      $('.modal').removeClass('in');
      $('.modal').attr("aria-hidden","true");
      $('.modal').css("display", "none");
      $('.modal-backdrop').remove();
      $('body').removeClass('modal-open');
    })
  </script>
@endsection