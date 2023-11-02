<template>
    <div class="goods-container">
        <div class="left">
            <img :src="goods.goods_img" alt="" class="thumb">
        </div>
        <div class="right">
            <div class="top">{{goods.goods_name}}</div>
            <div class="bottom">
                <div class="price">￥{{goods.goods_price.toFixed(2)}}</div>
                <div class="count">数量:{{goods.goods_count}}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'EsGoods',
    props:['goods'],
}
</script>

<style lang="less" scoped>
.goods-container{
    display: flex;
    padding-bottom: 10px;
    .left{
        margin-right: 10px;
        .thumb{
            display: block;
            width:100px;
            height:100px;
            background-color: #efefef;
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
