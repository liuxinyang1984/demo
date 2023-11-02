<template>
    <div :style="style" class='esheader'>
        <p>{{estitle}}</p>
    </div>
</template>

<script>
export default {
    name:'EsHeader',
    data(){
        return{
            style:{
                'backgroundColor':this.bgcolor,
                'color':this.color,
                'fontSize':this.fsize
            }
        }
    },
    props:{
        estitle:{
            type:String,
            default:'es-header'
        },
        bgcolor:{
            type:String,
            default:'#0099ff'
        },
        color:{
            type:String,
            default:'#ffffff'
        },
        fsize:{
            type:Number,
            default:12
        },
    },
    created(){
    }
}
</script>

<style lang="less" scoped>
.esheader{
    position: fixed;
    top: 0;
    left: 0;
    width:100%;
    height:48px;
    text-align: center;
    line-height: 48px;
    z-index: 999;
    p{
        line-height:48px;
        font-weight: bold;
    }
}
</style>
