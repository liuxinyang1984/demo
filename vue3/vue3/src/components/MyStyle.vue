<template>
    <h2>样式组件</h2>
    <h3 :class="objStyle">测试样式</h3>
    <button @click="objStyle.italic = !objStyle.italic">Toggle Italic</button>
    <button @click="objStyle.delete = !objStyle.delete">Toggle Delete</button>
    <div :style="{color:active,'font-size':fsize+'px',backgroundColor:bgcolor}">
        测试文本
    </div>
    <button @click="fsize ++">增大</button>
    <button @click="fsize --">减小</button>
</template>

<script>
export default {
    data(){
        return {
            active:"red",
            fsize:24,
            bgcolor:"green",
            objStyle:{
                italic:true,
                delete:false,
            },
        }
    }
}
</script>
<style lang="less" scoped>
.thin{
    font-weight: thin;
}
.italic{
    font-style: italic;
}

.delete{
    text-decoration: line-through;
}
</style>
