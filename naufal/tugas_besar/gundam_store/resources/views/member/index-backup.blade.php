@extends('master.master')

@section('header', 'MEMBER')

@section('content')
<div class="content-wrapper">
    <div id="controller">
        <div class="row justify-content-center">
            <div class="col-lg-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Gundam Store's Member</h4>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold">Name</th>
                                        <th class="font-weight-bold">Address</th>
                                        <th class="font-weight-bold">Phone Number</th>
                                        <th class="font-weight-bold">Gender</th>
                                        <th class="font-weight-bold">Role</th>
                                        <th class="font-weight-bold">Action</th>
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
<script type="text/javascript">
    var actionUrl = '{{ url('members') }}';
    var apiUrl = '{{ url('api/members') }}';

    var columns = [
        {data: 'name', class: 'text-center', orderable: true},
        {data: 'address', class: 'text-center', orderable: true},
        {data: 'phone_number', class: 'text-center', orderable: true},
        {data: 'gender', class: 'text-center', orderable: true},
        {data: 'role', class: 'text-center', orderable: true},
        {render: function (index, row, data, meta) {
            return `
                <a href="#" class="btn btn-sm btn-warning" onclick="controller.editData(event, ${meta.row})">
                Edit
                </a>
                <a href="#" class="btn btn-sm btn-danger" onclick="controller.deleteData(event, ${data.id})">
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
            apiUrl
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
        }
    });
</script>
<script type="text/javascript">
    
</script>
@endsection