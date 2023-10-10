<template>
    <div class="com2">
        <h3>02:{{color}}</h3>
    </div>
</template>

<script>
export default {
    name:'component02',
    data(){
        return{
            num:0
        }
    },
    inject:['color'],
}
</script>

<style>

</style>
