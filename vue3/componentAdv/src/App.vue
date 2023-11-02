<template>
    <h1>My:{{color}}</h1>
    <button @click="this.color = 'blue'">toggle Blue</button>
    <hr>
    <component-01></component-01>
</template>

<script>
import Component01 from './components/Component01.vue'
export default {
  name: 'App',
  components: {
    Component01,
  },
    data(){
        return {
            val:'My',
            color:'red'
        }
    },
    provide(){
        return{
            count:1
        }
    },
}
</script>
