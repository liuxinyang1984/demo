<template>
    <div class="approot">
        <es-header estitle="购物车" :fsize=24></es-header>
        <div class="goods-list" v-for="(goods,index) in goodsList" :key="goods.goods_id">
            <es-goods :goods="goods" :id="goods.goods_id" @goodsStateChange="updateGoodsState"></es-goods>
        </div>

        <es-footer :amount="amount" :total="total" v-model:isfull="isfull" @fullChange="fullChange"></es-footer>
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
            //isfull:false,
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
            this.goodsList.forEach(goods=>{
                goods.goods_state = val
            })
        },
        onGoodsStateChange(e){
            //console.log("ROOT.onGoodsStateChange:")
            //console.log(e)
            const goods = this.goodsList.find(item => item.goods_id === e.id)
            if(goods){
                goods.goods_state = e.state
            }
            //console.log(this.goodsList)
        },
        updateGoodsState(e){
            //const goods = this.goodsList.find(item => item.goods_id === e.goods_id)
        }
    },
    created(){
        this.getGoodsList()
    },
    computed:{
        amount(){
            let amount= 0
            this.goodsList
                .filter(x => x.goods_state)
                .forEach(x => {
                amount += x.goods_price * x.goods_count
            })
            return amount
        },
        total(){
            let total = 0
            this.goodsList.filter(goods => goods.goods_state).forEach(goods => {
                //console.log(goods)
                total += goods.goods_count
            })
            return total
        },
        isfull(){
            if(this.goodsList.filter(goods => !goods.goods_state).length > 0){
                return false
            }else{
                return true
            }
        }
    }
}
</script>
<style lang="less" scoped>
.approot{
    padding-top: 48px;
    padding-bottom: 56px;
}
</style>
