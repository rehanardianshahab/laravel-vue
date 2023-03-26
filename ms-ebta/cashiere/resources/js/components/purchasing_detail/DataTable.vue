<script>
import ModalData from './ModalData.vue';
export default {
  components: { ModalData },
  data() {
    return {
      columns: [ // for datatable
              {data: 'DT_RowIndex', searchable: false, sortable: true},
              {data: 'code'},
              {data: 'product_name'},
              {data: 'pricing_label'},
              {data: 'item_qty'},
              {data: 'subtotal'},
              {data: 'action', searchable: false, sortable: false}
          ],

      purchasing_id: this.$route.params.id, // data id for current purchasing
      modal: '', // for initialize the modal to used
      detil: '', // data purchasingDetail
      discount: '', // data discount
      purchasing: '', // data purchasing current
      totalItem: '', // data total purchasing item
      totalPrice: '', // for total of price without discount
      totalPriceRp: '', // for total of price without discount with format Rupiah
      payment: '', // for total payment after discount
      total_payment: '', // for total payment after discount with money forma

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
              this.detil = response.data;
              this.getTotal();
            })
            .fail((error) => {
              // set alert dan munculkan alert
              $("#notif-utama").attr('class', '');
                $( "#notif-utama" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
                $( "#notif-utama .text" ).text( error.responseJSON.message);
                return;
            });
    },
    getPurchasing () {
      // get data purchasing current
      // console.log(this.url+"api/purchasing-detail/"+this.$route.params.id+"/dataPurchase");
      // return;
      $.get(this.url+"api/purchasing-detail/"+this.$route.params.id+"/dataPurchase")
            .done((response) => {
              this.purchasing = response;
              this.setDiscount();
            })
            .fail((error) => {
              // set alert dan munculkan alert
              $("#notif-utama").attr('class', '');
                $( "#notif-utama" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
                $( "#notif-utama .text" ).text( error.responseJSON.message);
                return;
            });
    },
    showProduct() {
      // set idModal
      this.modal = true;
      
      $('#ModalData').modal('show');
      $('#ModalData modal-title').text('Add New Product');
    },
    reloadData() {
      this.getDetil();
      this.getPurchasing();
      this.setDiscount();
    },
    getTotal() {
      // console.log(this.detil);
      let detil = this.detil;
      detil.forEach((element, key) => {
        if (detil.length == key+1) {
          this.totalPrice = element.total;
          this.totalPriceRp = element.totalrp;
          this.totalItem = element.qty_total;
        }
      });
      // console.log(this.totalPrice);
    },
    setDiscount () {
      this.discount = this.purchasing.discount;
      const discount = this.discount/100;
      const total = this.totalPrice;
      const calculated_discount = total*discount;

      let total_payment = total - calculated_discount;
      let payment = total - calculated_discount;

      this.total_payment = this.formatMoney(total_payment);
      this.payment = payment;
    },
    formatMoney (angka){
      if (angka != null) {
        // console.log(angka);
          /**
         * Number.prototype.format(n, x, s, c)
         * 
         * @param integer n: length of decimal
         * @param integer x: length of whole part
         * @param mixed   s: sections delimiter
         * @param mixed   c: decimal delimiter
         */
        Number.prototype.format = function(n, x, s, c) {
            var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
                num = this.toFixed(Math.max(0, ~~n));

            return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
        };
        return angka.format(0, 3, '.');       // "12.345.679"

        // 12345678.9.format(2, 3, '.', ',');  // "12.345.678,90"
        // 123456.789.format(4, 4, ' ', ':');  // "12 3456:7890"
        // 12345678.9.format(0, 3, '-');       // "12-345-679"
      }
    },
    saveTransaction () {
      $.ajax({
        url: this.url+'api/purchasing/'+this.purchasing_id,
        type: 'PUT',
        data: {
          _token:$("meta[name='csrf-token']").attr("content"),
          id:this.purchasing_id,
          total_items:this.totalItem,
          total_price:this.totalPrice,
          discount:this.discount,
          total_payment:this.payment,
          active:0
        },
        success: function(response) {
          console.log(response)
        },
        error: function(error) {
          //Do Something to handle error
          // set alert dan munculkan alert
          $("#notif-utama").attr('class', '');
          $( "#notif-utama" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
          $( "#notif-utama .text" ).text( error.responseJSON.message);
          return;
        }
      });
      this.$router.push({name: 'purchasing'});
    }
  },
  mounted() {
    this.reloadData();
    // this.setDiscount();
    // this.getDetil();
    // this.getPurchasing();
    let getApi = this.getApi;
    let saveTransaction = this.saveTransaction;
    let reloadData = this.reloadData;
    let purchasing_id = this.purchasing_id;
    let urlweb = this.url;
    // save new product
    $(document).on('blur', '.edit-qty', function () {
      const id = $(this).attr('data-id');

      let token = $("meta[name='csrf-token']").attr("content");
      let qty = $(this).val();
      $.ajax({
        url: getApi+'/'+id+'/update',
        type: 'POST',
        data: {
          _token:token,
          item_qty:qty
        },
        success: function(response) {
          // console.log(response)
        },
        error: function(error) {
          //Do Something to handle error
          // set alert dan munculkan alert
          $("#notif-utama").attr('class', '');
          $( "#notif-utama" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
          $( "#notif-utama .text" ).text( error.responseJSON.message);
          return;
        }});
        reloadData();
    });
    // set discount
    $(document).on('blur', '#discount', function () {
      let nominal = $(this).val();
      if (nominal == '') {
        nominal = 0;
      } else if (nominal < 0) {
        nominal = 0;
      } else if (nominal > 100) {
        nominal = 100;
      }
      const token = $("meta[name='csrf-token']").attr("content");
      const url = urlweb+"api/purchasing/"+purchasing_id;
      // console.log(url);
      $.ajax({
        url: url,
        type: 'PUT',
        data: {
          _token:token,
          discount:nominal
        },
        success: function(response) {
          // console.log(response)
        },
        error: function(error) {
          //Do Something to handle error
          // set alert dan munculkan alert
          $("#notif-utama").attr('class', '');
          $( "#notif-utama" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
          $( "#notif-utama .text" ).text( error.responseJSON.message);
          return;
        }
      });
        reloadData();
    });
    // delete data
    $(document).on('click', '.delete', function () {
      let idnya = $(this).attr('data-id');
      const token = $("meta[name='csrf-token']").attr("content");
      const url = urlweb+"api/purchasing-detail/"+idnya;
      $.ajax({
        url: url,
        type: 'DELETE',
        data: {
          _token:token,
          id:idnya
        },
        success: function(response) {
          // console.log(response)
        },
        error: function(error) {
          //Do Something to handle error
          // set alert dan munculkan alert
          $("#notif-utama").attr('class', '');
          $( "#notif-utama" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
          $( "#notif-utama .text" ).text( error.responseJSON.message);
          return;
        }
      });
        reloadData();
    });
    // save Transaksi
    $('.btn-save').on('click', function () {
      saveTransaction();
    });
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
    <input type="text" hidden id="data_discount" :value="discount">
    <input type="text" hidden id="data_totalItem" :value="totalItem">
    {{ totalItem }}
    {{ totalPrice }}
    {{ total_payment }}
    {{ payment }}
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
            {{ purchasing_id }}

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
                            <button :data-id="item.id" class="delete btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                </table>
              
                <div class="row mt-4">
                  <div class="col-lg-8">
                    <div class="paying-view bg-primary">Rp {{ total_payment }},-</div>
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
                          <input type="text" name="totalrp" id="totalrp" class="form-control" v-bind:value="totalPriceRp" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="discount" class="col-lg-4 control-label">discount</label>
                        <div class="col-lg-8">
                          <input type="number" min="0" max="100" name="discount" id="discount" class="form-control" :value="discount">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="bayar" class="col-lg-4 control-label">Total Payment</label>
                        <div class="col-lg-8">
                          <input type="text" name="bayar" id="bayar" class="form-control" :value="'Rp '+total_payment+',-'" readonly>
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