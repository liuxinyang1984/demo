<template>
    <div class="input-group counter-container">
        <button type="button" class="btn btn-secondary" @click="onSubClick">-</button>
        <input type="number" class="form-control text-number"  v-model.number="num" >
        <button type="button" class="btn btn-secondary" @click="onAddClick">+</button>
    </div>
</template>

<script>
export default {
    name:"EsCounter",
    data(){
        return{
            num:this.number
        }
    },
    props:{
        number:{
            type:Number,
            default:0
        }
    },
    emits:[
        'goodsNumChange'
    ],
    watch:{
        num( newV,oldV){
            let parseVal = parseInt(newV)
            if(isNaN(parseVal) || parseVal < 0){
                this.num = 0
                return
            }
            if(isNaN(parseVal) || parseVal >999){
                this.num = 999
                return
            }
            this.num = parseVal
            this.$emit('goodsNumChange',this.num)
        }
    },
    methods:{
        onSubClick(){
            if(this.num > 0){
                this.num --
            }
        },
        onAddClick(){
            if(this.num < 999) this.num ++
        },
    }
}
</script>
<style lang="less" scoped>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button { 
    -webkit-appearance: none; 
}
/* 火狐浏览器 */
input[type="number"]{ 
    -moz-appearance: textfield; 
}
.counter-container{
    button{
        width:35px;
    }
    .text-number{
        min-width: 35px;
        width: 40px;
        text-align: center;
        font-style: 12px;
        padding: 5px;
    }

}
</style>
