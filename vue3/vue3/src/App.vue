<template>
    <h1 @click="test3">App.vue</h1>
    <my-swiper></my-swiper>
    <my-search></my-search>
    <my-test></my-test>
    <IamTest></IamTest>
</template>

<script>
import Search from "./components/MySearch.vue"
import MyTest from "./components/MyTest.vue"
export default {
    name:"RootApp",
    data:function data(){
        return {
            username:"gogogo"
        }
    },
    methods:{
        //同名函数
        test:function test(){
            console.log("test")
        },
        //同上
        test3(){
            console.log("test3")
        },
        test4:()=>{
            console.log("test4")
        }
    },
    components:{
        "my-search":Search,
        MyTest
    }
}
function fnData(){
    return{
        username:"hahaha"
    }
}
</script>


<style lang="less">
h1{
    color:red;
}
</style>
