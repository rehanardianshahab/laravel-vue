<script>
import Header from './Header.vue'
import DataTable from './product/DataTable.vue'
  
export default {
  components: {
    Header,
    DataTable
  },
  data() {
    return {
      title: 'Product'
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