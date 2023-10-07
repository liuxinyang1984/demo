<template>
    <div>
        <my-header></my-header>
        <todo-input @addTask="addTask"></todo-input>
        <todo-list v-model:list="taskList"></todo-list>
        <todo-button v-model:flag="flag"></todo-button>
    </div>
</template>

<script>
import TodoList from  './components/todo-list/TodoList.vue'
import TodoInput from './components/todo-input/TodoInput.vue'
import TodoButton from './components/todo-button/TodoButton.vue'
export default {
    components: { 
        TodoList,
        TodoInput,
        TodoButton,
    },
    name: 'AppRoot',
    data(){
        return {
            todolist:[
                {
                    id:1,
                    task:"周一早晨点开会",
                    done:false,
                },
                {
                    id:2,
                    task:"周一晚上8点聚餐",
                    done:false,
                },
                {
                    id:3,
                    task:"准备周三上午的演讲稿",
                    done:true,
                }
            ],
            flag:"all"
        }
    },
    methods:{
        addTask(taskName){
            const task = {
                id:this.todolist.length+1,
                task:taskName,
                done:false
            }
            this.todolist.push(task)
        }
    },
    computed:{
        taskList(){
            switch (this.flag){
                case "all":
                    console.log("all")
                    return this.todolist
                case "done":
                    console.log("done")
                    return this.todolist.filter(x => x.done)
                case "undo":
                    console.log("undo")
                    return this.todolist.filter(x => !x.done)
                default:
                    console.log("default")
                    break
            }
        }
    }
}
</script>

<style lang="less" scoped>

    </style>
