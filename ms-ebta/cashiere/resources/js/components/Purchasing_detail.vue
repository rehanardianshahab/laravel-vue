<script>
import Header from './Header.vue'
import DataTable from './purchasing_detail/DataTable.vue'
  
export default {
  components: {
    Header,
    DataTable
  },
  data() {
    return {
      title: 'Purchase'
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