<template>
  <button @click="btnClick('Son')">Click</button>
  <h2>Son:{{sonVal}}</h2>
</template>

<script>
export default {
    props:['sonVal'],
    emits:['update:sonVal'],
    methods:{
        btnClick(val){
            this.$emit('update:sonVal',val)
        }
    }
}
</script>

<style>

</style>
