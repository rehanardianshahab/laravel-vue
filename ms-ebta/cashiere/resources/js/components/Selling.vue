<script>
import Header from './Header.vue'
import DataTable from './selling/DataTable.vue'
  
export default {
  components: {
    Header,
    DataTable
  },
  data() {
    return {
      title: 'selling'
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