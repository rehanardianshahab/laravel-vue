@extends('layouts.app3')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Katalog') }}<span style="float:right;"><a href="{{ url('catalogs-create') }}">Tambah data</a></span></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Penggolongan Katalog</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                          <table class="table table-sm">
                            <thead>
                              <tr>
                                <th style="width: 10px" class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">qty</th>
                                <th class="text-center">Dibuat Pada</th>
                                <th class="text-center">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($catalogs as $key => $item)
                              <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">{{ count($item->books) }}</td>
                                <td class="text-center">{{ date('H:i:s - d/M/Y', strtotime($item->created_at)) }}</td>
                                <td class="text-center">
                                  <a href="{{ url('catalogs-edit?id='.$item->id) }}" class="text-success">Perbarui</a>  
                                  ||<form action="{{ url('catalogs', ['id' => $item->id]) }}" method="post" style="display: inline;">
                                    <button type="submit" style="border:none; background:none; display:inline; color:red; text-decoration:none;" onclick="return confirm('Apakah anda yakin mau menghapus katalog {{ $item->name }}?')">Hapus</button>
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
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
