<script>
import Header from './Header.vue'

export default {
  components: {
    Header,
  },
  data() {
    return {
      title: 'Print Transaction',
      url: import.meta.env.VITE_APP_URL,
      getApi: import.meta.env.VITE_APP_API+'/selling',
      id: this.$route.params.id,
      activated: false
    }
  },
  methods: {
    popupCenter(url, title, w, h) {
        const dualScreenLeft = window.screenLeft !==  undefined ? window.screenLeft : window.screenX;
        const dualScreenTop  = window.screenTop  !==  undefined ? window.screenTop  : window.screenY;

        const width  = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        const systemZoom = width / window.screen.availWidth;
        const left       = (width - w) / 2 / systemZoom + dualScreenLeft
        const top        = (height - h) / 2 / systemZoom + dualScreenTop
        const newWindow  = window.open(url, title, 
        `
            scrollbars=yes,
            width  = ${w / systemZoom}, 
            height = ${h / systemZoom}, 
            top    = ${top}, 
            left   = ${left}
        `
        );

        if (window.focus) newWindow.focus();
    },
    PrintnotaKecil(url, title) {
      this.popupCenter(url, title, 625, 500);
      return;
    },
    blockTransaction() {
      $('#modalConfirm').modal('show');
      $('#modalConfirmLabel').text('Sorry');
    },
    checked(params) {
      this.activated = params;
    },
    getDataSale() {
        let checked = this.checked;
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
  },
  mounted() {
    this.getDataSale();
    document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  }
}
</script>

<template>
<div>
  <Header
  	:title="title"
	></Header>
  
  <div class="container-fluid pb-5">

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
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <span class="btn confirm btn-primary" v-if="!activated">Yes</span>
          </div>
        </div>
      </div>
    </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header"> 
        </div>
        <!-- ./card-header -->

        <div class="card-body">
            <div class="box">
                <div class="box-body">
                    <div class="alert alert-success alert-dismissible">
                        <i class="fa fa-check icon"></i>
                        Data Transaksi telah selesai.
                    </div>
                </div>
            </div>
        </div>
        <!-- ./card-body -->

        <div class="card-footer"> 
            <div class="box-footer">
                <button class="btn btn-warning btn-flat print" @click="PrintnotaKecil(getApi+'/nota-kecil/'+id, 'Nota Kecil')">Cetak Nota</button>
                <a class="btn btn-primary btn-flat" v-if="!activated" @click="addTransaction()">Transaksi Baru</a>
                <a class="btn btn-primary btn-flat"  v-else @click="blockTransaction()">Transaksi Baru</a>
                <router-link to="/selling" class="btn btn-success btn-flat" aria-current="page">Kembali</router-link>
            </div>
        </div>
        <!-- /.card-footer -->
      </div>
    </div>
  </div>
</div>

</div>
</template>