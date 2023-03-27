<script>
import supplierData from './supplierData.vue';
export default {
  components: { supplierData },
  data() {
    return {
      // for datatables
        columns: [
          
        ],
      // for api url
        url: import.meta.env.VITE_APP_URL,
        getApi: import.meta.env.VITE_APP_API+'/purchasing',
      // for post sata
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      // for confirm box
        pesanErr: '',
        confirm: ''
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
              console.log(response.data);
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
    // 
  },
  mounted() {
    //
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
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <span :data-term="confirm" id="confirm" class="btn confirm btn-primary">Yes</span>
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
                <button type="button" class="btn btn-primary xs btn-flat rounded" @click="addTransaction()"><i class="bi bi-patch-plus"></i> Add</button>
              </div>
            </div>
            <!-- /.card-header -->

            <div class="card-body table-responsive">
              <form action="" class="form-product">
                <input type="hidden" name="_token" :value="csrf">
                <table id="table" class="table table-bordered table-striped">
                  <thead>
                    <tr role="row">
                      <th width="5%">No</th>
                      <th>Date</th>
                      <th>Supplier</th>
                      <th>Total Item</th>
                      <th>Total Price</th>
                      <th>Discount</th>
                      <th>Total Payment</th>
                      <th width="15%" class="fs-4"><i class="bi bi-gear-wide-connected"></i></th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </form>
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