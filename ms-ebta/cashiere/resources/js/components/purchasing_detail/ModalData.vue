<script>
export default {
  components: {
    // 
  },
  data() {
    return {
      product: '',
      url: import.meta.env.VITE_APP_URL,
      getApi: import.meta.env.VITE_APP_URL+'api/purchasing-detail',
      columns: [
          {data: 'DT_RowIndex', searchable: false, sortable: true},
          {data: 'code'},
          {data: 'name'},
          {data: 'buy'},
          {data: 'stock'},
          {data: 'action', searchable: false, sortable: false}
        ]
    }
  },
  methods: {
    getProduct() {
      // get data Supplier
      $.get(this.url+"api/product")
            .done((response) => {
              this.product = response.data;
            })
            .fail((error) => {
              console.log(error);
              return;
            });
    },
    datatable() {
      $('#tableDetil').DataTable({
        ajax: {
          url: this.getApi+'/dataProduct',
          type: 'GET',
        },//memanggil data dari data api dengan ajax, disimpan di DataTable
        columns: this.columns,
      });
    },
    choseProduct(id) {
      // console.log(id);
      // hide modal
      $('.modal').modal('hide');
      this.addItem(id);
    },
    addItem(id) {
      $.post(this.getApi+'/'+id+'/'+this.$route.params.id+'/store')
        .done(response => {
          // reload table
          console.log(response);
          // $('#table').DataTable().ajax.reload();
          this.$parent.reloadData()
        })
        .fail(errors => {
          // set alert dan munculkan alert
          $("#notif-utama").attr('class', '');
          $( "#notif-utama" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
          // isi tulisan
          $('#notif-utama .text').html( 'tidak dapat menyimpan data' );
          return;
        });
    },
  },
  mounted() {
    this.getProduct();
    this.datatable();

    // inisiasi
    let choseProduct = this.choseProduct;

    $('tbody', this.$refs.table).on( 'click', '.choseProduct', function(){
        let theid = $(this).attr('data-id');
        choseProduct(theid);
    });
  }, 
  computed: {
    // 
  }
}
</script>

<style scoped>

</style>

<template>
<div>
  <!-- Modal -->
  <!-- Alert -->
  <div class="d-none" id="notif" data-not="1" role="alert">
    <span class="text">
      
    </span>
    <button type="button" class="btn-close" @click="closeNotif()"></button>
  </div>
  <!-- /.alert -->
  <div class="modal-body table-responsive">
    {{ this.$route.params.id }}
    <table id="tableDetil" class="table table-bordered table-striped" width="100%">
      <thead>
        <tr>
          <th width="5%">No</th>
          <th>Code</th>
          <th>Name</th>
          <th>Price</th>
          <th>Stock</th>
          <th width="15%" class="fs-4"><i class="bi bi-gear-wide-connected"></i></th>
        </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
  </div>
</div>
</template>