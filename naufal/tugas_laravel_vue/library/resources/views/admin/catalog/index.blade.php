@extends('layouts.admin')

@section('header', 'Catalog')

@section('content')
<div class="card">
  <div class="card-header">
    <a href="{{ url('catalogs/create') }}" class="btn btn-sm btn-primary">Create New Catalog</a>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <table class="table">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th class="text-center">Catalog</th>
          <th class="text-center">Total Books</th>
          <th class="text-center">Created at</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($catalogs as $key => $catalog)
        <tr>
          <td>{{ $key+1 }}</td>
          <td>{{ $catalog->catalog_name }}</td>
          <td class="text-center">{{ count($catalog->books) }}</td>
          <td class="text-center">{{ date('d/m/Y', strtotime($catalog->created_at)) }}</td>
          <td class="text-center">
            <a href="{{ url('catalogs/'.$catalog->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ url('catalogs', ['id' => $catalog->id]) }}" method="post">
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
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

@endsection