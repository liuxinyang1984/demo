<template>
    <div class="approot">
        <es-header estitle="购物车" :fsize=24></es-header>
        <h1>Root组件</h1>
        <hr>
        <div class="goods-list" v-for="goods in goodsList" :key="goods.goods_id">
            <es-goods :goods="goods" :id="goods.goods_id"></es-goods>
        </div>

        <es-footer :amount="0" :total="1" v-model:isfull="isfull" @fullChange="fullChange"></es-footer>
    </div>
</template>

<script>
import EsHeader from "./components/EsHeader.vue"
import EsFooter from "./components/EsFooter.vue"
import EsGoods from "./components/EsGoods.vue"
export default {
    name: 'CartRoot',
    components: {
        EsHeader,
        EsFooter,
        EsGoods
    },
    data(){
        return {
            goodsList:[],
            isfull:true,
        }
    },
    methods:{
        async getGoodsList(){
            const {data:res} = await this.$http.get('/api/cart')
            if(res.status != 200) alert('请求商品列表数据失败')
            this.goodsList = res.list
        },
        fullChange(val){
            console.log("父组件fullChange:"+val)
        }
    },
    created(){
        this.getGoodsList()
    }
}
</script>
<style lang="less" scoped>
.approot{
    padding-top: 48px;
}
</style>
