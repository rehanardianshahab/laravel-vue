@extends('layouts.admin')

@section('header', 'Author')

@section('content')
<div class="card">
    <div class="card-header">
      <a href="{{ url('authors/create') }}" class="btn btn-sm btn-primary">Create New Author</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th class="text-center">Author Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Phone Number</th>
            <th class="text-center">Address</th>
          </tr>
        </thead>
        <tbody>
            @foreach($authors as $key => $author)
          <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $author->author_name }}</td>
            <td class="text-center">{{ $author->email }}</td>
            <td class="text-center">{{ $author->phone_number }}</td>
            <td class="text-center">{{ $author->address }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection