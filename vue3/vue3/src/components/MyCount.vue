<template>
    <h2>MyCounter:{{count}}</h2>
    <button @click="onBtnClick">MyCount ++</button>
</template>
<script>
export default {
    name:"MyCount",
    data(){
        return{
        }
    },
    props:['count'],
    emits:['update:count','tt'],
    methods:{
        onBtnClick(){
            console.log('MyCount:onBtnClick')
            this.$emit('update:count',this.count +1)
            this.$emit('tt',this.count + 1)
        }
    }
}
</script>
