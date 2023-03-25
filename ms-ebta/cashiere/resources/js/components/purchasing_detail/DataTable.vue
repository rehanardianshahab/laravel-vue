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
      modal: '',
      pesanErr: '',
      detil: '',
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
    getDetil() {
      // get data purchasing detail
      $.get(this.url+"api/purchasing-detail/"+this.$route.params.id+"/data")
            .done((response) => {
              console.log(response.data);
              this.detil = response.data;
            })
            .fail((error) => {
              // set alert dan munculkan alert
              $("#notif-utama").attr('class', '');
                $( "#notif-utama" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
                $( "#notif-utama .text" ).text( error.responseJSON.message);
                // membuat pesan error
                this.pesanErr = error.responseJSON;
                return;
            });
    },
    showProduct() {
      // set idModal
      this.modal = true;
      
      $('#ModalData').modal('show');
      $('#ModalData modal-title').text('Add New Product');
    },
  },
  mounted() {
    this.getDetil();
  }, 
  computed: {
    //
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
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalDataLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div v-if="modal">
            <ModalData></ModalData>
          </div>
          <div v-else>
            kosong
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
    <div class="container-fluid pb-5">

      <div class="row">
        <div class="col-md-12">

            <!-- Alert -->
            <div class="d-none" id="notif-utama" role="alert">
                <span class="text"></span>
              <button type="button" class="btn-close" @click="closeNotif()"></button>
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
                        <th width="15%" class="fs-4"><i class="bi bi-gear-wide-connected"></i></th>

                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, key) in detil" :key="key">
                        <td style="text-align: center;">{{ item.DT_RowIndex }}</td>
                        <td style="text-align: center;"><span class="badge text-bg-success">{{ item.code }}</span></td>
                        <td>{{ item.product_name }}</td>
                        <td>{{ item.pricing_label }}</td>
                        <td><input type="number" min="1" :name="item.input_name" :data-id="item.id" class="form-control input-sm edit-qty" v-bind:value="item.item_qty"></td>
                        <td>{{ item.subtotal }}</td>
                        <td>
                          <div class="btn-group d-flex justify-content-around rounded" role="group" aria-label="Basic example">
                            <button class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>
                          </div>
                        </td>
                      </tr>
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