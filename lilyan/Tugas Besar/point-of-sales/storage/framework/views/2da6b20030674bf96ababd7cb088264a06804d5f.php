<div class="modal fade" id="modal-member">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pilih Member</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-member">
                        <thead>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Telepon</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Opsi</th>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $member; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($key+1); ?></td>
                                    <td class="text-center"><?php echo e($data->name); ?></td>
                                    <td class="text-center"><?php echo e($data->phone_number); ?></td>
                                    <td class="text-center"><?php echo e($data->address); ?></td>
                                    <td class="text-center">
                                        <a href="#" onclick="selectMember('<?php echo e($data->id); ?>', '<?php echo e($data->member_code); ?>')" class="btn btn-info pull-right">
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
</div><?php /**PATH E:\Eduwork Bootcamp\laravel-vue\laravel-vue\lilyan\Tugas Besar\point-of-sales\resources\views/sale_detail/member.blade.php ENDPATH**/ ?>