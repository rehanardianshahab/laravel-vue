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
                <a href="#" @click="addData()" class="btn btn-primary pull-right">Create New Author</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th class="text-center">Name</th>
                      <th class="text-center">Email</th>
                      <th class="text-center" width="200px">Phone Number</th>
                      <th class="text-center">Address</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($authors as $key => $author)
                    
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $author->name }}</td>
                      <td>{{ $author->email }}</td>
                      <td>{{ $author->phone_number }}</td>
                      <td>{{ $author->address }}</td>
                      <td class="text-right">
                        <a href="#" @click="editData({{ $author }})" class="btn btn-warning btn-sm">Edit</a>
                        <a href="#" @click="deleteData({{ $author->id }})" class="btn btn-danger btn-sm">Delete</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" :action="actionUrl" autocomplete="off">
            <div class="modal-header">

              <h4 class="modal-title">Author</h4>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  @csrf
                
                  <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter name" :value="data.name" required="">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Enter email" :value="data.email" required="">
                  </div>
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" placeholder="Enter phone number" 
                    :value="data.phone_number" required="">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <textarea type="text" name="address" class="form-control" placeholder="Enter address" rows="6" cols="80" 
                    :value="data.address" required=""></textarea>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
          </div>
        </div>
      </div>
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
            if (confirm("Are you sure ?")) {
              axios.post(this.actionUrl, {_method: 'DELETE'}).then(response => {
                location.reload();
              });
            }
          }
        }
      });
    </script>
@endsection