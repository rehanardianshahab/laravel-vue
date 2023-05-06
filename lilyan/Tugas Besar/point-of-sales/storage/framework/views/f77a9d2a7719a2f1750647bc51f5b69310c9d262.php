
<?php $__env->startSection('header', 'Transaksi Pembelian'); ?>

<?php $__env->startSection('css'); ?>
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/tampil_bayar_terbilang.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div id="controller">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            
            <table>
              <?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td>Supplier</td>
                <td>: <?php echo e($suppliers->name); ?></td>
              </tr>
              <tr>
                <td>Telepon</td>
                <td>: <?php echo e($suppliers->phone_number); ?></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>: <?php echo e($suppliers->address); ?></td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <form class="form-product">
                <?php echo csrf_field(); ?>
                <div class="form-group row">
                <label for="product_code" class="col-lg-2">Kode Produk</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <input type="hidden" name="purchase_id" id="purchase_id" value="<?php echo e($purchase_id); ?>">
                      <input type="hidden" name="product_id" id="product_id">
                      <input type="text" class="form-control" name="product_code" id="product_code">
                      <span class="input-group-btn">
                        <button onclick="showProduct()" class="btn btn-info btn-flat" type="button"><i class="fa fa-arrow-right"></i></button>
                      </span>
                    </div>
                  </div>
                </div>
              </form>
              
              <table class="table table-striped table-bordered w-100 table-purchase">
                <thead>
                    <th style="width: 10px">No</th>
                    <th class="text-center">Kode</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Harga Beli</th>
                    <th width="10%" class="text-center">Jumlah</th>
                    <th class="text-center">Subtotal</th>
                    <th class="text-center">Opsi</th>
                </thead>
              </table>
              
              <div class="row">
                <div class="col-lg-8">
                    <div class="tampil-bayar bg-info"></div>
                    <div class="tampil-terbilang"></div>
                </div>
                <div class="col-lg-4">
                  <form action="<?php echo e(route('purchases.store')); ?>" class="form-purchases" method="post">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="purchase_id" id="purchase_id" value="<?php echo e($purchase_id); ?>">
                    <input type="hidden" name="total" id="total">
                    <input type="hidden" name="total_item" id="total_item">
                    <input type="hidden" name="payment" id="payment">

                    <div class="form-group row">
                      <label for="totalrp" class="col-lg-2 control-label">Total</label>
                      <div class="col-lg-8">
                        <input type="text" id="totalrp" class="form-control" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="discount" class="col-lg-2 control-label">Diskon</label>
                      <div class="col-lg-8">
                          <input type="number" name="discount" id="discount" class="form-control" value="0">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="payment" class="col-lg-2 control-label">Bayar</label>
                      <div class="col-lg-8">
                        <input type="text" id="payrp" class="form-control">
                      </div>
                    </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary pull-right btn-simpan"><i class="fa-regular fa-floppy-disk"></i>&nbsp; Simpan Transaksi</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

<?php if ($__env->exists('purchase_detail.product')) echo $__env->make('purchase_detail.product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!-- DataTables  & Plugins -->
<script src="<?php echo e(asset('assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>

<script type="text/javascript">
    let table, table2;

    $(function () {
        table = $('.table-purchase').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '<?php echo e(route('api.purchase_details', $purchase_id)); ?>',
            },
            columns: [
            {data: 'DT_RowIndex', class: 'text-center', orderable: true},
            {data: 'product_code', class: 'text-center'},
            {data: 'name_product', class: 'text-center'},
            {data: 'purchase_price', class: 'text-center'},
            {data: 'amount', class: 'text-center'},
            {data: 'subtotal', class: 'text-center'},
            {data: 'opsi', class: 'text-center', orderable: true},
            ],
            dom: 'Brt',
            bSort: false,
            paginate: false
        })
        .on('draw.dt', function () {
            loadForm($('#discount').val());
        });
        table2 = $('.table-product').DataTable();

        $(document).on('input', '.quantity', function () {
          let id = $(this).data('id');
          // console.log(id)
          let amount = parseInt($(this).val());

          if (amount < 1) {
              $(this).val(1);
              alert('Jumlah tidak boleh kurang dari 1');
              return;
          }
          if (amount > 10000) {
              $(this).val(10000);
              alert('Jumlah tidak boleh lebih dari 10000');
              return;
          }

          $.post(`<?php echo e(url('/purchase_details')); ?>/${id}`, {
              '_token': $('[name=csrf-token]').attr('content'),
              '_method': 'PUT',
              'amount' : amount
            })
            .done(response => {
                $(this).on('mouseout', function () {
                    table.ajax.reload(() => loadForm($('#discount').val()));
                }); 
              })
              .fail(errors => {
                  alert('Tidak dapat menyimpan data');
                  return;
              });      
        });

        $(document).on('input', '#discount', function () {
            if ($(this).val() == "") {
                $(this).val(0).select();
            }

            loadForm($(this).val());
        });

        $('.btn-simpan').on('click', function () {
            $('.form-purchases').submit();
        });
    });
      

    function showProduct() {
      $('#modal-product').modal('show');
    }

    function hideProduct() {
      $('#modal-product').modal('hide');
    }

    function selectProduct(id, code) {
      $('#product_id').val(id);
      $('#product_code').val(code);
      hideProduct();
      addProduct();
    }

    function addProduct() {
        $.post('<?php echo e(route('purchase_details.store')); ?>', $('.form-product').serialize())
            .done(response => {
                $('#product_code').focus();
                  table.ajax.reload(() => loadForm($('#discount').val()));
            })
            .fail(errors => {
                alert('Tidak dapat menyimpan data');
                return;
            });
    }

    function deleteData(url) {
        if (confirm('Yakin ingin menghapus data?')) {
            $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    table.ajax.reload(() => loadForm($('#discount').val()));
                })
                .fail((errors) => {
                    alert('Tidak dapat menghapus data');
                    return;
                });
        }
    }
 
    function loadForm(discount = 0) {
        $('#total').val($('.total').text());
        $('#total_item').val($('.total_item').text());

        $.get(`<?php echo e(url('/purchase_details/loadform')); ?>/${discount}/${$('.total').text()}`)
            .done(response => {
                $('#totalrp').val(response.totalrp);
                $('#payrp').val(response.payrp);
                $('#payment').val(response.payment);
                $('.tampil-bayar').text(response.payrp);
                $('.tampil-terbilang').text('Rp. '+ response.terbilang);
            })
            .fail(errors => {
                alert('Tidak dapat menampilkan data');
                return;
            })
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Eduwork Bootcamp\laravel-vue\laravel-vue\lilyan\Tugas Besar\point-of-sales\resources\views/purchase_detail/index.blade.php ENDPATH**/ ?>