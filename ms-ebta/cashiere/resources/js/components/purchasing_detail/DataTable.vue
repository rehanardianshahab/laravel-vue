<script>
import ModalData from './ModalData.vue';
export default {
  components: { ModalData },
  data() {
    return {
      columns: [
              {data: 'DT_RowIndex', searchable: false, sortable: true},
              {data: 'code'},
              {data: 'product_name'},
              {data: 'pricing_label'},
              {data: 'item_qty'},
              {data: 'subtotal'},
              {data: 'action', searchable: false, sortable: false}
          ],
      purchasing_id:'',
      // for api url
      url: import.meta.env.VITE_APP_URL,
      getApi: import.meta.env.VITE_APP_API+'/purchasing-detail',
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
    showProduct() {
        // 
    },
    datatable() {
      $('#table').DataTable({
        ajax: {
          url: this.getApi+`/${this.$route.params.id}`
        },
        columns: this.columns,
        dom: 'Brt',
        bSort: false,
      }).on('draw.dt', function () {
        // loadForm($('#discount').val());
      });
    },
  },
  mounted() {
    // this.datatable();
  }
}
</script>

<style scoped>
    .paying-view {
      font-size: 5em;
      text-align: center;
      height: 100px;
    }
    .read-view {
      padding: 10px;
      background: #f0f0f0;
    }
    @media(max-width: 768px) {
      .paying-view {
        font-size: 3em;
        height: 70px;
        padding-top: 5px;
      }
    }
    #table tbody tr:last-child {
      display: none;
    }
</style>

<template>
  <section class="content">
    <!-- modal box for form -->
    <div class="modal fade" id="ModalData" tabindex="-1" aria-labelledby="ModalDataLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalDataLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Alert -->
          <div class="d-none" id="notif" data-not="1" role="alert">
            <span class="text">
              <span v-for="(value, key) in pesanErr" class="d-block" :key="key">
                  {{ value[0] }}
              </span>
            </span>
            <button type="button" class="btn-close" @click="closeNotif()"></button>
          </div>
          <!-- /.alert -->
          <div class="modal-body">
            <supplierData></supplierData>
          </div>
          <!-- /.modal-body -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Cancel</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal box for form -->
    {{ this.$route.params.id }}
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
                      <input type="text" name="code" id="code-product" class="form-control" placeholder="Add Product Code" @click="showProduct()">
                      <button class="input-group-text btn btn-info btn-flat" type="button" @click="showProduct()"><i class="bi bi-arrow-bar-right"></i></button>
                    </div>
                  </div>
                </div>
              </form>
              <br />
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