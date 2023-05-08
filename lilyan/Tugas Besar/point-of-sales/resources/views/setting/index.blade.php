@extends('layouts.admin')
@section('header', 'Pengaturan')

@section('css')
  <link rel="stylesheet" href="{{ asset('assets/dist/css/setting.css') }}">
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-8">
      @foreach ($setting as $key => $item)
      <div class="card">
        <div class="card-header">
          <div class="logo-perusahaan">
            <img src="{{ asset('img/'. $item->path_logo ) }}" width="200px" alt="">
          </div><hr>
        <div class="card-body">
          <div class="row">
            <table>
              <tr>
                <th class="card-text" width="150px">Nama Perusahaan</th>
                <th width="30px">:</th>    
                <th class="card-title">{{ $item->name_store }}</th>
              </tr>
              <tr>
                <th width="150px">Alamat</th>
                <th width="30px">:</th>    
                <th class="card-title">{{ $item->address }}</th>
              </tr>
              <tr>
                <th width="150px">Telepon</th>
                <th width="30px">:</th>    
                <th class="card-title">{{ $item->phone_number }}</th>
              </tr>
              <tr>
                <th width="150px">Diskon Member</th>
                <th width="30px">:</th>    
                <th class="card-title">{{ $item->discount }}%</th>
              </tr>
            </table>
          </div><hr>
          <a href="{{ url('settings/'.$item->id.'/edit') }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i>&nbsp; Edit Pengaturan</a>
        </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection