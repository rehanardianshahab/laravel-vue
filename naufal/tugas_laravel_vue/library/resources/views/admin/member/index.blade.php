@extends('layouts.admin')

@section('header', 'Member')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />
@endsection

@section('content')
<div id="controller">
  <div class="row">
    <div class="col-12">
      <div class="card">
          <div class="card-header">
            <a href="#" @click="addData()" class="btn btn-sm btn-primary">Create New Publisher</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="datatable" class="table">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Gender</th>
                  <th class="text-center">Phone Number</th>
                  <th class="text-center">Address</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Role</th>
                  <th class="text-center">Entry Date</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
    </div>
  </div>

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <form :action="actionUrl" method="post" autocomplete="off" @submit="submitForm($event, data.id)">
          <div class="modal-header">
            <h4 class="modal-title">Publisher</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @csrf

            <input type="hidden" name="_method" value="PUT" v-if="editStatus">
  
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" class="form-control" name="name" :value="data.name" required>
            </div>

            <div class="form-group">
              <label for="gender">Gender</label>
              <select class="form-control" name="gender" id="gender" :value="data.gender">
                  <option value="M">Male</option>
                  <option value="F">Female</option>
              </select>
            </div>

            <div class="form-group">
              <label for="phone_number">Phone Number</label>
              <input type="text" id="phone_number" class="form-control" name="phone_number" :value="data.phone_number" required>
            </div>
  
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" id="address" class="form-control" name="address" :value="data.address" required>
            </div>
            
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" id="email" class="form-control" name="email" :value="data.email" required>
            </div>
  
            <div class="form-group">
              <label for="role">Role</label>
              <select class="form-control" name="role" id="role" :value="data.role">
                  <option value="Admin">Admin</option>
                  <option value="Member">Member</option>
              </select>
            </div> 

            <div class="form-group">
              <label for="entry_date">Entry Date</label>
              <input type="date" id="entry_date" class="form-control" name="entry_date" :value="data.entry_date" required>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>

<!-- /.modal -->
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
    var actionUrl = '{{ url('members') }}';
    var apiUrl = '{{ url('api/members') }}';

    var columns = [
      {data: 'DT_RowIndex', class: 'text-center', orderable: true},
      {data: 'name', class: 'text-center', orderable: true},
      {data: 'gender', class: 'text-center', orderable: true},
      {data: 'phone_number', class: 'text-center', orderable: true},
      {data: 'address', class: 'text-center', orderable: true},
      {data: 'email', class: 'text-center', orderable: true},
      {data: 'role', class: 'text-center', orderable: true},
      {data: 'entry_date', class: 'text-center', orderable: true},
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
</script>

<script src="{{ url('js/data.js') }}"></script>

{{-- <script>
  $(function () {
    $("#datatable").DataTable();
  });
</script> --}}
{{-- CRUD Vue JS --}}
{{-- <script type="text/javascript">
  var controller = new Vue ({
      el: '#controller',
      data: {
          data : {},
          actionUrl : '{{ url('publishers') }}',
          editStatus : false
      },
      mounted: function () {

      },
      methods: {
          addData() {
            this.data = {};
            this.actionUrl = '{{ url('publishers') }}';
            this.editStatus = false;
            $('#modal-default').modal();
          },
          editData(data) {
            this.data = data;
            this.actionUrl = '{{ url('publishers') }}'+'/'+data.id;
            this.editStatus = true;
            $('#modal-default').modal();
          },
          deleteData(id) {
            this.actionUrl = '{{ url('publishers') }}'+'/'+id;
            if(confirm('Are you sure?')) {
              axios.post(this.actionUrl, {_method: 'DELETE'}).then(response => {
                location.reload();
              });
            }
          }
      }
  });
</script> --}}
@endsection