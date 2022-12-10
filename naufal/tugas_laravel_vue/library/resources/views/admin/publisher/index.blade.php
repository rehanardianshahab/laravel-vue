@extends('layouts.admin')

@section('header', 'Publisher')

@section('content')
<div class="card">
    <div class="card-header">
      <a href="{{ url('publishers/create') }}" class="btn btn-sm btn-primary">Create New Publisher</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th class="text-center">Publisher Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Phone Number</th>
            <th class="text-center">Address</th>
          </tr>
        </thead>
        <tbody>
          @foreach($publishers as $key => $publisher)
          <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $publisher->publisher_name }}</td>
            <td class="text-center">{{ $publisher->email }}</td>
            <td class="text-center">{{ $publisher->phone_number }}</td>
            <td class="text-center">{{ $publisher->address }}</td>
            <td class="text-center">
              <a href="{{ url('publishers/'.$publisher->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
              <form action="{{ url('publishers', ['id' => $publisher->id]) }}" method="post">
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