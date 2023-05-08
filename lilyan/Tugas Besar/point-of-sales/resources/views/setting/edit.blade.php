@extends('layouts.admin')

@section('title', 'Halaman Edit Pengaturan')

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                  <a href="{{ url('settings') }}" class="btn btn-outline-primary pull-right"><i class="fa-solid fa-rotate-left"></i>&nbsp; Kembali Ke Pengaturan</a>
              </div>

              <form action="{{ url('settings/' .$setting->id.'/update') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama Toko</label>
                    <input type="text" name="name_store" class="form-control" required="" value="{{ $setting->name_store }}">
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="address" class="form-control" required="" value="{{ $setting->address }}">
                  </div>
                  <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" name="phone_number" class="form-control" required="" value="{{ $setting->phone_number }}">
                  </div>
                  <div class="form-group">
                    <label>Logo Perusahaan</label>
                    <input type="file" name="path_logo" class="form-control">
                  </div>
                  <div class="form-group">
                    <img src="{{ asset('img/'. $setting->path_logo ) }}" width="100px" alt="">
                  </div>
                  <div class="form-group">
                    <label>Diskon</label>
                    <input type="number" name="discount" class="form-control" required="" value="{{ $setting->discount }}">
                  </div>        
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        </section>
            <!-- /.card -->
@endsection