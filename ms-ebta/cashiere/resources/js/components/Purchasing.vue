<script>
import Header from './Header.vue'
import DataTable from './purchasing/DataTable.vue'
  
export default {
  components: {
    Header,
    DataTable
  },
  data() {
    return {
      title: 'purchasing'
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