<script>
export default {
  components: {
    // 
  },
  data() {
    return {
      columns: [
              {data: 'DT_RowIndex', searchable: false, sortable: true},
              {data: 'name'},
              {data: 'phone'},
              {data: 'address'},
              {data: 'action', searchable: false, sortable: false}
          ],
      // for api url
      url: import.meta.env.VITE_APP_URL,
      getApi: import.meta.env.VITE_APP_API+'/purchasing',
      id: '',
      product: ''
    }
  },
  methods: {
    datatable() {
      $('#tableSupplier').DataTable({
        ajax: {
          url: this.getApi+'/dataSupplier',
          type: 'GET',
        },//memanggil data dari data api dengan ajax, disimpan di DataTable
        columns: this.columns,
      });
    },
    getProduct() {
      // get data product
      $.get(this.getApi+'/data')
            .done((response) => {
              this.product = response.data;
            })
            .fail((error) => {
                // set alert dan munculkan alert
                $("#notif").attr('class', '');
                $( "#notif" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
                // isi tulisan
                $('#notif .text').html( error.responseJSON.message );
                return;
            });
    },
    selectSupplier(id){
      $.get(this.url+`api/purchasing/${id}/create`)
            .done((response) => {
              console.log(response.success);
              $('#FormModal').modal('hide');
              this.$router.push({name: 'purchasing-detail', params: { id: this.newId }});
            })
            .fail((error) => {
                // set alert dan munculkan alert
                $("#notif").attr('class', '');
                $( "#notif" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
                // isi tulisan
                $('#notif .text').html( error.responseJSON.message );
                return;
            });
    },
  },
  mounted() {
    $.get(this.url+`api/purchasing/data`)
            .done((response) => {
              // console.log(response);
              let jml = response.data;
              if (jml.length == 0) {
                this.id = 0;
              } else {
                this.id = response.data[0].id;
              }
            })
            .fail((error) => {
                // set alert dan munculkan alert
                $("#notif").attr('class', '');
                $( "#notif" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
                // isi tulisan
                $('#notif .text').html( error.responseJSON.message );
                return;
            });
    this.datatable();
    this.getProduct();

    // inisiasi
    let selectSupplier = this.selectSupplier;

    // const self = this === select supplier
    $('tbody', this.$refs.table).on( 'click', '.addSupplier', function(){
        let theid = $(this).attr('data-id');
        selectSupplier(theid);
    });
  }, 
  computed: {
    newId: function () {
      return this.id+1;
    }
  }
}
</script>

<style scoped>

</style>

<template>
<div class="card-body table-responsive">
  <table id="tableSupplier" class="table table-bordered table-striped" width="100%">
    <thead>
      <tr>
        <th width="5%">No</th>
        <th>Name</th>
        <th>No. Phone</th>
        <th>Address</th>
        <th width="15%"><i class="fa fa-cog"></i></th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
</template>