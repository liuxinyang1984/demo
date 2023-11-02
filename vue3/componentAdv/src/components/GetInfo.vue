<template>
    <h3>GetInfo</h3>
    <button @click="getInfo">GetInfo</button>
</template>

<script>
export default {
    name:'GetInfo',
    methods:{
        async getInfo(){
            const {data:res} = await this.$http('/api/get',{
                params:{
                    name:'ls',
                    age:33
                }
            })
        }
    }
}
</script>

<style>

</style>
