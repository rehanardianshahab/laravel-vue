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
    <div class="row justify-content-center">
        <div class="col-md-11 col-sm-12">

            <div class="card">
                
                <div class="card-header fs-5">
                    {{ __('Detil Transaksi') }}
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
                  <div class="controller">
                    <dl class="row">
                      <dt class="col-sm-3">Nama Peminjam</dt>
                      <dd class="col-sm-9">@{{ datas.nama }}</dd>

                      <dt class="col-sm-3">Tanggal Peminjaman</dt>
                      <dd class="col-sm-9">@{{ datas.tgl_pinjam }}</dd>

                      <dt class="col-sm-3">Death Line</dt>
                      <dd class="col-sm-9">@{{ datas.dl }}</dd>
                    
                      <dt class="col-sm-3">Buku</dt>
                      <dd class="col-sm-9">
                        <ul class="list-group" v-for="(value, key, i) in datas.buku">
                          <li class="list-group-item row">
                            <span class="col col-4 d-inline-block">@{{ value.title }}</span>
                            <span class="col col-2 d-inline-block"><small>qty : @{{ value.jumlah }}</small></span>
                            <span class="col col-5 d-inline-block" v-if="value.status == 1"><small class="text-success"><i class="bi bi-check-circle-fill"></i> @{{ value.tanggal }}</small></span>
                            <span class="col col-5 d-inline-block" v-if="value.status == 0"><small class="text-danger"><i class="bi bi-x-circle-fill"></i> <small>@{{ value.tanggal }}</small></small></span>
                          </li>
                        </ul>
                      </dd>
                    
                      <dt class="col-sm-3">status</dt>
                      <dd class="col-sm-9">@{{ datas.status }}</dd>
                      
                      <dt class="col-sm-3">Dikembalikan Tanggal</dt>
                      <dd class="col-sm-9">@{{ datas.tgl_kembali }}</dd>
                    </dl>
                  </div>
                </div>
                <div class="card-footer">
                  <a href="{{ url('transactions') }}" class="btn btn-primary m-3">Kembali</a>
                </div>
            </div>
            {{-- get id --}}
            <input type="hidden" name="id" value="<?= $_GET['trans_id']; ?>">
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
    let apiUrl = '{{ url('api/detil') }}?trans_id='+$('input[name=id]').val();
    console.log(apiUrl);

    let controllerVue = new Vue({
      el: '#controllerForVue',
      data: {
        datas: [],// menampung data
        apiUrl,//dipakai dengan ajax utk get data
      },
      mounted: function () {
        this.get_data();
      },
      methods: {
        get_data() {
          const _this = this;
          // data
          $.ajax({
              url: apiUrl,
              method: 'GET',
              success: function (data) {
                  _this.datas = data[0];
                  console.log(_this.datas);
              },
              error: function (error) {
                  console.log(error);
              }
          });
        }
      }
    });
  </script>
@endsection