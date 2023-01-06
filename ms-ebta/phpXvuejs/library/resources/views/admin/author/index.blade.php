@extends('layouts.app3')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Authors') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Penulis</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                          <table class="table table-sm">
                            <thead>
                              <tr>
                                <th style="width: 10px" class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Telp.</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Email</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($author as $key => $item)
                              <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">{{ $item->phone_number }}</td>
                                <td class="text-center">{{ $item->address }}</td>
                                <td class="text-center">{{ $item->email }}</td>
                              </tr>
                            @endforeach
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
