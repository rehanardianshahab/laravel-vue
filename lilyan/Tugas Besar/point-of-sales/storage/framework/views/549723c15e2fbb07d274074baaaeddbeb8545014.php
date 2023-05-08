
<?php $__env->startSection('header', 'Member'); ?>

<?php $__env->startSection('css'); ?>
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div id="controller">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a href="#" @click="addData()" class="btn btn-outline-primary pull-right"><i class="fa-solid fa-square-plus"></i>&nbsp; Tambah Member</a>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <form action="" method="post" class="form-member">
              <?php echo csrf_field(); ?>
              <table id="datatable" class="table table-striped table-bordered w-100">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th class="text-center">Kode Member</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Telepon</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-right">Opsi</th>
                  </tr>
                </thead>
              </table>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" :action="actionUrl" autocomplete="off" @submit="submitForm($event, data.id)">
            <div class="modal-header">
              <h4 class="modal-title">Member</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="_method" value="PUT" v-if="editStatus">
                <div class="form-group">
                  <label>Nama</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukan nama" :value="data.name" required autofocus>
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="number" name="phone_number" class="form-control" placeholder="Masukan telepon" :value="data.phone_number" required="">
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                    <textarea name="address" rows="3" class="form-control" placeholder="Masukan alamat" :value="data.address" required=""></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark"></i>&nbsp; Tutup</button>
              <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i>&nbsp; Simpan</button>
            </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!-- DataTables  & Plugins -->
<script src="<?php echo e(asset('assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>

<script type="text/javascript">
  var actionUrl = '<?php echo e(url('members')); ?>';
  var apiUrl = '<?php echo e(url('api/members')); ?>';

  var columns = [
    {data: 'DT_RowIndex', class: 'text-center', orderable: true},
    {data: 'member_code', class: 'text-center', orderable: true},
    {data: 'name', class: 'text-center', orderable: true},
    {data: 'phone_number', class: 'text-center', orderable: true},
    {data: 'address', class: 'text-center', orderable: true},
    {render: function (index, row, data, meta) {
      return `
      <a href="#" class="btn btn-warning btn-sm" onclick="controller.editData(event,
      ${meta.row})">
      <i class="fa-regular fa-pen-to-square"></i> Edit
      </a>
      <a class="btn btn-danger btn-sm" onclick="controller.deleteData(event,
      ${data.id})">
      <i class="fa-solid fa-trash-can"></i> Delete
      </a>`;
    }, orderable:false, width: '200px', class: 'text-center'},
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
            _this.table = $("#datatable")
                .DataTable({
                    ajax: {
                        url: _this.apiUrl,
                        type: "GET",
                    },
                    columns,
                })
                .on("xhr", function () {
                    _this.datas = _this.table.ajax.json().data;
                });
        },

        addData() {
            this.data = {};
            this.editStatus = false;
            $("#modal-default").modal();
        },
        editData(event, row) {
            this.data = this.datas[row];
            this.editStatus = true;
            $("#modal-default").modal();
        },
        deleteData(event, id) {
            if (confirm("Are you sure ?")) {
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
                    $("#modal-default").modal("hide");
                    _this.table.ajax.reload();
                });
        },
    },
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Eduwork Bootcamp\TUGAS BESAR\point-of-sales\resources\views/member/index.blade.php ENDPATH**/ ?>