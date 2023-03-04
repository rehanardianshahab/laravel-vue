@extends('layouts.admin')
@section('header', 'Transaction')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <a href="{{ url('transactions') }}" class="btn btn-primary pull-right">Back To Transaction</a><br><br>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create New Transaction</h3>
              </div>
              <form action="{{ url('transactions') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Member</label>
                    <select name="member_id" class="form-control">
                        <option value="">-- Pilih Member --</option>
                        @foreach ($members as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>                           
                        @endforeach
                    </select>
                  </div>
                  <div class="row">
                  <div class="form-group col-md-6">
                    <label>Tanggal Pinjam</label>
                    <input type="date" name="date_start" class="form-control" required="">
                  </div> 
                  <div class="form-group col-md-6">
                    <label>Tanggal Kembali</label>
                    <input type="date" name="date_end" class="form-control" required="">
                  </div>
                  </div>
                  <div class="form-group">
                    <label>Book</label>
                    <select name="book_id[]" id="book_id" class="select2bs4" multiple="multiple" data-placeholder="-- Select a Book --" style="width: 100%;">
                        @foreach ($books as $item)
                          @if($item->qty > 0)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>                           
                          @endif
                        @endforeach
                    </select>
                  </div>     
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        </section>
            <!-- /.card -->
@endsection

@section('js')
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

<script type="text/javascript">
$(function () {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});
</script>
@endsection