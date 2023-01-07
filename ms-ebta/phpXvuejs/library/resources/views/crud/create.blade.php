@extends('layouts.app3')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{-- error input --}}
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Data {{ $route }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form class="form-horizontal" action="{{ url($route) }}" method="post">
                            @csrf {{-- untuk get token --}}
                            <div class="card-body">
                            @if ($route == 'catalogs')
                                <div class="form-group row">
                                    <label for="inputNamaKatalog" class="col-sm-2 col-form-label">Nama Katalog</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputNamaKatalog" placeholder="Nama Katalog" name="name" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                            @elseif($route == 'publishers')
                                <div class="form-group row">
                                    <label for="inputNamaPublishers" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputNamaPublishers"  autocomplete="off" placeholder="Nama Publisher" name="name" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputNomorPublisher" class="col-sm-2 col-form-label">Nomor Telphone</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="inputNomorPublisher" placeholder="No. Telp." name="phone_number" value="{{ old('phone_number') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputAlamatPublisher" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputAlamatPublisher" placeholder="Alamat" name="address" value="{{ old('address') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmailPublisher" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmailPublisher" placeholder="email" name="email" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                            @endif
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Tambah</button>
                            </div>
                        <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
@endsection
