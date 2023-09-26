<template>
    <div class="header-container" :style={backgroundColor:bgcolor,color:text_color}>
        {{title}}
    </div>
</template>
<script>
export default {
    name:"MyHeader",
    data(){
        return{
        }
    },
    props:['title','bgcolor','text_color'],
}
</script>

<style lang="less" scoped>
.header-container{
    height: 45px;
    background-color: pink;
    text-align: center;
    line-height: 45px;
    width: 100%;
    position: fixed;
    top:0;
    left:0;
    z-index: 999;
}

</style>
