<template>
    <div class="goods_container">
        <div class="cb">
          <input type="checkbox" name="my-checkbox" v-model="goods.status" :id="goods.id" @click="changeCb"/>
        </div>
        <div class="goods_thumb" @click="console.log(goods)">
            <img :src="goods.thumbUrl" :alt="goods.goodsName" />
        </div>
        <div class="goods_info">
            <p class="goods_name">{{goods.goodsName}}</p>
            <p class="goods_price">价格:￥{{goods.price}}</p>
        </div>
        <div class="goods_num">
            <div class="minus" @click = "numMinus">-</div>
            <div class="num">{{goods.num}}</div>
            <div class="plus" @click = "numPlus">+</div>
        </div>
    </div>
</template>
<script>
export default {
    name:'MyGoods',
    props:['goods'],
    methods:{
        numMinus(){
            if(this.goods.num > 0){
                this.goods.num --
            }
        },
        numPlus(){
            this.goods.num ++
        },
        changeCb(){
            console.log(this.goods)
        }
    },
}
</script>
<style lang="less" scoped>
.goods_container{
    height: 80px;
    margin-bottom:3px;
    border-bottom: 1px solid #333;
    .cb{
        box-sizing: border-box;
        padding:10px;
        width:40px;
        height:80px;
        line-height: 60px;
        float: left;
    }
    .goods_thumb{
        width: 80px;
        height: 80px;
        float:left;
        padding:5px;
        box-sizing: border-box;
        border-right: 1px solid #999;

        img{
            width: 100%;
            height: 100%;
        }
    }
    .goods_info{
        float: left;
        margin-left: 10px;
        min-width: 100px;
        height: 80px;
        text-align: left;
        padding:0;
        
        .goods_name{
            height: 20px;
            width: 100%;
            line-height: 30px;
            padding: 0;
            font-weight: bold;
        }
        .goods_price{
            line-height: 30px;
        }
    }
    .goods_num{
        width: 80px;
        height: 80px;
        float: right;

        div{
            margin-top: 60px;
            width:20px;
            height:20px;
            line-height: 20px;
        }
        .minus{
            float:left;
            background-color: red;
        }
        .num{
            width:40px;
            float:left;
        }
        .plus{
            float: right;
            background-color: green;
        }
    }
}
</style>
