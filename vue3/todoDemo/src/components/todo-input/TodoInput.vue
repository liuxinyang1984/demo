<template>
    <form class="row row-cols-lg-auto g-3 align-items-center" @submit.prevent="FmSubmit">
        <div class="input-group mb-2 mt-4">
            <div class="input-group-text">任务</div>
            <input type="text" class="form-control" mr-sm-5 placeholder="任务信息" v-model.trim="taskname">
            <button type="submit" class="btn btn-primary" v-on.stop>添加新任务</button>
        </div>
    </form>
</template>
<script>
export default {
    name:"TodoInput",
    data(){
        return {
            taskname:'',
        }
    },
    methods:{
        FmSubmit(){
            if(this.taskname == '') return alert('不能为空')
            this.$emit('addTask',this.taskname)
            this.taskname=''
        },
    }
}
</script>
<style lang="less" scoped>
</style>
