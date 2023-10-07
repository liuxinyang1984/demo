<template>
    <div class="btn-group mt-2 col-12" role="group" aria-label="Basic mixed styles example">
        <button type="button" class="btn" :class="flag == 'all' ? 'btn-primary' : 'btn-secondary'" @click="changeFlag('all')">全部</button>
        <button type="button" class="btn" :class="flag == 'done' ? 'btn-success' : 'btn-secondary'" @click="changeFlag('done')">已完成</button>
        <button type="button" class="btn" :class="flag == 'undo' ? 'btn-warning' : 'btn-secondary'" @click="changeFlag('undo')">未完成</button>
    </div>
</template>
<script>
export default {
    name:"TodoButton",
    props:{
        flag:{
            type:String,
            required:true,
            default:"all"
        }
    },
    emits:['update:flag'],
    methods:{
        changeFlag(val){
            if(val === this.flag) return
            this.$emit('update:flag',val)
        }
    }
}
</script>
<style lang="less" scoped>
</style>
