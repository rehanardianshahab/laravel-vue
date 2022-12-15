@extends('layouts.admin')

@section('header', 'Publisher')

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
                  <th class="text-center">Publisher Name</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Phone Number</th>
                  <th class="text-center">Address</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($publishers as $key => $publisher)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $publisher->publisher_name }}</td>
                  <td>{{ $publisher->email }}</td>
                  <td>{{ $publisher->phone_number }}</td>
                  <td>{{ $publisher->address }}</td>
                  <td class="d-flex justify-content-center">
                    <a href="#" @click="editData({{ $publisher }})" class="btn btn-sm btn-warning">Edit</a>|
                    <a href="#" @click="deleteData({{ $publisher->id }})" class="btn btn-sm btn-danger">Delete</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
    </div>
  </div>

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <form :action="actionUrl" method="post" autocomplete="off">
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
              <label for="publisher_name">Name</label>
              <input type="text" id="publisher_name" class="form-control" name="publisher_name" :value="data.publisher_name" required>
            </div>
            
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" id="email" class="form-control" name="email" :value="data.email" required>
            </div>
  
            <div class="form-group">
              <label for="phone_number">Phone Number</label>
              <input type="text" id="phone_number" class="form-control" name="phone_number" :value="data.phone_number" required>
            </div>
  
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" id="address" class="form-control" name="address" :value="data.address" required>
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
<script>
  $(function () {
    $("#datatable").DataTable();
  });
</script>
{{-- CRUD Vue JS --}}
<script type="text/javascript">
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
</script>
@endsection