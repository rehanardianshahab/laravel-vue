<script>
import Header from './Header.vue'
import DataTable from './selling_detail/DataTable.vue'
  
export default {
  components: {
    Header,
    DataTable
  },
  data() {
    return {
      title: 'Sale'
    }
  }
}
</script>

<style scoped>

</style>

<template>
<div>
  <Header
  	:title="title"
	></Header>
  <DataTable></DataTable>
</div>
</template>