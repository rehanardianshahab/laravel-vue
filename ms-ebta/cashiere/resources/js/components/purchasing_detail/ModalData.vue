<script>
export default {
  components: {
    // 
  },
  data() {
    return {
      
    }
  },
  methods: {
    // datatable() {
    //   $('#tableSupplier').DataTable();
    // },
    // getSupplier() {
    //   // get data Supplier
    //   $.get(this.url+"api/purchasing/dataSupplier")
    //         .done((response) => {
    //           this.suppliers = response.data;
    //         })
    //         .fail((error) => {
    //             // set alert dan munculkan alert
    //             $("#notif").attr('class', '');
    //             $( "#notif" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
    //             // isi tulisan
    //             $('#notif .text').html( error.responseJSON.message );
    //             return;
    //         });
    // },
    // selectSupplier(id){
    //   $.get(this.url+`api/purchasing/${id}/create`)
    //         .done((response) => {
    //           console.log(response.success);
    //           $('#FormModal').modal('hide');
    //           this.$router.push({name: 'purchasing-detail', params: { id: this.newId }});
    //         })
    //         .fail((error) => {
    //             // set alert dan munculkan alert
    //             $("#notif").attr('class', '');
    //             $( "#notif" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
    //             // isi tulisan
    //             $('#notif .text').html( error.responseJSON.message );
    //             return;
    //         });
    // },
  },
  mounted() {
    // $.get(this.url+`api/purchasing/data`)
    //         .done((response) => {
    //           this.id = response.data[0].id;
    //         })
    //         .fail((error) => {
    //             // set alert dan munculkan alert
    //             $("#notif").attr('class', '');
    //             $( "#notif" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
    //             // isi tulisan
    //             $('#notif .text').html( error.responseJSON.message );
    //             return;
    //         });
    // this.datatable();
    // this.getSupplier();
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
  <!-- Modal -->
        <div class="modal-body table-responsive">
          <table id="tableDetil" class="table table-bordered table-striped" width="100%">
            <thead>
              <tr>
                <th width="5%">No</th>
                <th>Code</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
</template>