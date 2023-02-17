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
<div class="modal fade" id="modal-lg">
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
        <input type="hidden" name="_method" value="PUT" v-if="statusEdit">
          @csrf {{-- untuk get token --}}
          <div class="card-body">
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
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info">@{{  tombol  }}</button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


{{-- <div class="container"> --}}
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('Authors') }}<span style="float:right;">
          @can('mengelola peminjaman')
          @if (isset($trash))
            <a href="{{ url('/authors') }}">Back</a></span>
          @else
            <a href="#" @click="addData()" data-toggle="modal" data-target="#modal-lg">Tambah data</a></span>
          @endif
          @endcan
        </div>
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

            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="card">

                  @can('mengelola peminjaman')
                  <div class="card-header">
                    @if (isset($trash))
                    @else
                      <a href="/authors/trash" class="card-title text-danger text-end d-block"><i class="bi bi-trash3"></i> Data Penulis</a>
                    @endif
                  </div><!-- /.card-header -->
                  @endcan

                <div class="card-body px-1 p-0 pt-1">
                  <table id="datatable" class="table table-sm">
                    <thead>
                      <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Telp.</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Dibuat pada</th>
                        @can('mengelola peminjaman')
                        <th class="text-center">Aksi</th>
                        @endcan
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($author as $key => $item)
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ $item->name }}</td>
                          <td class="text-center">{{ $item->phone_number }}</td>
                          <td class="text-center">{{ $item->address }}</td>
                          <td class="text-center">{{ $item->email }}</td>
                          <td class="text-center">{{ tanggal($item->created_at) }}</td>
                          @can('mengelola peminjaman')
                          @if (isset($trash))
                          <td class="text-center">
                            <form action="/authors/author" method="get">
                              <input type="hidden" value="{{ $item->id }}" name="id">
                              <button type="submit" style="border:none; background:none; display:inline; color:blue; text-decoration:none;">Restore</button>
                                      {{-- @method('head') --}}
                              @csrf
                            </form>
                            {{-- <a href="/publish{{ $item->id }}">restore</a> --}}
                            <form action="/authors/force-delete" method="get">
                              <input type="hidden" value="{{ $item->id }}" name="id">
                              <button type="submit" style="border:none; background:none; display:inline; color:red; text-decoration:none;" onclick="return confirm('Apakah anda yakin mau menghapus publiser {{ $item->name }}?')">Hapus</button>
                              @csrf
                            </form>
                          </td>
                          @else
                          <td class="text-center">
                            <a href="#" @click="editData({{ $item }})"  class="text-success" data-toggle="modal" data-target="#modal-lg">Perbarui</a>  
                            <form action="/authors/{{ $item->id }}" method="post">
                              <button type="submit" style="border:none; background:none; display:inline; color:red; text-decoration:none;" onclick="return confirm('Apakah anda yakin mau menghapus publiser {{ $item->name }}?')">Hapus</button>
                              @method('delete')
                              @csrf
                            </form>
                          </td>
                          @endif
                          @endcan
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div>
                    @if (isset($trash))
                    <div class="text-center">
                      <a href="/authors/restore-all" class="btn btn-primary btn-sm m-1" onclick="return confirm('Apakah anda yakin mau merestore semua data?')">Restore Semua</a>
                      <a href="/authors/delete-all" class="btn btn-secondary btn-sm m-1" onclick="return confirm('Apakah anda yakin mau menghapus permanen semua data}?')">Hapus Semua</a>
                    </div>
                    @endif
                  </div>
                </div><!-- /.card-body -->
              </div><!-- class row -->
            </div><!-- /.card -->
          </div><!-- /.card-body -->
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
  <script>
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
  </script>

  <script>
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
  </script>
@endsection