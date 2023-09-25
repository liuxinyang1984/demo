<template>
    <h3>标题:{{title}}</h3> 
    <h5>作者:{{author}}</h5>
</template>


<script>
export default {
    props:[
        'title','author'
    ],
}
</script>
