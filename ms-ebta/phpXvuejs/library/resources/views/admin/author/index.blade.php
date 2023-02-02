@extends('layouts.app3')

@section('css')
  {{-- bootsrap icons --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" integrity="sha512-Oy+sz5W86PK0ZIkawrG0iv7XwWhYecM3exvUtMKNJMekGFJtVAhibhRPTpmyTj8+lJCkmWfnpxKgT2OopquBHA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- DataTables -->
  <link rel="stylesheet" href="/assetAdminLte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/assetAdminLte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/assetAdminLte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
<div id="controllerForVue">
{{-- modal --}}
{{-- <div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" :action="actionUrl" method="post">
      <div class="modal-header">
        <h4 class="modal-title">@{{ titleBox }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="_method" value="PUT" v-if="statusEdit"> --}}
          {{-- @csrf untuk get token --}}
          {{-- <div class="card-body">
              <div class="form-group row">
                  <label for="inputNamaAuthor" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputNamaAuthor"  autocomplete="off" placeholder="Nama Author" name="name"  :value="dataPenulis.name" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="inputNomorAuthor" class="col-sm-2 col-form-label">Nomor Telphone</label>
                  <div class="col-sm-10">
                      <input type="number" class="form-control" id="inputNomorAuthor" placeholder="No. Telp." name="phone_number" :value="dataPenulis.phone_number" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="inputAlamatAuthor" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputAlamatAuthor" placeholder="Alamat" name="address" :value="dataPenulis.address" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="inputEmailAuthor" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmailAuthor" placeholder="email" name="email" :value="dataPenulis.email" required>
                  </div>
              </div>
          </div>
          <!-- /.card-body -->
        <!-- /.card-footer -->
      </div> --}}
      {{-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info">@{{  tombol  }}</button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div> --}}


{{-- <div class="container"> --}}
  <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header">{{ __('Authors') }}<span style="float:right;"><a href="#"   @click="addData()" data-toggle="modal" data-target="#modal-lg">Tambah data</a></span></div>

              <div class="card-body">
                  @if (session('success'))
                      <div class="alert alert-success" role="alert">
                          {{ session('success') }}
                      </div>
                  @endif

                  {{-- error input --}}
                  @if (count($errors) > 0)
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif

                  <div class="card">
                      <div class="card-header">
                        @if (isset($trash))
                        @else
                          <a href="/authors/trash" class="card-title text-danger text-end d-block"><i class="bi bi-trash3"></i> Data Penulis</a>
                        @endif
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body px-1 p-0 pt-1">
                        <table id="datatable" class="table table-sm">
                          <thead>
                            <tr>
                              <th class="text-center">No</th>
                              <th class="text-center">Nama</th>
                              <th class="text-center">Telp.</th>
                              <th class="text-center">Alamat</th>
                              <th class="text-center">Email</th>
                              <th class="text-center">Aksi</th>
                            </tr>
                          </thead>
                          {{-- <tbody>
                            
                          </tbody> --}}
                        </table>
                      </div>
                      <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
              </div>
              <!-- /.card-body -->
            </div>
          </div>
      </div>
  </div>
{{-- <div> --}}
@endsection

@section('scriptLink')
{{-- axios --}}
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
{{-- vuejs --}}
<script src="https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.js"></script>
<!-- Remember to include jQuery :) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
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
  {{-- <script>
    // vue js
    var controllerVue = new Vue({
      el: '#controllerForVue',
      data: {
        dataPenulis: {},
        titleBox: '',
        tombol: '',
        actionUrl: '{{ url('authors') }}',
        statusEdit: false,
        notstatusEdit: true,
      },
      mounted: function () {// fungsi yang akan dijalankan ketika membuka halaman
        
      },
      methods: {
        addData() {
          this.titleBox = 'Tambah Data';
          this.dataPenulis = '';
          this.tombol = 'Tambah';
          this.statusEdit = false;
          this.notstatusEdit = true;
        },
        editData( data ) {
          this.dataPenulis = data;
          this.titleBox = 'Edit Data';
          this.tombol = 'Edit';
          this.actionUrl = 'authors/'+data.id;
          this.statusEdit = true;
          this.notstatusEdit = false;
        },
        deleteData() {

        }
      }
    });
  </script> --}}

  {{-- script untuk datatable tajrabox --}}
  <script>
    let actionUrl = '{{ url('authors') }}';
    let apiUrl = '{{ url('api/authors') }}';

    let columns = [
      {data: 'DT_RowIndex', class: 'text-center', orderable:true},
      {data: 'name', class: 'text-center', orderable:true},
      {data: 'phone_number', class: 'text-center', orderable:true},
      {data: 'address', class: 'text-center', orderable:true},
      {data: 'email', class: 'text-center', orderable:true},
      {render: function (index, row, data, meta) {
        return `
          <a href="#" class="btn btn-warning btn-sm" onclick="controller.editData(event, ${meta.row})">Edit</a>
          <a href="#" class="btn btn-danger btn-sm" onclick="controller.deletData(event, ${data.id})">Delete</a>`;
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
  <!-- Page specific script -->
  {{-- <script>
    $(function () {
      $("#datatable").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script> --}}
@endsection