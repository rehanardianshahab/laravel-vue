<template>
    <div class="container">
        <!-- Alert -->
        <div class="d-none" id="notif-utama" role="alert">
            <span class="text">
                {{ pesanErr }}
            </span>
            <button type="button" class="btn-close" @click="closeNotif()"></button>
          </div>
          <!-- /.alert -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
            
                    <div class="card-body">
                        You are logged in!
                        <div class="input-group">
                            <span class="input-group-text">Set Discount</span>
                            <input type="text" name="discount" id="discount" class="form-control" placeholder="input member" @blur="discount();" :value="setting.discount">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>

                    <div class="card-footer"> 
                        <div class="box-footer">
                            <router-link to="/purchasing" aria-current="page" class="btn btn-primary btn-flat" >Transaksi Pembelian Baru</router-link>
                            <router-link to="/selling" aria-current="page" class="btn btn-warning btn-flat" >Transaksi Penjualan Baru</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                // for api url
                url: import.meta.env.VITE_APP_URL,
                pesanErr: '', 
                setting: ''
            }
        },
        methods: {
            getDataSeting() {
                console.log(this.url+"api/selesai/settingget");
                $.get(this.url+"api/selesai/settingget")
                .done((response) => {
                    this.purchasing = response;
                    this.setting = response;
                })
                .fail((error) => {
                    // set alert dan munculkan alert
                    $("#notif-utama").attr('class', '');
                    $( "#notif-utama" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
                    this.addPesan(error);
                    return;
                });
            },
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
            discount() {
                let addPesan = this.addPesan;
                let discount = $('#discount').val();
                $.ajax({
                    url: this.url+'api/selesai/discount',
                    type: 'PUT',
                    data: {
                        discount: discount,
                    },
                    success: function(response) {
                        this.discount = response.data.discount;
                        // console.log(response);
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
            this.getDataSeting();
        }
    }
</script>