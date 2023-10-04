<template>
    <div class="cart_container">
        <my-header title="购物车" bgcolor="#0099ff" text_color="#ffffff"></my-header>
        <my-goods v-for="goods in goodsList" :goods="goods" :key="goods.id"></my-goods>
        <div class="count">
            总数:{{count}}
            合计:{{amount}}
        </div>
    </div>
</template>
<script>
import MyHeader from "./components/MyHeader.vue"
import MyGoods from "./components/MyGoods.vue"
export default {
    data:function data(){
        return {
            goods:[],
            goodsList:[
                {
                    id:1,
                    goodsName:'Xbox',
                    price:2000,
                    thumbUrl:'/src/assets/xbox.png',
                    status:true,
                    num:2
                },
                {
                    id:2,
                    goodsName:'PlayStation',
                    price:2400,
                    thumbUrl:'/src/assets/ps.png',
                    status:false,
                    num:1,
                },
                {
                    id:3,
                    goodsName:'Switch',
                    price:1600,
                    thumbUrl:'/src/assets/nes.png',
                    status:true,
                    num:1,
                }
            ]
        }
    },
    components: {
        MyHeader,
        MyGoods
    },
    computed:{
        count(){
            let total=0
            this.goodsList.forEach(g =>{
                if (g.status){
                    total+=g.num
                }
            })
            return total
        },
        amount(){
            let amount = 0 
            this.goodsList.forEach(g =>{
                if(g.status){
                    amount = amount + g.price*g.num
                }
            })
            return amount
        }
    }
    
}
</script>
<style lang="less" scoped>
.cart_container{
    padding-top:45px;
}

</style>
