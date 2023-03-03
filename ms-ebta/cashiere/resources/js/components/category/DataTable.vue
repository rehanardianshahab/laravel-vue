<script>
export default {
  data() {
    return {
        url: import.meta.env.VITE_APP_URL,
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
  },
  methods: {
    addForm(laman) {
        $('#FormModal').modal('show');
        $('#FormModal .modal-title').text('Add New Kategory');

        // // reset alert
        if ($( "#notif" ).hasClass('d-none')) {

        } else {
            $( "#notif" ).addClass( 'd-none');
        }

        // // action
        $('#FormModal form').attr('action', this.url+laman)

        // // method form
        $('[name=_method]').val('put');

        // // input form
        $('#FormModal [name=name]').focus();
    },
    resetForm () {
      // reset form
      $('#FormModal form')[0].reset();
    }
  },
  mounted() {
    console.log("my env variable:");
    console.log(this.url);
  }
}
</script>

<template>
  <section class="content">
    <div class="modal fade" id="FormModal" tabindex="-1" aria-labelledby="FormModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form action="" method="post" class="form-horizontal">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="FormModalLabel">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Alert -->
            <div class="d-none" id="notif" role="alert">
                <span class="text">This</span>
                <button type="button" class="close">
                <span onclick="closeNotif()">&times;</span>
                </button>
            </div>
            <!-- /.alert -->
            <div class="modal-body">
              <!-- csrf token dan method -->
              <input type="hidden" name="_token" :value="csrf">
              <input type="hidden" name="_method" value="post">
              <!-- end csrf token dan method -->
              <div class="form-group row">
                <label for="name" class="col-md-4 control-label">Category Name</label>
                <div class="col-md-8">
                    <input type="text" name="name" id="name" class="form-control" required autocomplete="off">
                    <span class="help-block with-errors"></span>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="resetForm()">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="container-fluid pb-5">

      <div class="row">
        <div class="col-md-12">

            <!-- Alert -->
            <div class="d-none" id="notif-utama" role="alert">
                <span class="text"></span>
                <button type="button" class="close">
                    <span onclick="closeNotif()">&times;</span>
                </button>
            </div>
            <!-- /.alert -->

          <div class="card">
            <!-- card-header -->
            <div class="card-header">
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" @click="addForm('/api')"><i class="bi bi-patch-plus"></i> Add</button>
            </div>
            <!-- /.card-header -->

            <div class="card-body table-responsive">
                <!-- <table class="table table-stiped table-bordered"> -->
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <th width="5%">No</th>
                        <th>Category</th>
                        <th width="15%"><i class="bi bi-gear-wide-connected"></i></th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- ./card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </div><!--/. container-fluid -->
  </section>
</template>