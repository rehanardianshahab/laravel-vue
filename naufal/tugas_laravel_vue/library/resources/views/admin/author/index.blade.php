@extends('layouts.admin')

@section('header', 'Author')

@section('css')

@endsection

@section('content')
<div id="controller">
  <div class="row">
    <div class="col-12">
      <div class="card">
          <div class="card-header">
            <a href="#" @click="addData()" class="btn btn-sm btn-primary">Create New Author</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th class="text-center">Author Name</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Phone Number</th>
                  <th class="text-center">Address</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($authors as $key => $author)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $author->author_name }}</td>
                  <td>{{ $author->email }}</td>
                  <td class="text-center">{{ $author->phone_number }}</td>
                  <td>{{ $author->address }}</td>
                  <td>
                    <a href="#" @click="editData({{ $author }})" class="btn btn-sm btn-warning">Edit</a>
                    <a href="#" @click="deleteData({{ $author->id }})" class="btn btn-sm btn-danger">Delete</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
  </div>
  
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <form :action="actionUrl" method="post" autocomplete="off">
            <div class="modal-header">
              <h4 class="modal-title">Author</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              @csrf

              <input type="hidden" name="_method" value="put" v-if="editStatus">
    
              <div class="form-group">
                <label for="author_name">Name</label>
                <input type="text" id="author_name" class="form-control" name="author_name" :value="data.author_name" required>
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
    <!-- /.modal -->
</div>
@endsection

@section('js')
  <script type="text/javascript">
    var controller = new Vue ({
      el: '#controller',
      data: {
          data : {},
          actionUrl : '{{ url('authors') }}',
          editStatus : false
      },
      mounted: function () {

      },
      methods: {
          addData() {
            this.data = {};
            this.actionUrl = '{{ url('authors') }}';
            this.editStatus = false;
            $('#modal-default').modal();
          },
          editData(data) {
            this.data = data;
            this.actionUrl = '{{ url('authors') }}'+'/'+data.id;
            this.editStatus = true;
            $('#modal-default').modal();
          },
          deleteData(id) {
            this.actionUrl = '{{ url('authors') }}'+'/'+id;
            if (confirm("Are you sure?")) {
              axios.post(this.actionUrl, {_method: 'DELETE'}).then(response => {
                location.reload();
              });
            }
          }
      }
    });
  </script>
@endsection