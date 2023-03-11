@extends('master.master')

@section('header', 'PRODUCT TRANSACTIONS')

@section('css')
<link href="{{ asset('assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div id="controller">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data Transaction</h2>
                <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Settings 1</a>
                        <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <a href="/transactions/create" class="btn btn-sm btn-primary mb-2">Add Transaction</a>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Invoice Number</th>
                                    <th>Name</th>
                                    <th>Purchase Date</th>
                                    <th>Repayment Date</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- Datatables -->
<script src="{{asset('assets/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{asset('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{asset('assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{asset('assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
<script src="{{asset('assets/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{asset('assets/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{asset('assets/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{asset('assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{asset('assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{asset('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{asset('assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<script src="{{asset('assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
<script src="{{asset('assets/vendors/jszip/dist/jszip.min.js') }}"></script>
<script src="{{asset('assets/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{asset('assets/vendors/pdfmake/build/vfs_fonts.js') }}"></script>

{{-- Data --}}
<script type="text/javascript">
var actionUrl = '{{ url('transactions') }}';
var apiUrl = '{{ url('api/transactions') }}';

var columns = [
        {data: 'DT_RowIndex', class: 'text-center', orderable: true},
        {data: 'invoice_number', class: 'text-center', orderable: true},
        {data: 'name', class: 'text-center', orderable: true},
        {data: 'purchase_date', class: 'text-center', orderable: true},
        {data: 'repayment_date', class: 'text-center', orderable: true},
        {data: 'total_price', class: 'text-center', orderable: true},
        {data: 'status', class: 'text-center', orderable: true},
        {render: function (index, row, data, meta) {
            return `
                <a href="/transactions/{transactions}/edit" class="btn btn-sm btn-info">
                Details
                </a>
                <a href="/transactions/{transactions}/edit" class="btn btn-sm btn-warning">
                Edit
                </a>
                <a href="/transactions/{transactions}" class="btn btn-sm btn-danger">
                Delete
                </a>`;
        }, orderable: false, width: '200px', class: 'text-center'},
    ];

    var controller = new Vue({
        el: "#controller",
        data: {
            datas: [],
            data: {},
            actionUrl,
            apiUrl,
            editStatus: false,
        },
        mounted: function () {
            this.datatable();
        },
        methods: {
            datatable() {
                const _this = this;
                _this.table = $('#datatable').DataTable({
                        ajax: {
                            url: _this.apiUrl,
                            type: 'GET',
                        },
                        columns: columns,
                    }).on ('xhr', function() {
                        _this.datas = _this.table.ajax.json().data;
                    });
            },
            addData() {
                this.data = {};
                this.editStatus = false;
                $("#modalForm").modal();
            },
            editData(event, row) {
                event.preventDefault();
                this.data = this.datas[row];
                this.editStatus = true;
                $("#modalForm").modal();
            },
            deleteData(event, id) {
                if (confirm("Are you sure?")) {
                $(event.target).parents("tr").remove();
                axios
                    .post(this.actionUrl + "/" + id, { _method: "DELETE" })
                    .then((response) => {
                        alert("Data has been removed");
                    });
                }
            },
            submitForm(event, id) {
                event.preventDefault();
                const _this = this;
                var actionUrl = !this.editStatus 
                    ? this.actionUrl 
                    : this.actionUrl + "/" + id;
                axios
                    .post(actionUrl, new FormData($(event.target)[0]))
                    .then((response) => {
                        $("#modalForm").modal("hide");
                        _this.table.ajax.reload();
                    });
            },
        }
    });
</script>
@endsection