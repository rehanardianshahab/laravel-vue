@extends('layouts.app3')

@section('css')
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" integrity="sha512-Oy+sz5W86PK0ZIkawrG0iv7XwWhYecM3exvUtMKNJMekGFJtVAhibhRPTpmyTj8+lJCkmWfnpxKgT2OopquBHA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <!-- Select2 formulir -->
  <link rel="stylesheet" href="/assetAdminLte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/assetAdminLte/dist/css/adminlte.min.css">
@endsection

@section('content')
<div class="container" id="containerVue">

    <div class="row justify-content-center">
      <div class="col-lg-9 col-md-11 col-sm-12">
        <div class="card row justify-content-center">
          
          <div class="card card-default">
            <form action="{{ url('transactions') }}/push" method="post">
              @csrf
              <div class="card-header">
                <h3 class="card-title">Pinjam Buku</h3>
                
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
                      <select class="form-control select2" style="width: 100%;" name="name">
                        <option value="">Masukkan Nama Member</option>
                        @foreach ($member as $item)
                          <option value="{{ $item->id }}" {{ old('name') == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <!-- /.form-group -->
                  </div>

                  <!-- /.col -->
                  <div>
                    <div class="form-group">
                      <label for="buku">Buku</label>
                      <select class="select2" id="buku" multiple="multiple" data-placeholder="Isbn: Judul buku" style="width: 100%;" name="book[]">
                        @foreach ($buku as $item)
                            <option value="{{ $item['id'] }}" {{ (collect(old('book'))->contains($item['id'])) ? 'selected':'' }}>{{ $item['isbn']." : ".$item['title'] }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <!-- /.form-group -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="tglpinjam">Dari :</label>
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-calendar-week-fill"></i></span>
                          <input type="date" class="form-control bg-body" name="start_date" id="tglpinjam" min="{{ date("Y-m-d"); }}" value="{{ old('start_date') }}">
                        </div>
                      </div>
                    </div>
                    <!-- /.form-group -->
                    <div class="col-md-6">
                      <label for="tglkembali">Hingga :</label>
                      <div class="form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-calendar-week-fill"></i></span>
                          <input type="date" class="form-control bg-body" name="end_date" id="tglkembali" value="{{ old('end_date') }}" min="{{ old('start_date') }}">
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
                  <button class="btn btn-primary m-3 mt-4" type="submit">Buat Pinjaman</button>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                  <div class="form-group col-md-8">
                    <label for="price">Total pembayaran :</label>
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                      <input type="text" class="form-control bg-body" name="price" id="price" :value="harga" disabled>
                    </div>
                  </div>
                </div>
              </div>

            </form>
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
    let apiUrl = '{{ url('api/books') }}';

    var app = new Vue({
      el: '#containerVue',
      data: {
        apiUrl,
        books: [],
        harga: '',
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
              _this.books = JSON.parse(data);
              console.log(_this.books);
            },
            error: function (error) {
              console.log(error);
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
          this.harga = harga;
        }
      },
    })
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
@endsection