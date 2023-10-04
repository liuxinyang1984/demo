<template>
    <div id="app-container">
        <h1>APP根组件</h1>
    </div>
    <my-computed></my-computed>
    <hr>
</template>
<script>
import MyHeader from "./components/MyHeader.vue"
import MyCount from "./Count.vue"
import MyComputed from "./components/MyComputed.vue"
export default {
    components: { MyHeader,MyCount,MyComputed},
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
