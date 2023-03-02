<script>
import imagePlus from "./assets/circle-plus-solid.svg"


export default {
    data: function () {
        return {
            imagePlus
        }
    }
}
</script>

<template>
  <section class="content">
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
              <button class="btn btn-success xs btn-flat rounded" onclick="addForm('{{ route('category.store') }}')"><!--<img :src="imagePlus" width="20" />--><i class="bi bi-patch-plus"></i> Add</button>
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