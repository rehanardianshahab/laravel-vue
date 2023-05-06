@extends('layouts.admin')

@section('title', 'Halaman Create Catalog')

@section('header', 'Pengaturan')

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Pengaturan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('settings') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama Toko</label>
                    <input type="text" name="name_store" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="address" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" name="phone_number" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Logo Perusahaan</label>
                    <input type="file" name="path_logo" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Diskon</label>
                    <input type="number" name="discount" class="form-control" required="">
                  </div>        
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
</section>
@endsection