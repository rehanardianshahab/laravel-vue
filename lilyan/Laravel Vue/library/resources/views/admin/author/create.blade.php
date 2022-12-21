@extends('layouts.admin')

@section('title', 'Halaman Create Author')

@section('header', 'Author')

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create New Author</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('authors') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter name" required="">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Enter email" required="">
                  </div>
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" placeholder="Enter phone number" required="">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <textarea type="text" name="address" class="form-control" placeholder="Enter address" rows="6" cols="80" required=""></textarea>
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