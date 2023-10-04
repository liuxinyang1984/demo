<template>
    <h3>Counter组件</h3>
    <hr>
    MyCount:{{count}}
    <br>
    <button @click="onBtnClick">+1</button>
</template>
<script>
export default {
    name:"MyCount",
    data(){
        return{
            count:0,
        }
    },
    emits:['countChange'],
    methods:{
        onBtnClick(){
            this.count ++
            this.$emit('countChange',this.count)
        }
    }
}
</script>
