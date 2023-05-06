
<?php $__env->startSection('header', 'Detail Pembelian'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div id="controller">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a href="<?php echo e(url('purchases')); ?>" class="btn btn-outline-primary pull-right"><i class="fa-solid fa-rotate-left"></i>&nbsp; Kembali Ke Daftar Pembelian</a>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <div class="card-responsive">
                <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Kode</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $purchaseDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                    <tr>
                      <td class="text-center"><?php echo e($key+1); ?></td>
                      <td class="text-center"><?php echo e($detail->product_code); ?></td>
                      <td class="text-center"><?php echo e($detail->name_product); ?></td>
                      <td class="text-center"><?php echo e(currency_IDR($detail->purchase_price)); ?></td>
                      <td class="text-center"><?php echo e($detail->amount); ?></td>
                      <td class="text-center"><?php echo e(currency_IDR($detail->subtotal)); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Eduwork Bootcamp\laravel-vue\laravel-vue\lilyan\Tugas Besar\point-of-sales\resources\views/purchase/show.blade.php ENDPATH**/ ?>