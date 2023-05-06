
<?php $__env->startSection('header', 'Penjualan'); ?>

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
            <a href="<?php echo e(route('transactions.new')); ?>" class="btn btn-outline-primary pull-right"><i class="fa-solid fa-square-plus"></i>&nbsp; Tambah Penjualan</a>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <table id="datatable" class="table table-striped table-bordered w-100">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">kode Member</th>
                    <th class="text-center">Total Item</th>
                    <th class="text-center">Total Harga</th>
                    <th class="text-center">Diskon</th>
                    <th class="text-center">Total Bayar</th>
                    <th class="text-center">Diterima</th>
                    <th class="text-center">Kasir</th>
                    <th class="text-center">Opsi</th>
                  </tr>
                </thead>
              </table>
            </div>
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
<script src="<?php echo e(asset('assets/plugins/select2/js/select2.full.min.js')); ?>"></script>


<script type="text/javascript">
  var actionUrl = '<?php echo e(url('sales')); ?>';
  var apiUrl = '<?php echo e(url('api/sales')); ?>';

  var columns = [
    {data: 'DT_RowIndex', class: 'text-center', orderable: true},
    {data: 'created_at', class: 'text-center', orderable: true},
    {data: 'member_code', class: 'text-center', orderable: true},
    {data: 'total_item', class: 'text-center', orderable: true},
    {data: 'total_price', class: 'text-center', orderable: true},
    {data: 'discount', class: 'text-center', orderable: true},
    {data: 'payment', class: 'text-center', orderable: true},
    {data: 'cash', class: 'text-center', orderable: true},
    {data: 'cashier', class: 'text-center', orderable: true},
    {render: function (index, row, data, meta) {
      return `
        <form action="/sales/${data.id}" method="post">
            <a href="/sales/${data.id}" class="btn btn-sm btn-info">
              Detail
            </a>
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
        </form>`;
    }, orderable:false, width: '200px', class: 'text-center'},
  ];

</script>
<script src="<?php echo e(asset('js/data.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Eduwork Bootcamp\TUGAS BESAR\point-of-sales\resources\views/sale/index.blade.php ENDPATH**/ ?>