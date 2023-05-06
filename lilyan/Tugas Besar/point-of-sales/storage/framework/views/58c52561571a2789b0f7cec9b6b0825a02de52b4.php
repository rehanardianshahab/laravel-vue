
<?php $__env->startSection('header', 'Daftar Pembelian'); ?>

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
            <a href="#" @click="addData()" class="btn btn-outline-primary pull-right"><i class="fa-solid fa-square-plus"></i>&nbsp; Tambah Transaksi Baru</a>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <table id="datatable" class="table table-striped table-bordered w-100">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Supplier</th>
                    <th class="text-center">Total Item</th>
                    <th class="text-center">Total Harga</th>
                    <th class="text-center">Diskon</th>
                    <th class="text-center">Total Bayar</th>
                    <th class="text-right">Opsi</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

<?php if ($__env->exists('purchase.supplier')) echo $__env->make('purchase.supplier', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!-- DataTables  & Plugins -->
<script src="<?php echo e(asset('assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>

<script type="text/javascript">
  var actionUrl = '<?php echo e(url('purchases')); ?>';
  var apiUrl = '<?php echo e(url('api/purchases')); ?>';

  var columns = [
    {data: 'DT_RowIndex', class: 'text-center', orderable: true},
    {data: 'tanggal', class: 'text-center', orderable: true},
    {data: 'name', class: 'text-center', orderable: true},
    {data: 'total_item', class: 'text-center', orderable: true},
    {data: 'total_price', class: 'text-center', orderable: true},
    {data: 'discount', class: 'text-center', orderable: true},
    {data: 'payment', class: 'text-center', orderable: true},

    {render: function (index, row, data, meta) {
      return `
        <form action="/purchases/${data.id}" method="post">
            <a href="/purchases/${data.id}" class="btn btn-sm btn-info">
              Detail
            </a>
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
        </form>`;
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Eduwork Bootcamp\laravel-vue\laravel-vue\lilyan\Tugas Besar\point-of-sales\resources\views/purchase/index.blade.php ENDPATH**/ ?>