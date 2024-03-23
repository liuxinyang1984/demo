<template>
    <div class="person">
        <h1>Person</h1>
        <h2>姓名:{{name}}</h2>
        <h2>年龄:{{age}}</h2>
    </div>
</template>

<script lang=ts>
    export default{
        name:'Person',
        setup(){
            let name="Mr.Cookie"
            let age = 18



            return{name,age}
        }
    }

</script>

<style>

</style>
