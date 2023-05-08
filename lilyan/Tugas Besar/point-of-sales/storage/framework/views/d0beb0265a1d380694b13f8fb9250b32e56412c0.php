
<?php $__env->startSection('header', 'Detail Pembelian'); ?>

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
            <a href="<?php echo e(url('sales')); ?>" class="btn btn-outline-primary pull-right"><i class="fa-solid fa-rotate-left"></i>&nbsp; Kembali Ke Daftar Penjualan</a>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <div class="card-responsive">
                <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Kode Produk</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $saleDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                    <tr>
                      <td class="text-center"><?php echo e($key+1); ?></td>
                      <td class="text-center"><?php echo e($detail->product_code); ?></td>
                      <td class="text-center"><?php echo e($detail->name_product); ?></td>
                      <td class="text-center"><?php echo e(currency_IDR($detail->selling_price)); ?></td>
                      <td class="text-center"><?php echo e($detail->amount); ?></td>
                      <td class="text-center"><?php echo e(currency_IDR($detail->subtotal)); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-info pull-right" onclick="notaKecil('<?php echo e(route('transactions.nota_kecil')); ?>', 'Nota Kecil')"><i class="fa-solid fa-print"></i>&nbsp; Cetak Nota</button>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
  document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  
  function notaKecil(url, title) 
  {
    popupCenter(url, title, 625, 500);
  }

  // https://stackoverflow.com/questions/4068373/center-a-popup-window-on-screen
  function popupCenter(url, title, w, h) {
    const dualScreenLeft = window.screenLeft !==  undefined   ? window.screenLeft : window.screenX;
    const dualScreenTop  = window.screenTop  !==  undefined   ? window.screenTop  : window.screenY;

    const width  = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    const systemZoom = width / window.screen.availWidth;
    const left       = (width - w) / 2 / systemZoom + dualScreenLeft
    const top        = (height - h) / 2 / systemZoom + dualScreenTop
    const newWindow  = window.open(url, title, 
      `
      scrollbars=yes,
      width    =${w / systemZoom}, 
      height   =${h / systemZoom}, 
      top      =${top}, 
      left     =${left}
      `
    );

    if (window.focus) newWindow.focus();
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Eduwork Bootcamp\laravel-vue\laravel-vue\lilyan\Tugas Besar\point-of-sales\resources\views/sale/show.blade.php ENDPATH**/ ?>