<template>
    <h2>计算属性</h2>
    <input type="text" v-model.number="count">
    <p>计算:{{double}}</p>    
</template>
<script>
export default {
    data(){
        return {
            count:0
        }
    },
    computed:{
        double(){
            return this.count * 2
        }
    }
}
</script>
