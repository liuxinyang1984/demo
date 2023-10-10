<template>
    <div class="com1">
        <h3>01:{{count}}</h3>
    </div>
    <component-02></component-02>
    <hr>
</template>

<script>
import Component02 from './Component02.vue'
export default {
  components: { Component02 },
    name:"component01",
    inject:['count'],
    data(){
        return{
        }
    },
}
</script>

<style>

</style>
