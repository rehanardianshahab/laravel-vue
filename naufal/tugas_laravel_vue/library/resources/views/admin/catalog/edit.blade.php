@extends('layouts.admin')

@section('header', 'Catalog')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Catalog</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ url('catalogs/'.$catalog->id) }}" method="post">
                @csrf
                @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="catalog_name">Name</label>
                  <input type="text" class="form-control @error('catalog_name') is-invalid @enderror" id="catalog_name" name="catalog_name" placeholder="Enter catalog name" value="{{ $catalog->catalog_name }}" required>
                  @error('catalog_name')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
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