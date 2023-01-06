@extends('layouts.app3')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Publiser') }}<span style="float:right;"><a href="{{ url('publishers-create') }}">Tambah data</a></span></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Publishers</h3>
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
                                <th class="text-center">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($publisher as $key => $item)
                              <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">{{ $item->phone_number }}</td>
                                <td class="text-center">{{ $item->address }}</td>
                                <td class="text-center">{{ $item->email }}</td>
                                <td class="text-center">
                                  <a href="{{ url('publishers-edit?id='.$item->id) }}" class="text-success">Perbarui</a>  
                                  <form action="{{ url('publishers', ['id' => $item->id]) }}" method="post">
                                    <button type="submit" style="border:none; background:none; display:inline; color:red; text-decoration:none;" onclick="return confirm('Apakah anda yakin mau menghapus publiser {{ $item->name }}?')">Hapus</button>
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
