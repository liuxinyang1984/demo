<template>
  <h3>PostInfo</h3>
  <button class="btn btn-success" @click="postInfo">Post</button>
</template>

<script>
export default {
    methods:{
        async postInfo(){
            const {data:res} = await this.$http.post('/api/post',{
                name:'zs',
                age:20
            })
            console.log(res)
        }
    }
}
</script>

<style>

</style>
