@extends('layouts.admin')

@section('title', 'Halaman Edit Catalog')

@section('header', 'Catalog')

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Catalog</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('catalogs/'.$catalog->id) }}" method="post">
                @csrf
                {{ method_field('PUT') }} <!-- Khusus update data harus nambahin method put -->

                <div class="card-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter name" 
                    required="" value="{{ $catalog->name }}">
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