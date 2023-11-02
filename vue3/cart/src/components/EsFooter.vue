<template>
    <div class="foot-container">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="fullCheck" :checked="isfull" @change="fullCheckChange">
            <label class="form-check-label" for="fullCheck">
                全选
            </label>
        </div>
        <div class="amount-container">
            <span>合计:</span>
            <span class="amount"> ￥{{amount.toFixed(2)}}元</span>
        </div>

        <button type="button" class="btn btn-primary btn-buy">结算({{total}})</button>
    </div>
</template>

<script>
export default {
    name:'EsFooter',
    props:{
        total:{
            type:Number,
            default:0
        },
        amount:{
            type:Number,
            default:0
        },
        isfull:{
            type:Boolean,
            defaule:false
        }
    },
    emits:['update:isfull','fullChange'],
    methods:{
        fullCheckChange(e){
            console.log("子组件fullCheckChang:"+e.target.checked)
            this.$emit('update:isfull',e.target.checked)
            this.$emit('fullChange',e.target.checked)
        }
    }
}
</script>

<style lang="less" scoped>
.foot-container{
    height: 56px;
    width: 100%;
    background: #ffffff;
    position: fixed;
    z-index:999;
    bottom: 0;
    left: 0;
    border-top: 1px solid #efefef;
    font-size: 14px;

    //内部元素
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding:0 10px;

    .form-check{
        padding-top: 4px;
    }
    .amount-container{
        .amount{
            color:red;
        }
    }
    .btn-buy{
        font-size: 14px;
    }
}
</style>
