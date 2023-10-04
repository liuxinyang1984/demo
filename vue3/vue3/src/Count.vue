<template>
    <my-header title="自定义事件" bgcolor="#0099ff" text_color="#ffffff"></my-header>
    <h3>CountAPP</h3>
    Count:{{count}}
    <br>
    MyCount:{{MyCount}}
    <hr>
    <my-count @countChange="getCountChange"></my-count> </template>
<script>
import MyCount from "./components/MyCount.vue"
import MyHeader from "./components/MyHeader.vue"
export default {
    name:"CountAPP",
    data(){
        return {
            count:100,
            MyCount:0,
        }
    },
    methods:{
        getCountChange(val){
            this.count ++
            this.MyCount = val
        }
    },
    computed:{
    },
    components:{MyCount, MyHeader},
}
</script>
