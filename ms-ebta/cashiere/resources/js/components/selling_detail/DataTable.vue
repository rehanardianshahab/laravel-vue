<script>
import productData from './productData.vue';
import memberData from './memberData.vue';
export default {
  components: { productData, memberData },
  data() {
    return {
      // for datatables
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: true},
            {data: 'code'},
            {data: 'product_name'},
            {data: 'selling_price'},
            {data: 'item_qty'},
            {data: 'discount'},
            {data: 'subtotal'},
            {data: 'action', searchable: false, sortable: false}
        ],
      // for api url
        url: import.meta.env.VITE_APP_URL,
        getApi: import.meta.env.VITE_APP_API+'/selling-detail',
      // for post sata
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      // for confirm box
        selling_id: this.$route.params.id, // id of current selling transaction
        product: '', // collection of data product
        pesanErr: '', // to showing error in modal
        salesData: '', // data of current ransaction
        member_code: null, // data code of member
        member_id: null, // data code of member
        discount: 0, // discount of transaction
        costumer_money: 0, // money costumer
        key: 0,
        totalItem: 0, // total of item
        totalPrice: 0, // total of price without discount form store
        stock: 0
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
    showProduct () {
      $('#ModalData').modal('show');
      $('#ModalDataLabel').text('Add New Product');
      this.key = 2;
      this.modal = true;
    },
    showMember () {
      $('#ModalData').modal('show');
      $('#ModalDataLabel').text('Add Member');
      this.key = 3;
      this.notif = false;
    },
    addPesan(error) {
      // isi tulisan
      let pesan = '';
      let pesanErr = '';
      if (error.responseJSON.message) {
        pesan = error.responseJSON.message;
        this.pesanErr = pesan;
      } else {
          pesan = Object.entries(error.responseJSON);
          pesan.forEach(element => {
          this.pesanErr = pesanErr+element[1]+'<br>';
        });
      }   
      return;
    },
    datatable() {
      $('#table').DataTable({
        ajax: {
          url: this.getApi+'/'+this.selling_id,
          type: 'GET',
        },//memanggil data dari data api dengan ajax, disimpan di DataTable
        columns: this.columns,
      });
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
      }
    },
    settotalPriceAndItem(params) {
      let sellingDetail_data = params;
      let subtotal = 0;
      let totalItem = 0;
      if (params.length == 0) {
        totalItem = 0;
        subtotal = 0;
      } else {
        subtotal;
        sellingDetail_data.forEach(element => {
          const price = element.sellingPrice;
          const qty = element.Qty;
          const discount = element.Discount;
          const total = price*qty;
          const disc = total*(discount/100);
          const totalPrice = total-disc;
          subtotal += totalPrice;
          totalItem+= qty;
        });
      }
      this.totalPrice = subtotal;
      this.totalItem = totalItem;
    },
    setDataSales(params) {
      this.salesData = params;
    },
    getData () {
      // get data sellding detail
      let getApi = this.getApi;
      let selling_id = this.selling_id;
      let addPesan = this.addPesan;
      let settotalPriceAndItem = this.settotalPriceAndItem;
      $.ajax({
          url: getApi+'/'+selling_id,
          type: 'GET',
          data: {
            selling_id:selling_id,
          },
          success: function(response) {
            // console.log(response.data);
            settotalPriceAndItem(response.data);
          },
          error: function(error) {
            // set alert dan munculkan alert
            $("#notif-utama").attr('class', '');
            $( "#notif-utama" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
            
            addPesan(error);
            return;
          }
        });
    },
    setDataMemberAndDiscount(data) {
      this.discount = data.discount;
      this.member_code = data.member_code;
      this.member_id = data.member_id;
    },
    getDataMemberAndDiscount () {
      // get data sellding detail
      let getApi = this.getApi;
      let selling_id = this.selling_id;
      let addPesan = this.addPesan;
      let setDataMemberAndDiscount = this.setDataMemberAndDiscount;
      $.ajax({
          url: getApi+'/'+selling_id+'/show',
          type: 'GET',
          success: function(response) {
            console.log(response);
            setDataMemberAndDiscount(response.data);
          },
          error: function(error) {
            // set alert dan munculkan alert
            $("#notif-utama").attr('class', '');
            $( "#notif-utama" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
            
            addPesan(error);
            return;
          }
        });
    },
    resetMember () {
      let key = $('#reset').attr('data-id');
      let url = this.url;
      let selling_id = this.selling_id;
      let getDataMemberAndDiscount = this.getDataMemberAndDiscount;
      let addPesan = this.addPesan;
      $.ajax({
          url: url+'api/selling-detail/memberUpdate',
          type: 'POST',
          data: {
            id: key,
            selling_id:selling_id,
          },
          success: function(response) {
            $('#ModalData').modal('hide');
            $('#table').DataTable().ajax.reload();
            console.log(response)
            getDataMemberAndDiscount();
          },
          error: function(error) {
            // set alert dan munculkan alert
            $("#notif-utama").attr('class', '');
            $( "#notif-utama" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
            $('#ModalData').modal('hide');
            
            addPesan(error);
            return;
          }
        })
    },
    redirect(id) {
      this.$router.push({name: 'selesai', params: { id: id }});
    },
    saveData() {
      let addPesan = this.addPesan;
      let redirect = this.redirect;
      if (this.totalItem < 1) {
        $('#ModalData').modal('show');
        $('#ModalDataLabel').text('Peringatan');
        this.key = 5;
      } else {    
        if (this.costumer_money < this.payment_total) {
          this.key = 1;
          // set alert dan munculkan alert
          $('#ModalData').modal('show');
          $('#ModalDataLabel').text("Sorry");
          return;
        } else {
          let selling_id = this.selling_id;
          let memberid = this.member_id;
          let itemqty = this.totalItem;
          let totalPrice = this.totalPrice;
          let disc = this.discount;
          let url = this.url;
          let payment_total = this.payment_total;
          let addPesan = this.addPesan;
          let costumermoney = this.costumer_money;
          $.ajax({
            url: url+'api/selling/'+selling_id+'/save',
            type: 'PUT',
            data: {
              id: selling_id,
              member_id: memberid,
              total_item: itemqty,
              discount: disc,
              pricing_total: totalPrice,
              subtotal_prices: payment_total,
              customer_money: costumermoney,
              active: 0
            },
            success: function(response) {
              console.log(response);
              redirect(selling_id);
              // getData();
              // $('#table').DataTable().ajax.reload();
            },
            error: function(error) {
              // set alert dan munculkan alert
              $("#notif-utama").attr('class', '');
              $( "#notif-utama" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
                
              addPesan(error);
              return;
            }
          });
        }
      }
    },
    warning(key, stock) {
      $('#ModalData').modal('show');
      $('#ModalDataLabel').text('Peringatan');
      this.key = key;
      this.stock = stock;
    },
    deleteData (id) {
      let addPesan = this.addPesan;
      let getData = this.getData;
      $.ajax({
          url: this.getApi+'/'+id,
          type: 'DELETE',
          // data: {
          //   selling_id:selling_id,
          // },
          success: function(response) {
            $('#table').DataTable().ajax.reload();
            getData();
          },
          error: function(error) {
            // set alert dan munculkan alert
            $("#notif-utama").attr('class', ''); 
            $( "#notif-utama" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
            
            addPesan(error);
            return;
          }
      });
    }
  },
  mounted() {
    this.getDataMemberAndDiscount();
    this.datatable();
    this.getData();

    // inisiasi
    let url = this.url;
    let addPesan = this.addPesan;
    let getData = this.getData;
    let selling_id = this.selling_id;
    let warning = this.warning;
    let deleteData = this.deleteData;

    $('tbody', this.$refs.table).on( 'blur', '.edit-qty', function(){
        let theid = $(this).attr('data-id');
        let thestock = $(this).attr('data-stock');
        let discounted = $(this).attr('data-discount');
        let value = $(this).val();


        if (value == '') {
          value = 1;
        } else if (value == 0) {
          value = 1;
        } else if (parseInt(value) > parseInt(thestock)) {
          warning (4, thestock);
          value = thestock;
          console.log(value);
        }

          // update database
          $.ajax({
            url: url+'api/selling-detail/'+theid,
            type: 'PUT',
            data: {
              id: theid,
              qty:value,
              discount: discounted,
              subtotal_prices:0
            },
            success: function(response) {
              getData();
              $('#table').DataTable().ajax.reload();
            },
            error: function(error) {
              // set alert dan munculkan alert
              $("#notif-utama").attr('class', '');
              $( "#notif-utama" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
              
              addPesan(error);
              return;
            }
          });
    });
    $('tbody', this.$refs.table).on( 'click', '.delete', function(){
        let theid = $(this).attr('data-id');
        deleteData(theid)
    })
  },
  computed: {
    payment_total: function () {
      let discounted = this.totalPrice-((this.discount/100)*this.totalPrice);
      return discounted;
    },
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
</style>

<template>
  <section class="content">
    <!-- ================== modal box for form ====================== -->
    <div class="modal fade" id="ModalData" tabindex="-1" aria-labelledby="ModalDataLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalDataLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div v-if="key == 1" class="modal-body">
            <div id="text-modal">Maaf Uang Pembayaran Masih Kurang</div>
          </div>
          <div v-else-if="key == 2" class="modal-body">
              <productData></productData>
          </div>
          <div v-else-if="key == 3" class="modal-body">
            <memberData></memberData>
          </div>
          <div v-else-if="key == 4" class="modal-body">
            <div id="text-modal">Stok Barang ini hanya tinggal {{ stock }}.</div>
          </div>
          <div v-else-if="key == 5" class="modal-body">
            <div id="text-modal">Tidak ada barang yang dipilih. silahkan hapus transaksi ini.</div>
          </div>
          <!-- /.modal-body -->
          <div class="modal-footer">
            <button type="button" data-id="" id="reset" class="btn btn-primary" @click="resetMember()" v-if="key == 3">Reset</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Cancel</button>
          </div>
        </div>
      </div>
    </div>
    <!-- ==================== /.modal box for form ================ -->
    <div class="container-fluid pb-5">

      <div class="row">
        <div class="col-md-12">

            <!-- =====================Alert======================== -->
            <div class="d-none" id="notif-utama" role="alert">
              <span class="text">
                {{ pesanErr }}
              </span>
              <button type="button" class="btn-close" @click="closeNotif()"></button>
            </div>
            <!-- ===================/.alert======================== -->
          
          <div class="card">
            <!-- card-header -->
            <div class="card-header with-border">
            </div>
            <!-- /.card-header -->

            <div class="card-body table-responsive">
              <form action="" class="form-product">
                <div class="form-group row">
                  <label for="code">Code Product</label>
                  <div class="col-lg-5">
                    <div class="input-group">
                      <input type="text" name="code" id="code-product" class="form-control" placeholder="Add Product Code" @click="showProduct();">
                      <button class="input-group-text btn btn-info btn-flat" type="button" @click="showProduct();"><i class="bi bi-arrow-bar-right"></i></button>
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
                        <th>Discount</th>
                        <th>Total Price</th>
                        <th width="15%" class="fs-4"><i class="bi bi-gear-wide-connected"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                      <!--  -->
                    </tbody>
                </table>
              
                <div class="row mt-4">
                  <div class="col-lg-8">
                    <div class="read-view fs-5" v-if="payment_total-costumer_money == payment_total">Harga Belanja :</div>
                    <div class="read-view fs-5" v-else-if="payment_total-costumer_money < 0">Kembalian :</div>
                    <div class="read-view fs-5" v-else-if="payment_total-costumer_money < payment_total">Pembayaran Kurang :</div>
                    <div class="paying-view bg-primary" v-if="payment_total-costumer_money < 0">Rp {{ formatMoney(-(payment_total-costumer_money)) }},-</div>
                    <div class="paying-view bg-primary" v-else>Rp {{ formatMoney((payment_total-costumer_money)) }},-</div>
                    <div class="read-view"></div>
                  </div>
                  <div class="col-lg-4">
                      <div class="form-group row">
                        <label for="totalrp" class="col-lg-4 control-label">Total</label>
                        <div class="col-lg-8">
                          <input type="text" name="totalrp" id="totalrp" class="form-control" :value="'Rp '+formatMoney(totalPrice)+',-'" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="member" class="col-lg-4 control-label">Member</label>
                        <div class="col-lg-8">
                          <div class="input-group">
                            <input type="text" name="member" id="member" class="form-control" placeholder="input member" @click="showMember();" :value="member_code">
                            <button class="input-group-text btn btn-info btn-flat" type="button" @click="showMember();"><i class="bi bi-arrow-bar-right"></i></button>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="discount" class="col-lg-4 control-label">discount</label>
                        <div class="col-lg-8">
                          <div class="input-group">
                            <input type="number" min="0" max="100" name="discount" id="discount" class="form-control" :value="discount" readonly>
                            <span class="input-group-text">%</span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="bayar" class="col-lg-4 control-label">Total Payment</label>
                        <div class="col-lg-8">
                          <input type="text" name="bayar" id="bayar" class="form-control" :value="'Rp '+formatMoney(payment_total)+',-'" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="costumer_money" class="col-lg-4 control-label">Costumer Money</label>
                        <div class="col-lg-8">
                          <input type="text" name="costumer_money" id="costumer_money" v-model="costumer_money" class="form-control">
                        </div>
                      </div>
                  </div>
                </div>
            </div>
            <!-- ./card-body -->
            <div class="card-footer">
              <div class="btn btn-primary pull-right btn-save" @click="saveData()"><i class="fa fa-floppy-o"> Simpan Transaksi</i></div>
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