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

                    <form class="form-horizontal" action="{{ url($route.'/'.$catalogs->id) }}" method="post">
                        @csrf {{-- untuk get token --}}
                        {{ method_field('PUT') }} {{-- khusus untuk update data --}}

                        <div class="card-body">
                        @if ($baru = 'catalogs')
                            <div class="form-group row">
                                <label for="inputkatalog" class="col-sm-2 col-form-label">Nama Katalog</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputkatalog" placeholder="$catalogs" name="name" value="{{ $catalogs->name }}" required>
                                </div>
                            </div>
                        @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Perbarui</button>
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