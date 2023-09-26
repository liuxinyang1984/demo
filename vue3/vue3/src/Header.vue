<template>
    <div id="app-container">
        <h1>APP根组件</h1>
    </div>
    <hr>
    <my-count count=3 :status="true"></my-count>
</template>
<script>
import MyHeader from "./components/MyHeader.vue"
import MyCount from "./Count.vue"
export default {
    components: { MyHeader,MyCount},
    name:"APP",
    data:function data(){
        return {
        }
    },
}
</script>

<style lang="less" scoped>
*{
    text-align: left;
    background-color: yellow;
}
#app-container{
    margin-top: 45px;
}


</style>
