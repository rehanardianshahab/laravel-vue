@extends('layouts.admin')

@section('header', 'Publisher')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Publisher</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ url('publishers/'.$publisher->id) }}" method="post">
                @csrf
                @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="publisher_name">Name</label>
                  <input type="text" class="form-control" id="publisher_name" name="publisher_name" placeholder="Enter publisher's name" value="{{ $publisher->publisher_name }}" required>
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter publisher's email" value="{{ $publisher->email }}" required>
                </div>

                <div class="form-group">
                  <label for="phone_number">Phone Number</label>
                  <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter publisher's phone number" value="{{ $publisher->phone_number }}" required>
                </div>

                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Enter publisher's addres" value="{{ $publisher->address }}" required>
                </div>
              </div>
              <!-- /.card-body -->
        
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection