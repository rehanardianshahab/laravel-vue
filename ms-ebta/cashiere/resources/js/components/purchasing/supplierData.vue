<script>
export default {
  components: {
    // 
  },
  data() {
    return {
      supplier: ''
    }
  },
  methods: {
    datatable() {
      $('#tableSupplier').DataTable();
    }
  },
  mounted() {
    this.datatable();
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
            <!-- @foreach ($supplier as $key => $item)
            <tr>
              <td style="text-align: center" width="15%">{{ $key+1 }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->phone }}</td>
              <td>{{ $item->address }}</td>
              <td style="text-align: center" width="15%">
                <a href="{{ route('purchase.create', $item->id) }}" class="btn btn-primary btn-xs btn-flat">
                  <i class="fa fa-check-circle"></i> Pilih
                </a>
              </td>
            </tr>
                @endforeach -->
    </tbody>
  </table>
</template>