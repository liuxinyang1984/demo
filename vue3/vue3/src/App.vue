<template>
    <h1 @click="test3" :class="isItalic ? 'italic' : ''">App.vue</h1>
    <my-style></my-style>
    <hr>
    <button @click="isItalic = !isItalic">Toggle Italic</button>
    <my-artical :title="artTitle" :author="artAuthor"></my-artical>
    <hr>
    <my-swiper></my-swiper>
    <my-search></my-search>
    <my-test></my-test>
    <IamTest></IamTest>


</template>

<script>
import Search from "./components/MySearch.vue"
import MyTest from "./components/MyTest.vue"
import MyArtical from "./components/MyArtical.vue"
import MyStyle from "./components/MyStyle.vue"
export default {
    name:"RootApp",
    data(){
        return {
            username:"gogogo",
            artTitle:"书名",
            artAuthor:"作者名",
            isItalic:true
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
        MyTest,
        MyArtical,
        MyStyle
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
.italic{
    font-style: italic;
}
</style>
