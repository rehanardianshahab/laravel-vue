<script>
export default {
  props: ['title']
}
</script>

<style scoped>
  /*  */
</style>

<template>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-9">
          <h1 class="d-inline-block me-0">{{ title }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-3 d-flex flex-row-reverse">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><router-link to="/dashboard">Home</router-link></li>
            <li class="breadcrumb-item active">{{ title }}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
</template>