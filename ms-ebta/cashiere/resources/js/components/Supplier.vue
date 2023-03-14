<script>
import Header from './Header.vue'
import DataTable from './supplier/DataTable.vue'
  
export default {
  components: {
    // Body, 
    Header,
    DataTable
  },
  data() {
    return {
      title: 'Supplier'
    }
  }
}
</script>

<style scoped>

</style>

<template>
  <Header
  	:title="title"
	></Header>
  <DataTable></DataTable>
</template>