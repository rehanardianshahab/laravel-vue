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
<div id="controllerForVue">
  {{-- modal --}}
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form class="form-horizontal" :action="actionUrl" method="post" autocomplete="off" @submit="submitForm($event, data.id)">
        <div class="modal-header">
          <h4 class="modal-title">@{{ titleBox }}</h4>
          <button title="close modal v1" type="submit" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="text-danger text-center" id="eror"></div>
        <div class="modal-body">
          {{-- <input type="hidden" name="_method" value="PUT" v-if="statusEdit"> --}}
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
          <button title="close modal" type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
          <button title="submit data" type="submit" class="btn btn-info">@{{  tombol  }}</button>
        </div>
      </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

{{-- <div class="container"> --}}
    <div class="row justify-content-center">
        <div class="col-md-11 col-sm-12">
            <div class="card">
              @can('mengelola peminjaman')
                <div class="card-header">{{ __('Data Publiser') }}<span style="float:right;"><a href="#"   @click="addData()" data-toggle="modal" data-target="#modal-default">Tambah data</a></span></div>
              @endcan
                <div class="card-body">
                    {{-- @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif --}}
                    <div id="notif"></div>
                    <div id="erorDelete"></div>
                    
                    {{-- error input --}}
                  {{-- @if (count($errors) > 0)
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif --}}

                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          @can('mengelola peminjaman')
                          <div class="card-header">
                              <a href="/publishers/trash" class="card-title text-danger text-end d-block"><i class="bi bi-trash3"></i> Data Publishers</a>
                          </div>
                          @endcan
                          <!-- /.card-header -->
                          <div class="card-body pt-1 px-1 row">
                            <table id="datatable" class="table table-sm col col-12">
                              <thead>
                                <tr>
                                  <th style="width: 10px" class="text-center">No</th>
                                  <th class="text-center" scope="col">Nama</th>
                                  <th class="text-center" scope="col">Telp.</th>
                                  <th class="text-center" scope="col">Alamat</th>
                                  <th class="text-center" scope="col">Email</th>
                                  <th class="text-center" scope="col">Dibuat pada</th>
                                  @can('mengelola peminjaman')
                                  <th class="text-center" scope="col">Aksi</th>
                                  @endcan
                                </tr>
                              </thead>
                              <tbody>

                              </tbody>
                            </table>
                            <input type="hidden" id="role" value="{{ $user->role == 1 ? $user->role : null }}">
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- </div> --}}
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
        actionUrl: '',
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
          this.actionUrl = '{{ url('publishers/create') }}',
          this.notstatusEdit = true;
        },
        editData( data ) {
          this.dataPenulis = data;
          this.titleBox = 'Edit Data';
          this.tombol = 'Edit';
          this.actionUrl = '/publishers/'+data.id+'/update';
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
      $("#example1").DataTable({
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
  {{-- script untuk datatable yajrabox --}}
  <script>
    let role = $('#role').val();
    let columns;
    if (role == 1) {
      columns = [
        {data: 'DT_RowIndex', class: 'text-center', orderable:true},
        {data: 'name', class: 'text-center', orderable:true},
        {data: 'phone_number', class: 'text-center', orderable:true},
        {data: 'address', class: 'text-center', orderable:true},
        {data: 'email', class: 'text-center', orderable:true},
        {data: 'dibuat', class: 'text-center', orderable:true},
        {render: function (index, row, data, meta) {
          return `
            <a href="#" class="btn btn-warning btn-sm" onclick="controllerVue.editData(event, ${meta.row})" data-toggle="modal" data-target="#modal-default">Edit</a>
            <a href="#" class="btn btn-danger btn-sm" onclick="controllerVue.deletData(event, ${data.id})">Delet</a>
            <!--<a href="/publishers/${data.id}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin mau menghapus publiser ${data.id}?'); controllerVue.deletData(event, ${data.id})">Delete</a>-->
            <!--<form action="{{ url('publishers') }}/${data.id}/delete" method="post" @submit="controllerVue.deletData(event, ${data.id})">-->
              <!--<button type="submit" class="btn btn-danger btn-sm" onclick="controllerVue.deletData(event, ${data.id})">Delete</buttton>-->
              <!--<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin mau menghapus publiser ${data.id}?'); controllerVue.deletData(event, ${data.id}, ${meta.row})">Delete</buttton>-->
              <!--<button type="submit" class="btn btn-danger btn-sm">Hapus</button>
              @method('delete')
              @csrf
            </form>-->
            `;
        }, orderable: false, width: '200px', class: 'text-center'},
      ];
    } else {
      // console.log("duh");
      columns = [
        {data: 'DT_RowIndex', class: 'text-center', orderable:true},
        {data: 'name', class: 'text-center', orderable:true},
        {data: 'phone_number', class: 'text-center', orderable:true},
        {data: 'address', class: 'text-center', orderable:true},
        {data: 'email', class: 'text-center', orderable:true},
        {data: 'dibuat', class: 'text-center', orderable:true},
      ];
    }
    let actionUrl = '{{ url('publishers') }}';
    let apiUrl = '{{ url('api/publishers') }}';
    let theMethod = 'controllerVue.getData()';


    let controllerVue = new Vue({
      el: '#controllerForVue',
      data: {
        datas: [],// menampung data author
        data: {},// untuk crud
        actionUrl: '{{ url('publishers') }}',//dipakai dengan crud
        apiUrl,//dipakai dengan ajax
        editStatus: false,

        // crud
        dataPenulis: {},
        titleBox: '',
        tombol: '',
        statusEdit: false,
        notstatusEdit: true,
        eror: '',
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

        // crud
        addData() {
          this.titleBox = 'Tambah Data';
          this.dataPenulis = '';
          this.tombol = 'Tambah';
          this.actionUrl = '{{ url('publishers') }}',
          this.statusEdit = false;
          this.notstatusEdit = true;
          this.eror = '';
        },
        editData( event, row ) {
          // console.log(event);
          // console.log(row);
          // console.log(this.datas);
          this.data = this.datas[row];
          this.dataPenulis = this.data;
          this.titleBox = 'Edit Data';
          this.tombol = 'Edit';
          this.actionUrl = '{{ url('publishers') }}'+'/'+this.data.id+'/update';
          this.statusEdit = true;
          this.notstatusEdit = false;
          this.eror = '';
        },
        deletData( event, id ) {
          console.log(id);
          console.log($(event.target).parent().parent());
          event.preventDefault();
          var actionUrl = this.actionUrl+'/delete/'+id;
          if (confirm('are you sure?')) {
            $(event.target).parent().parent('tr').remove();
            axios.post(actionUrl,{_method: 'delete'}).then(response => {
              $("#notif").html("<div class='alert alert-success alert-dismissible fade show' role='alert'"+">"+
                "Anda berhasil menghapus data"+
                "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button"+">"+
                  "</div>");
              this.table.ajax.reload();
            }).catch(
              function (error) {
                let pesan = error.response.data;
                this.eror = pesan.message;
                $("#erorDelete").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'"+">"+
                          eror+
                          "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button"+">"+
                        "</div>");
              });
          }
        },
        submitForm(event, id){
          event.preventDefault();
          const _this = this;
          var actionUrl = !this.editStatus ? this.actionUrl : this.actionUrl+'/'+'id'+'/update';
          axios.post(actionUrl, new FormData($(event.target)[0])).then(response => {
            // $('#modal-default')//.modal('toggle')//its dosnt work//.modal('hide');//its dosnt work//.modal('hide', {backdrop: 'static', keyboard: false})//this is dosn work to close modal;
            // kosongkan value input
            $('#inputNamaAuthor').val("");
            $('#inputNomorAuthor').val("");
            $('#inputAlamatAuthor').val("");
            $('#inputEmailAuthor').val("");
            // hilangkan modal
            $('.modal').removeClass('in');
            $('.modal').attr("aria-hidden","true");
            $('.modal').css("display", "none");
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            // menambah notifikasi suksesfull (set session)
            if (this.statusEdit) {
              $("#notif").html("<div class='alert alert-success alert-dismissible fade show' role='alert'"+">"+
                        "Anda berhasil mengedit data"+
                        "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button"+">"+
                      "</div>");
            } else {
              $("#notif").html("<div class='alert alert-success alert-dismissible fade show' role='alert'"+">"+
                        "Anda berhasil menambahkan data"+
                        "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button"+">"+
                      "</div>");
            }
            // this.notif = ? 'Selamat, anda berhasil mengubah data.' : 'Selamat anda berhasil menambah data.';
            // remove notif error
            $("#eror").html('');
            // reset action link
            this.actionUrl = '{{ url('publishers') }}';

            console.log(this.statusEdit);
            _this.table.ajax.reload();
          }).catch(
            function (error) {
              // console.log('Show error notification!')
              // console.log('Error', error.message);
              // console.log(error.response.data);
              let pesan = error.response.data;
              this.eror = pesan.message;
              // console.log(pesan.message);
              // this.titleBox = 'salah';
              $("#eror").html(eror);
            }
          );
        },
      }
    });
  </script>
@endsection