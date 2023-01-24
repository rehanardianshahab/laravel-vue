@extends('layouts.admin')

@section('header', 'Book Transaction')

@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
@endsection

@section('content')
<a href="/transactions" class="btn btn-sm btn-primary mb-3">Back to Transaction</a>
<div class="row justify-content-center">
  <div class="col-md-6">
      <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Transaction</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ url('transactions/'.$transaction->id) }}" method="post">
              @csrf
              @method('PUT')
              
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label for="member_id">Member's Name</label>
                      <select type="text" class="form-control select2bs4 @error('member_id') is-invalid @enderror" id="member_id" name="member_id" placeholder="Enter member's name" required>
                        <option value="">--- Choose a member ---</option>
                        <?php foreach($members as $member) { ?>
                          <option value="{{ $member->id}}" {{ $member->id == $transaction->member_id ? 'selected' : '' }}>{{ $member->name }}</option>
                        <?php } ?>
                      </select>
                      @error('member_id')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="date_start">Rent Date</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                      </div>
                      <input type="date" class="form-control @error('date_start') is-invalid @enderror" id="date_start" name="date_start" placeholder="Enter rent date" value="{{ $transaction->date_start }}" required>
                    </div>
                    @error('date_start')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
  
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="date_end">Return Date</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                      </div>
                      <input type="date" class="form-control @error('date_end') is-invalid @enderror" id="date_end" name="date_end" placeholder="Enter return date" value="{{ $transaction->date_end }}" required>
                    </div>
                    @error('date_end')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="book_id">Book Title</label>
                    <select type="text" class="form-control select2 @error('book_id') is-invalid @enderror" multiple="multiple" id="book_id" name="book_id[]" data-placeholder="--- Choose book title ---" required>
                      <option value="">--- Choose book title ---</option>
                      @foreach($books as $key => $book)
                        
                          <option value="{{ $book->id }}" @foreach($transDetails as $keyTrans => $transDetail) { {{ $book->id == $transDetails[$keyTrans]->book_id ? 'selected' : '' }} } @endforeach>{{ $book->title }}</option>
                                            
                      @endforeach
                    </select>
                    @error('book_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <!-- radio -->
                  <div class="form-group">
                    <label for="status">Status</label>
                    <div class="form-check">
                      <input class="form-check-input" value="1" type="radio" name="status" {{ $transaction->status == 1 ? 'checked' : '' }}>
                      <label class="form-check-label">Returned</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" value="0" type="radio" name="status" {{ $transaction->status != 1 ? 'checked' : '' }}>
                      <label class="form-check-label">Haven't Returned</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->

            @foreach($transDetailIds as $key => $detailId)
              <input type="hidden" name="id[]" value="{{ $detailId }}">
            @endforeach
      
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
      </div>
  </div>
</div>
@endsection

@section('js')
<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script type="text/javascript">
$(function () {
  //Initialize Select2 Elements
  $('.select2').select2()

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })
})
</script>
@endsection