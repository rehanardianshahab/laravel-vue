@extends('layouts.admin')
@section('title', 'Home')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="alert alert-info" role="alert">
                    <h4 class="alert-heading">Selamat Datang, {{ ucwords(Auth::user()->name) }}</h4>
                    <p>Sekarang Anda dapat menggunakan fitur-fitur dalam sistem ini sesuai dengan hak akses yag diberikan.</p>
                    <hr>
                    <p class="mb-0"></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
