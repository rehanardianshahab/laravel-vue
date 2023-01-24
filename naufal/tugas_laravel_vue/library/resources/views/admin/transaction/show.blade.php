@extends('layouts.admin')

@section('header', 'Book Transaction Details')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />
@endsection

@section('content')
<a href="/transactions" class="btn btn-sm btn-primary mb-3">Back to Transaction</a>

<div id="controller">
  <div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Transaction Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              {{-- Member --}}
              <div class="row mb-1">
                <div class="col-md-5 font-weight-bold">Member's Name</div>
                <div class="col-md-7">
                  @if($transaction->member_id == $member->id)
                    <p>{{ $member->name }}</p>
                  @endif
                </div>
              </div>

              {{-- Rent Date --}}
              <div class="row mb-1">
                <div class="col-md-5 font-weight-bold">Rent Date</div>
                <div class="col-md-7"><p>{{ convert_date($transaction->date_start) }}</p></div>
              </div>

              {{-- Books --}}
              <div class="row mb-1">
                <div class="col-md-5 font-weight-bold">Books</div>
                <div class="col-md-7">
                  @foreach($books as $key => $book)
                    @foreach($transaction_details as $keyTrans => $transaction_detail)
                      @if($book->id == $transaction_detail->book_id)
                        <p>{{ $book->title }}</p>
                      @endif
                    @endforeach
                  @endforeach
                </div>
              </div>

              {{-- Status --}}
              <div class="row mb-4">
                <div class="col-md-5 font-weight-bold">Status</div>
                <div class="col-md-7">
                  @if($transaction->status == 1)
                    <p>Returned</p>
                  @else
                    <p>Haven't Returned</p>
                  @endif
                </div>
              </div>
            </div>
            
        </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Page specific script -->
<script type="text/javascript">
    var actionUrl = '{{ url('transactions') }}';
    var apiUrl = '{{ url('api/transactions') }}';
</script>

<script src="{{ url('js/data.js') }}"></script>
@endsection