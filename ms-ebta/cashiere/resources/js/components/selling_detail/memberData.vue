<script>
export default {
  components: {
    // 
  },
  data() {
    return {
      columns: [
        {data: 'DT_RowIndex', searchable: false, sortable: true},
        {data: 'code_label'},
        {data: 'name'},
        {data: 'address'},
        {data: 'phone'},
        {data: 'action', searchable: false, sortable: false}
      ],
      // for api url
      url: import.meta.env.VITE_APP_URL,
      getApi: import.meta.env.VITE_APP_API+'/selling-detail',
    }
  },
  methods: {
    datatable() {
      $('#tableMember').DataTable({
        ajax: {
          url: this.url+'api/selling-detail/dataMember',
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
    let getDataMemberAndDiscount = this.$parent.getDataMemberAndDiscount;

    // const self = this === select supplier
    $('tbody', this.$refs.table).on( 'click', '.choseproduct', function(){
        let theid = $(this).attr('data-id');
        console.log(theid);
        // update database
        $.ajax({
          url: url+'api/selling-detail/memberUpdate',
          type: 'POST',
          data: {
            member_id: theid,
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
        });
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
  <div class="card-body table-responsive p-2">
    <table id="tableMember" class="table table-bordered table-striped" width="100%">
      <thead>
        <tr>
          <th width="5%">No</th>
          <th>Code</th>
          <th>Name</th>
          <th>address</th>
          <th>Phone</th>
          <th width="15%"><i class="bi bi-gear-wide-connected"></i></th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</template>