<script>
export default {
  components: {
    // 
  },
  data() {
    return {
      columns: [
              {data: 'DT_RowIndex', searchable: false, sortable: true},
              {data: 'code'},
              {data: 'name'},
              {data: 'brand'},
              {data: 'sale'},
              {data: 'stock'},
              {data: 'action', searchable: false, sortable: false}
          ],
      // for api url
      url: import.meta.env.VITE_APP_URL,
      getApi: import.meta.env.VITE_APP_API+'/selling-detail',
    }
  },
  methods: {
    datatable() {
      $('#tableProduct').DataTable({
        ajax: {
          url: this.url+'api/selling-detail/dataProduct',
          type: 'GET',
        },//memanggil data dari data api dengan ajax, disimpan di DataTable
        columns: this.columns,
      });
    },
  },
  mounted() {
    this.datatable();
    // console.log(this.$parent);
    let addPesan = this.$parent.addPesan;
    let url = this.url;
    let selling_id = this.$parent.selling_id;
    let getData = this.$parent.getData;

    // const self = this === select supplier
    $('tbody', this.$refs.table).on( 'click', '.choseProduct', function(){
        let theid = $(this).attr('data-id');

        // update database
        $.ajax({
          url: url+'api/selling-detail/store',
          type: 'POST',
          data: {
            id: theid,
            selling_id:selling_id,
          },
          success: function(response) {
            $('#ModalData').modal('hide');
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
    });
  }, 
  computed: {
    // newId: function () {
    //   return this.id+1;
    // }
  }
}
</script>

<style scoped>
</style>

<template>
  <div class="card-body table-responsive">
    <table id="tableProduct" class="table table-bordered table-striped" width="100%">
      <thead>
        <tr>
          <th width="5%">No</th>
          <th>Code</th>
          <th>Name</th>
          <th>Brand</th>
          <th>Price</th>
          <th>Stock</th>
          <th width="15%"><i class="bi bi-gear-wide-connected"></i></th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</template>