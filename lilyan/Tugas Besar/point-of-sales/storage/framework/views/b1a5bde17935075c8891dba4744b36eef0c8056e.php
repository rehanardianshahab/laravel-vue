
<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="alert alert-info" role="alert">
                    <h4 class="alert-heading">Selamat Datang, <?php echo e(ucwords(Auth::user()->name)); ?></h4>
                    <p>Sekarang Anda dapat menggunakan fitur-fitur dalam sistem ini sesuai dengan hak akses yag diberikan.</p>
                    <hr>
                    <p class="mb-0"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Eduwork Bootcamp\TUGAS BESAR\point-of-sales\resources\views/home.blade.php ENDPATH**/ ?>