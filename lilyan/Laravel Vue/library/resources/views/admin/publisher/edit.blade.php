@extends('layouts.admin')

@section('title', 'Halaman Edit Publisher')

@section('header', 'Publisher')

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Publisher</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('publishers/'.$publisher->id) }}" method="post">
                @csrf
                {{ method_field('PUT') }} <!-- Khusus update data harus nambahin method put -->

                <div class="card-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter name" 
                    required="" value="{{ $publisher->name }}">
                  </div> 
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Enter email" 
                    required="" value="{{ $publisher->email }}">
                  </div>
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" placeholder="Enter phone number" 
                    required="" value="{{ $publisher->phone_number }}">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <textarea type="text" name="address" class="form-control" placeholder="Enter address" rows="6" cols="80" 
                    required="">{{ $publisher->address }}</textarea>
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