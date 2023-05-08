
<?php $__env->startSection('header', 'Pengaturan'); ?>

<?php $__env->startSection('css'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/setting.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-8">
      <?php $__currentLoopData = $setting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="card">
        <div class="card-header">
          <div class="logo-perusahaan">
            <img src="<?php echo e(asset('img/'. $item->path_logo )); ?>" width="200px" alt="">
          </div><hr>
        <div class="card-body">
          <div class="row">
            <table>
              <tr>
                <th class="card-text" width="150px">Nama Perusahaan</th>
                <th width="30px">:</th>    
                <th class="card-title"><?php echo e($item->name_store); ?></th>
              </tr>
              <tr>
                <th width="150px">Alamat</th>
                <th width="30px">:</th>    
                <th class="card-title"><?php echo e($item->address); ?></th>
              </tr>
              <tr>
                <th width="150px">Telepon</th>
                <th width="30px">:</th>    
                <th class="card-title"><?php echo e($item->phone_number); ?></th>
              </tr>
              <tr>
                <th width="150px">Diskon Member</th>
                <th width="30px">:</th>    
                <th class="card-title"><?php echo e($item->discount); ?>%</th>
              </tr>
            </table>
          </div><hr>
          <a href="<?php echo e(url('settings/'.$item->id.'/edit')); ?>" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i>&nbsp; Edit Pengaturan</a>
        </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Eduwork Bootcamp\TUGAS BESAR\point-of-sales\resources\views/setting/index.blade.php ENDPATH**/ ?>