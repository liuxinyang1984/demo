<template>
    <div class="goods-container">
        <div class="left">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" :id="'goods-'+goods.goods_id" :checked="goods.goods_state" @change="onInputChecked">
                <label class="form-check-label" :for="'goods-'+goods.goods_id">
                    <img :src="goods.goods_img" alt="" class="thumb">
                </label>
            </div>
        </div>
        <div class="right">
            <div class="top">{{goods.goods_name}}</div>
            <div class="bottom">
                <div class="price">￥{{goods.goods_price.toFixed(2)}}</div>
                <div class="count">
                    <es-counter :number="goods.goods_count" @goodsNumChange="onGoodsNumChange"></es-counter>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import EsCounter from "./EsCounter.vue"
export default {
    name:"EsGoods",
    components: { EsCounter },
    props:['goods'],
    emits:['goodsStateChange'],
    methods:{
        onInputChecked(e){
            console.log('EsGoods:点击')
            const goodsTemp = this.goods
            goodsTemp.goods_state = e.target.checked
            this.$emit('goodsStateChange',goodsTemp)
        },
        onGoodsNumChange(e){
            console.log("商品数量变化:")
            const goodsTemp = this.goods
            goodsTemp.goods_count = e
            this.$emit('goodsStateChange',goodsTemp)
        }
    }
}
</script>

<style lang="less" scoped>
.goods-container{
    border-top: 1px solid #efefef;
    display: flex;
    padding-bottom: 10px;
    .left{
        margin-right: 10px;
        .form-check{
            .form-check-input{
                margin-top: 43px;
            }
            .form-check-label{
                .thumb{
                    display: block;
                    width:100px;
                    height:100px;
                    background-color: #efefef;
                }
            }
        }
    }
    .right{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex:1;
        .top{
            font-weight: bold;
        }
        .bottom{
            display: flex;
            justify-content: space-between;
            align-content: center;
            .price{
                color:red;
                font-weight: bold;
            }
        }
    }
}
</style>
