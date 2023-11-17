<template>
    <h1>获取企叮咚商品</h1>
    <input type="button" value="获取列表" @click="makeTable">
    <table border=1 width="100%" cellpadding=5>
        <thead>
            <tr>
                <th>页数</th>
                <th>状态</th>
                <th>??</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="page in pageList" :key="page.page">
                <td>{{page.page}}</td>
                <td>{{page.status}}</td>
                <td>
                    <input type="button" value="同步" @click="syncPage(page.page)">
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>

export default {
  name: 'App',
  components: {
  },
    data(){
        return{
            totalPage:0,
            pageCursor:1,
            pageList:[]
        }
    },
    methods:{
        async getGoodsPage(){
            const {data:res}= await this.$http.get('/getgoodslist')
            if(res.code !=200) return alert(res.msg)
            this.totalPage = res.data.data.total_page
            console.log('总数:'+this.totalPage)
        },
        makeTable(){
            console.log('开始生成列表')
            for(let i=1;i<=this.totalPage;i++){
                this.pageList.push({
                    'page':i,
                    'status':'none'
                })
            }
            console.log(this.pageList)
        },
        async syncPage(page){
            console.log('参数:'+page)
            const {data:res}= await this.$http.get('/sync/'+page)
            if(res.code !=200) return alert(res.msg)
            console.log(res)
        }
    },
    created(){
        console.log("开始...")
        this.getGoodsPage();
    }
}
</script>
