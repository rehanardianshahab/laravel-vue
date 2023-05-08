<div class="modal fade" id="modal-product" tabindex="-1" role="dialog" aria-labelledby="modal-product">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pilih Produk</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-product">
                        <thead>
                            <th class="text-center">No</th>
                            <th class="text-center">Kode</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Harga Beli</th>
                            <th class="text-center">Opsi</th>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($key+1); ?></td>
                                    <td class="text-center"><span class="badge badge-success"><?php echo e($data->product_code); ?></span></td>
                                    <td class="text-center"><?php echo e($data->name_product); ?></td>
                                    <td class="text-center"><?php echo e($data->purchase_price); ?></td>
                                    <td class="text-center">
                                        <a href="#" onclick="selectProduct('<?php echo e($data->id); ?>', '<?php echo e($data->product_code); ?>')" class="btn btn-info pull-right">
                                            <i class="fa-regular fa-circle-check"></i>&nbsp; 
                                            Pilih
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div><?php /**PATH E:\Eduwork Bootcamp\laravel-vue\laravel-vue\lilyan\Tugas Besar\point-of-sales\resources\views/sale_detail/product.blade.php ENDPATH**/ ?>