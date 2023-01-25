@extends('layouts.admin')

@section('header', 'Book Transaction')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />
@endsection

@section('content')

@role('admin')
<div id="controller">
    <div class="row">
        <div class="col-12">
          <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-8">
                    <a href="{{ url('transactions/create') }}" class="btn btn-sm btn-primary">Create New Transaction</a>
                  </div>
                  <div class="col-md-2">
                    <select class="form-control" name="status">
                      <option value="">Filter Status</option>
                      <option value="1">Returned</option>
                      <option value="0">Haven't Returned</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <select class="form-control" name="date_start">
                      <option value="0">Filter Rent Date</option>
                      <option value="01">January</option>
                      <option value="02">February</option>
                      <option value="03">March</option>
                      <option value="04">April</option>
                      <option value="05">May</option>
                      <option value="06">June</option>
                      <option value="07">July</option>
                      <option value="08">August</option>
                      <option value="09">September</option>
                      <option value="10">October</option>
                      <option value="11">November</option>
                      <option value="12">December</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="datatable" class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th class="text-center">Rent Date</th>
                      <th class="text-center">Return Date</th>
                      <th class="text-center">Borrower Name</th>
                      <th class="text-center">Rent Duration (days)</th>
                      <th class="text-center">Total Book</th>
                      <th class="text-center">Total Price</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
      </div>
</div>
@endrole

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

    var columns = [
      {data: 'DT_RowIndex', class: 'text-center', orderable: true},
      {data: 'date_start', class: 'text-center', orderable: true},
      {data: 'date_end', class: 'text-center', orderable: true},
      {data: 'name', class: 'text-center', orderable: true},
      {data: 'rent_durations', class: 'text-center', orderable: true},
      {data: 'total_books', class: 'text-center', orderable: true},
      {data: 'show_price', class: 'text-center', orderable: true},
      {data: 'show_status', class: 'text-center', orderable: true},
      {render: function (index, row, data, meta) {
        return `
          <form action="/transactions/${data.id}" method="post">
            <a href="/transactions/${data.id}" class="btn btn-sm btn-info">
              Detail
            </a>
            <a href="/transactions/${data.id}/edit" class="btn btn-sm btn-warning">
              Edit
            </a>
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            @csrf
            @method('DELETE')
          </form>
            `;
      }, orderable: false, width: '200px', class: 'text-center'},
    ];
</script>

<script src="{{ url('js/data.js') }}"></script>
<script type="text/javascript">
  $('select[name=status]').on('change', function() {
    status = $('select[name=status]').val();

    if (status == '1' || status == '0') {
      controller.table.ajax.url(apiUrl+'?status='+status).load();
    } else {
      controller.table.ajax.url(apiUrl).load();
    }
  });

  $('select[name=date_start]').on('change', function() {
    date_start = $('select[name=date_start]').val();

    if (date_start == "0") {
      controller.table.ajax.url(apiUrl).load();
    } else {
      controller.table.ajax.url(apiUrl+'?date_start='+date_start).load();
    }
  });
</script>
@endsection