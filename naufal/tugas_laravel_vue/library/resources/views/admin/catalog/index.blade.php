@extends('layouts.admin')

@section('header', 'Catalog')

@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Catalog</h3>
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
        </tr>
      </thead>
      <tbody>
        @foreach($catalogs as $key => $catalog)
        <tr>
          <td>{{ $key+1 }}</td>
          <td>{{ $catalog->catalog_name }}</td>
          <td class="text-center">{{ count($catalog->books) }}</td>
          <td class="text-center">{{ date('d/m/Y', strtotime($catalog->created_at)) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

@endsection