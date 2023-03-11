@extends('master.master')

@section('header', 'MEMBER')

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
            <h2>Gundam Store's Member</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
            <div class="x_content">
                <div class="row">
                  <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Gender</th>
                                    <th>Role</th>
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
    
    <!-- Modal -->
    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form :action="actionUrl" method="POST" autocomplete="off"  @submit="submitForm($event, data.id)">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Member's Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                        {{-- Name --}}
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" :value="data.name" data-validate-length-range="6" data-validate-words="2" name="name" required="required" />
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Address<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <textarea required="required" class="form-control" name='address'>@{{ data.address }}</textarea></div>
                        </div>

                        {{-- Email --}}
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Email<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" :value="userData.email" name="email" class='email' required="required" type="email" /></div>
                        </div>

                        {{-- Phone Number --}}
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Phone Number<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" :value="data.phone_number" type="text" class='form-control' name="phone_number" required='required' /></div>
                        </div>

                        {{-- Gender --}}
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Gender<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6" v-if="data.gender == 'male'">
                                <p class="mt-2">
                                    Male:
                                    <input type="radio" class="flat" name="gender" id="genderM" value="male" checked="" required /> Female:
                                    <input type="radio" class="flat" name="gender" id="genderF" value="female" />
                                </p>
                            </div>
                            <div class="col-md-6 col-sm-6" v-else>
                                <p class="mt-2">
                                    Male:
                                    <input type="radio" class="flat" name="gender" id="genderM" value="male" required /> Female:
                                    <input type="radio" class="flat" name="gender" id="genderF" value="female" checked="" />
                                </p>
                            </div>
                        </div>

                        {{-- Is Admin --}}
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Is Admin?<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6" v-if="data.role == 'admin'">
                                <p class="mt-2">
                                    Admin:
                                    <input type="radio" class="flat" name="is_admin" id="admin" value="1" checked="" required /> Member:
                                    <input type="radio" class="flat" name="is_admin" id="member" value="0" />
                                </p>
                            </div>
                            <div class="col-md-6 col-sm-6" v-else>
                                <p class="mt-2">
                                    Admin:
                                    <input type="radio" class="flat" name="is_admin" id="admin" value="1" required /> Member:
                                    <input type="radio" class="flat" name="is_admin" id="member" value="0" checked="" />
                                </p>
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
    var actionUrl = '{{ url('members') }}';
    var apiUrl = '{{ url('api/members') }}';

    var columns = [
        {data: 'name', class: 'text-center', orderable: true},
        {data: 'address', class: 'text-center', orderable: true},
        {data: 'user.email', class: 'text-center', orderable: true},
        {data: 'phone_number', class: 'text-center', orderable: true},
        {data: 'gender', class: 'text-center', orderable: true},
        {data: 'role', class: 'text-center', orderable: true},
        {render: function (index, row, data, meta) {
            return `
                <a href="#" class="btn btn-sm btn-warning" onclick="controller.editData(event, ${meta.row})">
                Edit
                </a>
                <a href="#" class="btn btn-sm btn-danger" onclick="controller.deleteData(event, ${data.id})">
                Delete Account
                </a>`;
        }, orderable: false, width: '200px', class: 'text-center'},
    ]; 

    var controller = new Vue({
        el: "#controller",
        data: {
            datas: [],
            data: {},
            userData: {},
            actionUrl,
            apiUrl,
            editStatus: true
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
            editData(event, row) {
                this.data = this.datas[row];
                this.userData = this.data.user;
                // this.actionUrl = '{{ url('members') }}'+'/'+this.data.id;
                this.editStatus;
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
                axios
                    .post(this.actionUrl + "/" + id, new FormData($(event.target)[0]))
                    .then((response) => {
                        $("#modalForm").modal("hide");
                        _this.table.ajax.reload();
                    });
            }
        }
    });
</script>
<script type="text/javascript">
    
</script>
@endsection