@extends('layouts.app3')

@section('css')
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" integrity="sha512-Oy+sz5W86PK0ZIkawrG0iv7XwWhYecM3exvUtMKNJMekGFJtVAhibhRPTpmyTj8+lJCkmWfnpxKgT2OopquBHA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <!-- Select2 formulir -->
  <link rel="stylesheet" href="/assetAdminLte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/assetAdminLte/dist/css/adminlte.min.css">
@endsection

<?php
 if (isset($_GET['trans_id'])) {
    $data = findObjectInArray($_GET['trans_id'], 'id', $member);
    $date = $tanggal[0];
    $DaftarBuku = [];
    $DataBuku = [];
    $harga = 0;
    foreach ($bukuInTrans as $key => $value) {
      array_push($DaftarBuku, $value['book_id']);
      array_push($DataBuku, [
        'id' => $value['id'],
        'book_id' => $value['book_id'],
        'title' => $value['title'],
        'status' => $value['status'],
        'tgl_kembali' => $value['tgl_kembali']
      ]);

      
      $harga = $harga + $value['qty_pinjam']*$value['price'];
    }
    $check = findObjectInArray(0, 'status', $DataBuku, array());
    
    if (count($check) > 0) {
      // echo 'halo';
      $_GET['status'] = 0;
    } else {
      $_GET['status'] = 1;
    }
 } else {
  $data = null;
 }

?>

@section('content')
<div class="container" id="containerVue">
  @if (isset($_GET['trans_id']))
    <input type="hidden" id="consentrate" value="{{ $_GET['trans_id'] }}">
  @else 
    <input type="hidden" id="consentrate" value="">
  @endif

    <div class="row justify-content-center">
      <div class="col-lg-9 col-md-11 col-sm-12">
        <div class="card row justify-content-center">

          @if (session('success'))
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                {{ session('success') }}
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          @endif
          
          <div class="card card-default">

            <form action="{{ $data==null ? "/transactions/push" : "/transactions/update/".$_GET['trans_id'] }}" method="post">
              @csrf
              @isset($_GET['trans_id'])
                  {{ method_field('PUT') }} {{-- khusus untuk update data --}}
              @endisset
              <div class="card-header">
                <h3 class="card-title">{{ $data==null ? "Pinjam Buku" : "Edit/Kembalikan" }}</h3>
                
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
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

                <div class="row">
                  
                  <div>
                    <div class="form-group">
                      <label>Nama</label>
                        @if ($data == null)
                        <select class="form-control select2" style="width: 100%;" name="name">
                        @else
                        <select class="form-control select2" style="width: 100%;" name="name" disabled>
                        @endif
                        <option value="">Masukkan Nama Member</option>
                        @foreach ($member as $item)
                          @if ($data == null)
                            <option value="{{ $item->id }}" {{ old('name') == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                          @else
                            <option value="{{ $item->id }}" {{ old('name', $data['id']) == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->

                  <div>
                    <div class="form-group">
                      <label for="buku">Buku</label>
                      {{-- <select class="select2" id="buku" multiple="multiple" data-placeholder="Isbn: Judul buku" style="width: 100%;" name="book[]"> --}}
                      @if ($data == null)
                      <select class="select2" id="buku" multiple="multiple" data-placeholder="Isbn: Judul buku" style="width: 100%;" name="book[]">
                      @else
                      <select class="select2" id="buku" multiple="multiple" data-placeholder="Isbn: Judul buku" style="width: 100%;" name="book[]" disabled>
                      @endif
                        @foreach ($buku as $item)
                          @if ($data == null)
                            <option value="{{ $item['id'] }}" {{ (collect(old('book'))->contains($item['id'])) ? 'selected':'' }}>{{ $item['isbn']." : ".$item['title'] }}</option>
                          @else
                            <option value="{{ $item['id'] }}" {{ (collect(old('book', $DaftarBuku))->contains($item['id'])) ? 'selected':'' }}>{{ $item['isbn']." : ".$item['title'] }}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->

                  <!-- /.form-group -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="tglpinjam">Dari :</label>
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-calendar-week-fill"></i></span>
                          @if ($data == null)
                            <input type="date" class="form-control bg-body" name="start_date" id="tglpinjam" min="{{ date("Y-m-d"); }}" value="{{ old('start_date') }}">
                          @else
                            <input type="date" class="form-control bg-body" name="start_date" id="tglpinjam" min="{{ $date->date_start }}" value="{{ old('start_date', $date->date_start) }}" disabled>
                          @endif
                        </div>
                      </div>
                    </div>
                    <!-- /.form-group -->
                    <div class="col-md-6">
                      <label for="tglkembali">Hingga :</label>
                      <div class="form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-calendar-week-fill"></i></span>
                          @if ($data == null)
                            <input type="date" class="form-control bg-body" name="end_date" id="tglkembali" value="{{ old('end_date') }}" min="{{ old('start_date') }}">
                          @elseif ( $_GET['status'] == 1)
                            <input type="date" class="form-control bg-body" value="{{ $date->date_end }}" disabled>
                          @else
                            <input type="date" class="form-control bg-body" name="end_date" id="tglkembali" value="{{ old('end_date', $date->date_end) }}" min="{{ old('start_date', $date->date_start) }}">
                          @endif
                        </div>
                      </div>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>

              <div class="card-footer row">
                <div class="col-md-6">
                  @if ($data == null)
                  <button class="btn btn-primary m-3 mt-4" type="submit">Buat Pinjaman</button>
                  @else
                  <button class="btn btn-primary m-3 mt-4" type="submit" {{ $_GET['status'] == 1 ? 'disabled' : '' }}>Simpan Data</button>
                  @endif
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                  <div class="form-group col-md-8">
                    <label for="price">Total pembayaran :</label>
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                      <input type="text" class="form-control bg-body" name="harga" id="price" :value="harga" {{ $data == null ? "" : "placeholder=".uang($harga) }} disabled>
                    </div>
                  </div>
                </div>
              </div>

            </form>
            @if ($data != null)
            <div class="row">
              <div class="card card-default">
                <div class="card-title p-2">Kembalikan Buku</div>
                <div class="card-body">
                  <ul class="list-group" v-for="(item, index) in books" id="datalist">

                    <li class="list-group-item row">
                      <span class="col-12 col-sm-3 col-md-3 d-inline-block">@{{ item.title }}</span>
                      <span class="col-12 col-sm-7 col-md-7 d-inline-block">
                        {{-- <form  @submit="editData($event, item.id)" v-if="item.status == 0"> --}}
                        <form  :action="urlput+item.id" method="post" v-if="item.status == 0">
                          @csrf
                          {{ method_field('PUT') }}
                          <div class="form-check form-switch d-inline-block border rounded-3 px-0 mx-0">
                            <input type="hidden" value="1" name="status">
                            <input type="hidden" value="{{ date('Y-m-d') }}" name="tgl_kembali">
                            <button type="submit" class="bg-white border rounded-3" @click="getid(item.id)"><i class="bi bi-toggle-off fs-4"></i>Kembalikan</button>
                          </div>
                        </form>
                        <small class="text-success" v-if="item.status == 1"><i class="bi bi-check-circle-fill"></i> @{{ item.tgl_kembali }}</small>
                      </span>
                    </li>

                  </ul>
                </div>
              </div>
            </div>
            @endif

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

{{-- formulir --}}<!-- Select2 -->
<script src="/assetAdminLte/plugins/select2/js/select2.full.min.js"></script>
@endsection

@section('js')
  {{-- mengatasi harga pembayaran --}}
  <script>
  // get harga lewat vue
    let apiUrl = '{{ url('transactions') }}/apipinjaman';
    let consentrasi = $('#consentrate').val();
    // console.log(consentrasi);
    let id = '';

    var app = new Vue({
      el: '#containerVue',
      data: {
        apiUrl,
        urlput: '{{ url('transactions') }}/kembalikan/',
        books: [],
        harga: '',
        id,
        consentrasi
      },
      mounted: function () {
        this.get_books();
      },
      methods: {
        get_books() {
          const _this = this;
          // data books
          $.ajax({
            url: apiUrl,
            method: 'GET',
            success: function (data) {
              _this.books = [];
              // console.log(_this.consentrasi);
              if (_this.consentrasi != '') {
                data.forEach(element => {
                  if (element['transaction_id'] == _this.consentrasi) {
                    _this.books.push(element);
                  }
                });
                // console.log(_this.books);
              } else {
                data.forEach(element => {
                  _this.books.push(element);
                });
                // console.log(_this.books);
              }
            },
            error: function (error) {
              // console.log(error);
            }
          });  
        },
        pricing(price) {
          return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },
        price(id) {
          harga = 0;
          id.forEach((element, index) => {
            // console.log(index, element);
            saveral = this.books.find(obj => {
              // Returns the object where
              // the given property has some value 
                return obj.id == element;
            });
            // console.log(saveral.price);
            harga += saveral.price;
          });
          this.harga = this.pricing(harga);
        },getid(params) {
          this.id = params;
        },
        // editData( event, id ) {
        //   event.preventDefault();
        //   axios.put('{{ url('transactions') }}/kembalikan/'+this.id,new FormData($(event.target)[0]))
        //     .then((response) => {
        //       // this.get_books()
        //       console.log('success');
        //       // this.get_books();
        //       // $('datalist').reload();
        //     }).catch(function (error) {
        //         // let pesan = error.response.data.message;
        //         // this.eror = pesan;
        //         console.log(eror);
        //     })
        // },
      },
    });
    $('#buku').on('change', function () {
      idbuku = $('#buku').val();
      app.price(idbuku);
      // console.log(idbuku);
    });
  </script>

  {{-- mengatasi sifat tanggal input --}}
  <script>
    if ($('input[name=start_date]').val() == '') {
      $( 'input[name=end_date]' ).prop("disabled", true);
    } else {
      $( 'input[name=end_date]' ).prop("disabled", false);
    }
    $('input[name=start_date]').on('change', function () {
      if ($('input[name=start_date]').val() == '') {
        $( 'input[name=end_date]' ).prop("disabled", true);
        $( 'input[name=end_date]' ).val('')
      } else {
        $( 'input[name=end_date]' ).prop("disabled", false);
        $( 'input[name=end_date]' ).attr("min", $('input[name=start_date]').val())
      }
    });
  </script>

  {{-- form input admin lte --}}
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
  </script>

  {{-- get id --}}
  {{-- <script>
    function 
  </script> --}}
@endsection