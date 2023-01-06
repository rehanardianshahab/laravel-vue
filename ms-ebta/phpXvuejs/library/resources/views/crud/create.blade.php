@extends('layouts.app3')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
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
                            @if ($baru = 'catalogs')
                                <div class="form-group row">
                                    <label for="inputkatalog" class="col-sm-2 col-form-label">Nama Katalog</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputkatalog" placeholder="Nama Katalog" name="name" required>
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
