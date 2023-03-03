<script>
// import Body from './category/Body.vue'
import Header from './category/Header.vue'
import DataTable from './category/DataTable.vue'
  
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

<style scoped>

</style>

<template>
  <Header
  	:title="title"
	></Header>
	<!-- <Body
  	v-for="post in posts"
	  :key="post.id"
  	:text="post.text"
	></Body> -->
  <DataTable></DataTable>
</template>