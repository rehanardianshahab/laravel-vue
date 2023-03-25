<script>
export default {
  components: {
    // 
  },
  data() {
    return {
      suppliers: 'halo',
      // for api url
      url: import.meta.env.VITE_APP_URL,
      getApi: import.meta.env.VITE_APP_API+'/purchasing',
    }
  },
  methods: {
    datatable() {
      $('#tableSupplier').DataTable();
    },
    getSupplier() {
      // get data Supplier
      $.get(this.url+"api/purchasing/dataSupplier")
            .done((response) => {
              this.suppliers = response.data;
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
              console.log(response);
              $('#FormModal').modal('hide');
              this.$router.push({name: 'purchasingDetail'});
            })
            .fail((error) => {
                // set alert dan munculkan alert
                $("#notif").attr('class', '');
                $( "#notif" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
                // isi tulisan
                $('#notif .text').html( error.responseJSON.message );
                return;
            });
    }
  },
  mounted() {
    this.datatable();
    this.getSupplier();
  }
}
</script>

<style scoped>

</style>

<template>
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
      <tr v-for="(item, index) in suppliers" :key="item.id">
        <td style="text-align: center" width="15%">{{ index+1 }}</td>
        <td>{{ item.name }}</td>
        <td>{{ item.phone }}</td>
        <td>{{ item.address }}</td>
        <td style="text-align: center" width="15%">
          <button class="btn btn-primary btn-xs btn-flat" @click="selectSupplier(item.id)">
            <i class="fa fa-check-circle"></i> Pilih
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</template>