@extends('layouts.app3')

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" integrity="sha512-Oy+sz5W86PK0ZIkawrG0iv7XwWhYecM3exvUtMKNJMekGFJtVAhibhRPTpmyTj8+lJCkmWfnpxKgT2OopquBHA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
{{-- <div class="container"> --}}
    <div class="row justify-content-center">
        <div class="col-md-11 col-sm-12">
            <div class="card">
                <div class="card-header">{{ __('Katalog') }}<span style="float:right;"><a href="{{ url('/catalogs/catalogs-create') }}">Tambah data</a></span></div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    
                    <div class="card">
                        <div class="card-header">
                          @if (isset($trash))
                          @else
                            <a href="/catalogs/trash" class="card-title text-danger text-end d-block"><i class="bi bi-trash3"></i> Data Catalog</a>
                          @endif
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
                                  @if (isset($trash))
                                  <td class="text-center">
                                    <form action="/catalogs/catalog" method="get">
                                      <input type="hidden" value="{{ $item->id }}" name="id">
                                      <button type="submit" style="border:none; background:none; display:inline; color:blue; text-decoration:none;">Restore</button>
                                      {{-- @method('head') --}}
                                      @csrf
                                    </form>
                                    <form action="/catalogs/force-delete" method="get">
                                      <input type="hidden" value="{{ $item->id }}" name="id">
                                      <button type="submit" style="border:none; background:none; display:inline; color:red; text-decoration:none;" onclick="return confirm('Apakah anda yakin mau menghapus publiser {{ $item->name }}?')">Hapus</button>
                                      @csrf
                                    </form>
                                  </td>
                                  @else
                                  <a href="{{ url('/catalogs/catalogs-edit?id='.$item->id) }}" class="text-success">Perbarui</a>  
                                  ||<form action="{{ url('catalogs', ['id' => $item->id]) }}" method="post" style="display: inline;">
                                    <button type="submit" style="border:none; background:none; display:inline; color:red; text-decoration:none;" onclick="return confirm('Apakah anda yakin mau menghapus katalog {{ $item->name }}?')">Hapus</button>
                                    @method('delete')
                                    @csrf
                                  </form>
                                  @endif
                                </td>
                              </tr>
                            @endforeach
                              @if (isset($trash))
                              <tr>
                                <td></td><td></td><td></td><td></td><td></td>
                                <td class="text-center"><a href="/catalogs/restore-all">Restore All</a></td>
                              </tr>
                              @else
                              @endif
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
{{-- </div> --}}
@endsection
