@extends('master.master')

@section('header', 'MANUFACTURER')

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
            <h2>Manufacturer</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          @role('admin')
          <div>
            <a href="#" @click="addData()" class="btn btn-info btn-sm">Add Manufacturer</a>
          </div>
          @endrole
            <div class="x_content">
                <div class="row">
                  <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                    <th>No</th>
                                    <th>Manufacture Company</th>
                                    <th>Country</th>
                                    <th>Established</th>
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

    {{-- Modal --}}
    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form :action="actionUrl" method="POST" autocomplete="off"  @submit="submitForm($event, data.id)">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Manufacturer's Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_method" value="PUT" v-if="editStatus">
                        @csrf

                        {{-- Manufacture Company --}}
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Manufacture Company<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input type="text" class="form-control" :value="data.manufacture_company" data-validate-length-range="6" data-validate-words="2" name="manufacture_company" required="required" />
                            </div>
                        </div>

                        {{-- Country --}}
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Country<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input type="text" class="form-control" :value="data.country" data-validate-length-range="6" data-validate-words="2" name="country" required="required" />
                            </div>
                        </div>

                        {{-- Established --}}
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Established<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input type="date" class="date-picker form-control" :value="data.established" data-validate-length-range="6" data-validate-words="2" name="established" required="required" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
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
var actionUrl = '{{ url('manufacturers') }}';
var apiUrl = '{{ url('api/manufacturers') }}';

var columns = [
        {data: 'DT_RowIndex', class: 'text-center', orderable: true},
        {data: 'manufacture_company', class: 'text-center', orderable: true},
        {data: 'country', class: 'text-center', orderable: true},
        {data: 'show_date', class: 'text-center', orderable: true},
        {render: function (index, row, data, meta) {
            return `
                @role('admin')
                <a href="#" class="btn btn-sm btn-warning" onclick="controller.editData(event, ${meta.row})">
                Edit
                </a>
                <a href="#" class="btn btn-sm btn-danger" onclick="controller.deleteData(event, ${data.id})">
                Delete
                </a>
                @endrole
                @role('member')
                <p>Permission not granted</p>
                @endrole`;
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
                this.data = this.datas[row];
                // this.actionUrl = '{{ url('members') }}'+'/'+this.data.id;
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
                    })
                    .then((response) => {
                        alert("Data submitted successfully!")
                    });
            },
        }
    });
</script>
@endsection