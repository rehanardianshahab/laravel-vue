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
  <Header
  	:title="title"
	></Header>
  {{ this.$route.params.id }}
  <DataTable></DataTable>
</template>