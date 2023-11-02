<template>
    <h1>Axois</h1>
  <div class="box">
      <get-info></get-info>
      <post-info></post-info>
  </div>
</template>

<script>
import GetInfo from './components/GetInfo.vue'
import PostInfo from './components/PostInfo.vue'
export default {
    name : "Axois",
    components : {
        GetInfo,
        PostInfo
    }

}
</script>

<style>

</style>
