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
{{-- <div class="container"> --}}
    <div class="row justify-content-center">
        <div class="col-md-11 col-sm-12">
            <div class="card">
                <div class="card-header">
                  {{ __('Data Member') }}
                </div>

                <div class="card-body">
                  <div id="erorDelete"></div>
                  <div id="notif"></div>

                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <a href="{{ url('members') }}" class="card-title text-danger text-end d-block">Back</a>
                          </div>
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
                                  <th class="text-center" scope="col">Aksi</th>
                                </tr>
                              </thead>
                              <tbody>

                              </tbody>
                            </table>

                            <div>
                              <div class="text-center">
                                <a href="#" class="btn btn-primary btn-sm m-1" onclick="controllerVue.restoreAllData()">Restore Semua</a>
                                <a href="#" class="btn btn-secondary btn-sm m-1" onclick="controllerVue.deleteAllData()">Hapus Semua</a>
                              </div>
                            </div>
                          </div><!-- /.card-head -->
                        </div><!-- /.card -->
                      </div>
                    </div>
                  </div>
                </div><!-- /.card-body -->
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
  <script>
    let actionUrl = '{{ url('members') }}';
    let apiUrl = '{{ url('api/members/trash') }}';

    let columns = [
      {data: 'DT_RowIndex', class: 'text-center', orderable:true},
      {data: 'name', class: 'text-center', orderable:true},
      {data: 'phone_number', class: 'text-center', orderable:true},
      {data: 'address', class: 'text-center', orderable:true},
      {data: 'email', class: 'text-center', orderable:true},
      {render: function (index, row, data, meta) {
        return `
          <a href="#" class="btn btn-success btn-sm" onclick="controllerVue.restoreData(event, ${data.id})">Restore</a>
          <a href="#" class="btn btn-danger btn-sm" onclick="controllerVue.deletData(event, ${data.id})">Delet</a>
          `;
      }, orderable: false, width: '200px', class: 'text-center'},
    ];

    let controllerVue = new Vue({
      el: '#controllerForVue',
      data: {
        datas: [],// menampung data author
        data: {},// untuk crud
        actionUrl: '{{ url('members') }}',//dipakai dengan crud
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
        // restore data
        restoreData( event, id ) {
          console.log(id);
          console.log($(event.target).parent().parent());
          event.preventDefault();
          var actionUrl = this.actionUrl+'/restore?id='+id;
          if (confirm('are you sure?')) {
            $(event.target).parent().parent('tr').remove();
            axios.post(actionUrl,{_method: 'get'}).then(response => {
              $("#notif").html("<div class='alert alert-success alert-dismissible fade show' role='alert'"+">"+
                "Anda berhasil merestore data"+
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
        // restore All Data
        restoreAllData() {
          event.preventDefault();
          var actionUrl = this.actionUrl+'/restoreAll';
          if (confirm('are you sure?')) {
            // $(event.target).parent().parent('tr').remove();
            axios.post(actionUrl,{_method: 'get'}).then(response => {
              $("#notif").html(`<div class='alert alert-success alert-dismissible fade show' role='alert'>
                  Anda berhasil merestore semua data
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>`);
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
        // Delete Data
        deletData( event, id ) {
          console.log(id);
          console.log($(event.target).parent().parent());
          // event.preventDefault();
          var actionUrl = this.actionUrl+'/force-delete?id='+id;
          if (confirm('are you sure?')) {
            $(event.target).parent().parent('tr').remove();
            axios.post(actionUrl,{_method: 'get'}).then(response => {
              $("#notif").html(`<div class='alert alert-success alert-dismissible fade show' role='alert'>
                  Anda berhasil menghapus data
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>`);
              this.table.ajax.reload();
            })
            .catch(
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
        // Delete All Data
        deleteAllData() {
          event.preventDefault();
          var actionUrl = this.actionUrl+'/force-deleteAll';
          if (confirm('are you sure?')) {
            axios.post(actionUrl,{_method: 'get'}).then(response => {
              $("#notif").html(`<div class='alert alert-success alert-dismissible fade show' role='alert'>
                  Anda berhasil menghapus Semua data
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>`);
              this.table.ajax.reload();
            })
            .catch(
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
      }
    });
  </script>
@endsection