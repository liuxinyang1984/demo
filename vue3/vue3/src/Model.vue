<template>
    <my-header title="v-model" bgcolor="blue" text_color="white"></my-header>
    <h1>Count:{{count}}</h1>
    <button @click="add">count ++</button>
    <hr>
    <my-count v-model:count="count" @tt="tt"> </my-count>

</template>

<script>
export default {
    name:"v-model_root",
    data:function data(){
        return {
            count:99
        }
    },
    methods:{
        add(){
            this.count ++
        },
        tt(val){
            console.log("tt:"+val)
        }
    }
}
</script>
<style lang="less" scoped>
h1{
    margin-top: 45px;
}
hr{
    height: 20px;
    background-color: blue;
}
</style>
