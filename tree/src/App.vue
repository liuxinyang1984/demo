<template>
    <div class="root">
        <my-tree />
    </div>
</template>

<script>
import Person from './components/tree/index.vue'
import MyTree from './components/MyTree/MyTree.vue'
export default {
    name:'root',
    components:{Person,MyTree},
    setup(){
        const data = {
            name:'DataName'
        }

        return {data}
    }
}
</script>

<style>

.root{
    width: 100%;
}
</style>
