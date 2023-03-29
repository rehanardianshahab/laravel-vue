<script>
import supplierData from './supplierData.vue';
export default {
  components: { supplierData },
  data() {
    return {
      // for datatables
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: true},
            {data: 'date'},
            {data: 'member_code'},
            {data: 'total_item'},
            {data: 'pricing_total'},
            {data: 'discount'},
            {data: 'subtotal_prices'},
            {data: 'customer_money'},
            {data: 'action', searchable: false, sortable: false}
        ],
      // for api url
        url: import.meta.env.VITE_APP_URL,
        getApi: import.meta.env.VITE_APP_API+'/selling',
      // for post sata
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      // for confirm box
        pesanErr: '',
        confirm: '',
        activated: false,
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
    addTransaction() {
      $.post(this.url+`api/selling/new`)
            .done((response) => {
              // console.log(response.data);
              // $('#FormModal').modal('hide');
              this.$router.push({name: 'selling-detail', params: { id: response.data.id }});
            })
            .fail((error) => {
              // console.log(error);
                // set alert dan munculkan alert
                $("#notif-utama").attr('class', '');
                $( "#notif-utama" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
                
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
                // end pesan error
                return;
            });
    },
    blockTransaction() {
      $('#modalConfirm').modal('show');
      $('#modalConfirmLabel').text('Sorry');
    },
    notAllowed() {
      $('#modalConfirm').modal('show');
      $('#modalConfirmLabel').text('Sorry');
      this.activated = false;
    },
    datatable() {
      $('#table').DataTable({
        ajax: {
          url: this.getApi+'/datatable',
          type: 'GET',
        },//memanggil data dari data api dengan ajax, disimpan di DataTable
        columns: this.columns,
      });
    },
    checked(params) {
      this.activated = params;
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
    getDataSale() {
        let checked = this.checked;
        let addPesan = this.addPesan;
        $.ajax({
          url: this.getApi+'/datatable',
          type: 'GET',
          success: function(response) {
            let active = response.data.filter(( {active} ) => [1].includes(active));
            if (active.length > 0) {
              checked(true);
            }
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
    deleteData(id) {
        let checked = this.checked;
        $.ajax({
          url: this.getApi+'/'+id,
          type: 'Delete',
          success: function(response) {
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
    },
    redirect(id, name) {
      this.$router.push({name:name, params: { id:id }});
    },
  },
  mounted() {
    this.datatable();
    this.getDataSale();
    let redirect = this.redirect;
    let notAllowed = this.notAllowed;
    let deleteData = this.deleteData;

    // const self = this === select finish
    $('tbody', this.$refs.table).on( 'click', '.finishData', function(){
        let theid = $(this).attr('data-idfinish');
        redirect(theid, 'selling-detail');
    });
    // const self = this === select see
    $('tbody', this.$refs.table).on( 'click', '.see', function(){
        let theid = $(this).attr('data-idsee');
        redirect(theid, 'selesai');
    });
    // const self = this === select delete
    $('tbody', this.$refs.table).on( 'click', '.deleteData', function(){
        let theid = $(this).attr('data-iddelete');
        let total = $(this).attr('data-total');
        console.log(total);
        if (parseInt(total) > 0) {
          notAllowed();
        } else {
          deleteData(theid);
        }
    });
  }
}
</script>

<template>
  <section class="content">
    <!-- confirm box -->
    <!-- modal box for delete form -->
    <div class="modal fade" id="modalConfirm" tabindex="-1" aria-labelledby="modalConfirmLabel" aria-hidden="true">
      <div class="modal-dialog  modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fs-5" id="modalConfirmLabel">Konfirmasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" v-if="activated">
            Ada Transaksi yang Masih Aktif. Tolong Selesaikan Transaksi Tersebut Lebih Dahulu
            Baru Membuat Transaksi Baru.
          </div>
          <div class="modal-body" v-else>
            Ada beberapa produk yang sudah dipilih di dalam transaksi ini. Mohon hapus
            terlebih dahulu sebelum menghapus transaksi ini.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <!-- <span :data-term="confirm" id="confirm" class="btn confirm btn-primary" v-if="!activated">Yes</span> -->
          </div>
        </div>
      </div>
    </div>

    <!-- main page -->
    <div class="container-fluid pb-5">

      <div class="row">
        <div class="col-md-12">

            <!-- Alert -->
            <div class="d-none" id="notif-utama" role="alert">
              <span class="text">
                {{ pesanErr }}
              </span>
              <button type="button" class="btn-close" @click="closeNotif()"></button>
            </div>
            <!-- /.alert -->

          <div class="card">
            <!-- card-header -->
            <div class="card-header">
              <div class="btn-group">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary xs btn-flat rounded" v-if="!activated" @click="addTransaction()"><i class="bi bi-patch-plus"></i> Add</button>
                <button type="button" class="btn btn-primary xs btn-flat rounded" v-else @click="blockTransaction()"><i class="bi bi-patch-plus"></i> Add</button>
              </div>
            </div>
            <!-- /.card-header -->

            <div class="card-body table-responsive">
                <input type="hidden" name="_token" :value="csrf">
                <table id="table" class="table table-bordered table-striped"  style="text-align: center;">
                  <thead>
                    <tr role="row">
                      <th width="5%">No</th>
                      <th>Date</th>
                      <th>Member</th>
                      <th>Total Item</th>
                      <th>Total Price</th>
                      <th>Discount</th>
                      <th>Total Payment</th>
                      <th>Customer Money</th>
                      <th width="15%" class="fs-4"><i class="bi bi-gear-wide-connected"></i></th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
            </div>
            <!-- ./card-body -->
            <div class="card-footer">
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