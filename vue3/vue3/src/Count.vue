<template>
    <h3>Count</h3>
    <hr>
    <p>数量:{{count}}</p>   
    <p>状态:{{status}}</p>
</template>
<script>
export default {
    name:"MyCount",
    props:{
        count:{
            type:[Number,String],
            required:true
        },
        status:[Boolean,String]
    },
}
</script>
