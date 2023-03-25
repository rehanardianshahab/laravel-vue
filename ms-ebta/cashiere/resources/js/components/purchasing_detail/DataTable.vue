<script>
export default {
  data() {
    return {
      // 
    }
  },
  methods: {
    closeNotif() {
        // reset alert
        if ($( "#notif" ).hasClass('d-none')) {

        } else {
            $( "#notif" ).addClass( 'd-none');
        }
        // reset alert
        if ($( "#notif-utama" ).hasClass('d-none')) {

        } else {
            $( "#notif-utama" ).addClass( 'd-none');
        }
    },
    addForm() {
        // 
    },
    datatable() {
      $('#table').DataTable({
        ajax: {
          url: this.getApi,
          type: 'GET',
        },//memanggil data dari data api dengan ajax, disimpan di DataTable
        columns: this.columns,
        dom: 'Bfrtip',
        buttons: [
            'pageLength',
            'colvis',
            'spacer',
            'copyHtml5',
            'pdfHtml5',
            'print',
            'csvHtml5',
            {
              extend: 'excel',
              text: 'exel',
              exportOptions: {
                  modifier: {
                    page: 'current'
                  }
              }
            },
        ]
      });
    },
  },
  mounted() {
    this.datatable();
  }
}
</script>

<template>
  <section class="content">
    <div class="container-fluid pb-5">

      <div class="row">
        <div class="col-md-12">

            <!-- Alert -->
            <div class="d-none" id="notif-utama" role="alert">
                <span class="text"></span>
                <button type="button" class="close">
                    <span onclick="closeNotif()">&times;</span>
                </button>
            </div>
            <!-- /.alert -->
          
          <div class="card">
            <!-- card-header -->
            <div class="card-header with-border">
              <table>
                <tr>
                  <td>Supplier</td>
                  <td>: <span class="bg-warning px-1">nama Supplier</span></td>
                </tr>
                <tr>
                  <td>Telepon</td>
                  <td>: 000898876</td>
                </tr>
                <tr>
                  <td>Address</td>
                  <td>: Jl. Alamat Supplier</td>
                </tr>
              </table>
            </div>
            <!-- /.card-header -->

            <div class="card-body table-responsive">
              <form action="" class="form-product">
                <div class="form-group row">
                  <label for="code">Code Product</label>
                  <div class="col-lg-5">
                    <div class="input-group">
                      <input type="hidden" name="id" id="id-product">
                      <input type="hidden" name="purchasing_id" id="purchasing_id" value="{{ $purchasing_id }}">
                      <input type="text" name="code" id="code-product" class="form-control" placeholder="Add Product Code">
                      <button class="input-group-text btn btn-info btn-flat" type="button" onclick="showProduct()"><i class="bi bi-arrow-bar-right"></i></button>
                    </div>
                  </div>
                </div>
              </form>

                <table id="table" class="table table-bordered table-striped" width="100%">
                    <thead>
                      <tr>
                        <th width="5%">No</th>
                        <th>code</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Total Item</th>
                        <th>Total Price</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
              
                <div class="row mt-4">
                  <div class="col-lg-8">
                    <div class="paying-view bg-primary"></div>
                    <div class="read-view"></div>
                  </div>
                  <div class="col-lg-4">
                    <form action="#" method="post" class="purchasing-form">
                      <input type="hidden" name="id" value="{{ $purchasing_id }}">
                      <input type="hidden" name="total_item" id="total_item">
                      <input type="hidden" name="total_payment" id="total_payment">
  
                      <div class="form-group row">
                        <label for="totalrp" class="col-lg-4 control-label">Total</label>
                        <div class="col-lg-8">
                          <input type="text" name="totalrp" id="totalrp" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="discount" class="col-lg-4 control-label">discount</label>
                        <div class="col-lg-8">
                          <input type="number" min="0" max="100" name="discount" id="discount" class="form-control" value="0">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="bayar" class="col-lg-4 control-label">Total Payment</label>
                        <div class="col-lg-8">
                          <input type="text" name="bayar" id="bayar" class="form-control">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
            <!-- ./card-body -->
            <div class="card-footer">
              <div class="btn btn-primary pull-right btn-save"><i class="fa fa-floppy-o"> Simpan Transaksi</i></div>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </div><!--/. container-fluid -->
  </section>
</template>