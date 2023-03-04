@extends('layouts.admin')

@section('title', 'Halaman Edit Transaction')

@section('header', 'Transaction')

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <a href="{{ url('transactions') }}" class="btn btn-primary pull-right">Back To Transaction</a><br><br>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Detail Transaction</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <table class="table">
                    <tr>
                        <th width="150px">Nama Peminjam</th>
                        <th width="30px">:</th>
                        <th>
                          @foreach($members as $member)
                            {{ $member->id == $transaction->member_id ? $member->name :'' }}  
                          @endforeach
                        </th>
                    </tr>
                    <tr>
                        <th width="150px">Tanggal Pinjam</th>
                        <th width="30px">:</th>
                        <th>{{ $transaction->date_start }}</th>
                    </tr>
                    <tr>
                        <th width="150px">Tanggal Kembali</th>
                        <th width="30px">:</th>
                        <th>{{ $transaction->date_end }}</th>
                    </tr>
                    <tr>
                        <th width="150px">Buku</th>
                        <th width="30px">:</th>
                        <th>
                        @foreach($transactionDetails as $transDetail)
                          @foreach($books as $book)
                            {{ $book->id == $transDetail->book_id ? $book->title :'' }} 
                          @endforeach
                        @endforeach
                        </th>
                    </tr>
                    <tr>
                        <th width="150px">Status</th>
                        <th width="30px">:</th>
                        <th>
                          {{ $transaction->status == 1 ? 'Sudah Dikembalikan' : 'Belum Dikembalikan' }}
                        </th>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
        </section>
@endsection
