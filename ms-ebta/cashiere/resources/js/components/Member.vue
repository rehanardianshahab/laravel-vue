<template>
      <Header
  	:title="title"
	></Header>
    <DataTable></DataTable>
</template>

<script>
import Header from './Header.vue'
import DataTable from './member/DataTable.vue'
  
export default {
  components: {
    // Body, 
    Header,
    DataTable
  },
  data() {
    return {
      // posts: [
      //   { id: 1, text: 'My journey with Vue' },
      //   { id: 2, text: 'Blogging with Vue' },
      //   { id: 3, text: 'Why Vue is so fun' }
      // ], 
      title: 'Category'
    }
  }
}
</script>