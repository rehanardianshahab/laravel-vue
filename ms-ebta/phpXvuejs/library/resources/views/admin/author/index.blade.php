@extends('layouts.app3')

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


<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
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
                          <h3 class="card-title">Data Penulis</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body p-0">
                        <table class="table table-sm">
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
                          <tbody>
                          @foreach ($author as $key => $item)
                            <tr>
                              <td>{{ $key+1 }}</td>
                              <td>{{ $item->name }}</td>
                              <td class="text-center">{{ $item->phone_number }}</td>
                              <td class="text-center">{{ $item->address }}</td>
                              <td class="text-center">{{ $item->email }}</td>
                              <td class="text-center">
                                <a href="#" @click="editData({{ $item }})"  class="text-success" data-toggle="modal" data-target="#modal-lg">Perbarui</a>  
                                ||<form action="{{ url('author', ['id' => $item->id]) }}" method="post" style="display: inline;">
                                  <button type="submit" style="border:none; background:none; display:inline; color:red; text-decoration:none;" onclick="return confirm('Apakah anda yakin mau menghapus katalog {{ $item->name }}?')">Hapus</button>
                                  @method('delete')
                                  @csrf
                                </form>
                              </td>
                            </tr>

                          @endforeach
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
</div>
<div>
@endsection

@section('scriptLink')
{{-- axios --}}
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
{{-- vuejs --}}
<script src="https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.js"></script>
<!-- Remember to include jQuery :) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
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
@endsection