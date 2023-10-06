<template>
<ul class="list-group">
    <li class="list-group-item d-flex justify-content-between align-items-center" v-for="item in list" :key="item.id">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" :id="'todo-'+item.id" v-model="item.done">
            <label class="form-check-label" :class="item.done?'delete':''" :for="'todo-'+item.id">
                {{item.task}}
            </label>
        </div>
        <span class="badge bg-success rounded-pill" v-if="item.done">完成</span>
        <span class="badge bg-warning rounded-pill" v-else>未完成</span>
    </li>
</ul>

</template>

<script>
export default {
    name:"TodoList",
    props:{
        list:{
            type:Array,
            required:true,
            default:[]
        }
    },
    emits:['update:list'],
    methods:{
        check(index){
            console.log(this.list)
            //this.list[index].done =!this.list[index].done
            this.$emit("update:list",this.list )
        }
    }
    
}
</script>

<style lang="less" scoped>
label.delete{
    text-decoration: line-through;
    color:gray;
    font-style: italic;
}
</style>
