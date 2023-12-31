# Vue的基础
## vue基本使用
1. 导入vue.js的script脚本文件
    ```html
    <script src="https://unpkg.com/vue@2.6.14/dist/vue.global.js"></script>
    ```
1. 声明一个被vue控制的DOM区域
    ```html
    <div id="app">
    </div>
    ```
1. 创建一个vm实例对象(vue实例)
    ```html
    <script>
        //创建vue实例对象
        const vm = new Vue({
            el:"#app",
            data:{
                username:"Mr.cookie"
            }
        })
    </script>
    ```

## vue的指令
### 内容渲染指令
用来辅助开发者渲染DOM元素的文本内容,学用的内容渲染指令有3个
1. v-text
    ```html
        <p v-text="username"></p>
        <!--默认值会被覆盖掉-->
        <p v-text="age">99</p>
    ```
1. {{}}    
    为解决v-text会覆盖默认文本问题,可以使用{{}}插值表达式(Mustache).
    1. 基本用法
    ```html
    <p>姓名:{{username}}</p>
    ```
    1. JavaScript表达式
    ```vue
    //运算表达式
    {{number +1}} 
    //三元运算表达式
    {{isOk?'Yes':'No'}}
    //字符串处理
    {{message.split('').reverse().join('')}}
    //对象的属性值
    {{user.name}}
    ```
1. v-html
    如果要把包含HTML标签的字符串渲染为页面的HTML元素,需要用v-html指令.
    ```html
        ...
        <div v-html="disc"></div>
        ...
    <script>
        //创建vue实例对象
        const vm = new Vue({
            el:"#app",
            data:{
                username:"Mr.cookie",
                age:39,
                disc:"<h5 style='color:red'>这里是html字符串</h5>"
            },
        })
    </script>
    ```

### 属性绑定指令
v-bind属性绑定指令,可以动态绑定元素的属性值
1. 基本用法    
    ```html
    ...
    <input type="text" v-bind:placeholder="inputValue">
    ...
    <script>
        //创建vue实例对象
        const vm = new Vue({
            el:"#app",
            data:{
                username:"Mr.cookie",
                age:39,
                disc:"<h5 style='color:red'>这里是html字符串</h5>"
                inputValue:"这里是输入框placeholder默认值"
            },
        })
    </script>
    ```
1. 快捷用法
    ```html
    <img :src="imgUrl">
    <!-- 使用js表达式-->
    <div :id="'list-'+id">
    ...
    <script>
        ...
        data:{
            ...
            id:1,
            imgUrl="images/logo.png",
            ...
        }
    </script>
    ```
### 事件绑定指令
v-on指令,可以为DOM元素绑定事件监听
1. 基本用法
    ```html
    <h3>count的值:{{count}}</h3>
    <button v-on:click="addCount">+1</button>
    ...
    <script>
    ...
    data:{
        count:0
    }
    methods:{
        addCount(){
            this.count ++
        }
    }
    ...
    </script>
    ```
1. 快捷用法
    ```html
    <button @click="count ++">+1</button>
    ```
1. 事件对象event    
    在事件处理函数中,可以接收到事件对象event
    ```html
    <button @click="addCount">+1</button>
    <script>
    ...
    methods:{
        addCount(e){
            const bgColor = e.target.style.backgroundColor
            console.log(bgColor)
            e.target.style.backgroundColor = bgColor ==='red'?'':'red'
            this.count ++
        }
    }
    ...
    </script>
    ```
1. 事件传参
    1. 普通传参
    ```html
    <button @click="addCount(2)">+1</button>
    <script>
    ...
    methods:{
        addCount(step){
            this.count += step
        }
    }
    ...
    </script>
    ```
    1. 传参事件对象event
    ```html
    <!-- $event为特殊变量,用来传递event参数-->
    <button @click="addCount(2,$event)">+1</button>
    <script>
    ...
    methods:{
        addCount(step,event){
            this.count += step
            console.log(event)
        }
    }
    ...
    </script>
    ```
1. 事件修饰符     
vue提供了事件修饰符来对事件的触发进行控制,常用的5个事件修饰符    
| 事件修饰符 | 说明                                               |
|------------|----------------------------------------------------|
| .prevent   | 阻止默认行为(例如:阻止链接跳转,阻止表单提交)       |
| .stop      | 阻止事件冒泡                                       |
| .capture   | 以捕获模式触发当前的事件处理函数                   |
| .once      | 只触发一次绑定事件                                 |
| .self      | 只有在event.target是当前元素自身时触发事件处理函数 |
    - .prevent
        ```html
        <a href="http://www.baidu.com" @click.prevent="onAlinkClick">链接</a>
        <script>
        ...
        methods:{
            onAlinkClick(){
                console.log("阻止默认行为!")
            }
        }
        ...
        </script>
        ```
    - 事件冒泡
        ```html
        <div id="box" @click="divBox">
            <div id="sub" @click.stop="divSub"></div>
        </div>
        <script>
        ...
        methods:{
            divBox(){
                console.log('divBox')
            },
            divSub(){
                console.log('divSub)
            }
        }
        ...
        </script>
        ```
    - 事件捕获
        ```html
        <div id="box" @click.capture="divBox">
            <div id="sub" @click.stop="divSub"></div>
        </div>
        <script>
        ...
        methods:{
            divBox(){
                console.log('divBox')
            },
            divSub(){
                console.log('divSub)
            }
        }
        ...
        </script>
        ```
    - 只触发一次
        ```html
        <div id="box" @click.once="divBox">
            <div id="sub" @click.stop="divSub"></div>
        </div>
        ```
1. 按键修饰符    
    ```html
    <input type="text" @keyup.enter="submit">  
    <input type="text" @keyup.esc="escap">  
    ```
### 双向绑定指令
v-model指令,可以用来辅助开发者在不操作DOM的前提下,快速获取表单的数据
1. 基本用法
    ```html
    <input type="text" v-model="username">
    <select name="" id="" v-model="province" @change="select">
        <option value="1" >请选择</option>
        <option value="2">北京</option>
        <option value="3">上海</option>
        <option value="4">天津</option>
    </select>
    ```
1. 指令修饰符    
为主方便对用户输入的内容进行处理,vue提供了3个v-model的指令修饰符    
| 修饰符  | 作用                           | 示例                               |
|---------|--------------------------------|------------------------------------|
| .number | 自动将用户的输入值转为数值类型 | ```<input v-model.number="age">``` |
| .trim   | 自动过滤用户输入的首尾空白字符 | ```<input v-model.trim="msg"> ```  |
| .lazy   | 在"change"时,而非"input"时更新 | ```<input v-model.lazy="email">``` |
### 条件渲染指令
条件渲染指令可以按需控制DOM的显示与隐藏,vue提供了2个条件渲染指令
| 指令      | 作用                             | 示例                                     |
|-----------|----------------------------------|------------------------------------------|
| v-if      | 动态创建,隐藏会移除DOM           | ```<div id="box" v-if="flag"></div>```   |
| v-else    | 配合v-if使用                     | ```<div id="box2" v-else></div>```       |
| v-else-if | 配合v-if使用                     | ```<div id="box2" v-else-if="type ==='C'"></div>```       |
| v-show    | 控制display:none,隐藏不会移除DOM | ```<div id="box" v-show="flag"></div>``` |
### 列表渲染指令
v-for指令可以基于一个数据循环渲染相似的UI结构
1. 基本使用
    ```html
    <ul>
        <li v-for="(item,index) in list" :id="index">姓名:</li>
    </ul>
    ...
    <script>
    ...
    data:{
        ...
        list:[
            {id:1,name:'洋哥'},
            {id:2,name:'洋姐'}
        ],
    },
    ...
    </script>
    ```
1. 维护列表状态   
在列表数据发生变化时,有状态的列表无法被正确更新,提供一个唯一的key属性,可以保证有状态的列表被正确的更新.    
>**用索引index绑定key没有意义**
    ```html
    <ul>
        <li v-for="(item,index) in list" :id="index" :key="user.id">姓名:</li>
    </ul>
    ```

## Vue的过滤器
过滤器常用于文本的格式化,如将字符串的首字母大写等.过滤器应该被添加在javascript表达式的尾部,用"|"进行调用
> 过滤器在vue 3.x版本中已剔除.
### 过滤器的使用
```html
<p>{{msg | capitalize}}</p>
<div v-bind:id="rawId | formatId"></div>
```
### 过滤的定义
在vue事例化中,可以在filters节点中定义过滤器
1. 基本用法
```javascript
const vm = new Vue({
    ...
    filters:{
        capitalize(str){
            return str.charAt(0).toUpperCase()+str.slice(1)
        }
    }
})
```
1. 私有和全局过滤器
在filters节下定义的过滤器为私有过滤器,只能在当前vm实例内使用.如果要在多个实例之间共享过滤器,可以声明一个全局过滤器
```javascript
Vue.filter('cap',function(str){
    return "####"+str.charAt(0).toUpperCase()+str.slice(1)+"####"
})
```
1. 连续调用
```html
<p>{{msg | cap | filter2 | filter 3}}</p>
```
1. 过滤器传参
```html
<p>{{msg | cap | maxsize(5)}}</p>
<script>
    Vue.filter('maxsize',(str,size=10)=>{
        if(str.size <= size) return str
        return str.slice(0,size)+"..."
    })
</script>
```

## 案例
### 创建基本vue实例

### 基于vue渲染表格数据
1. 渲染表格数据 
1. 为状态添加bootstrap开关
1. 使用全局过滤器对时间进行格式化
    ```html
    <td>{{brand.addtime | doteFormat}}</td>
    <script>
    Vue.filter('dateFormat',(str)=>{
        const dateTime = new Date(str)

        const y =dateTime.getFullYear()
        const m = padZero(dateTime.getMonth() +1)
        const d = padZero(dateTime.getDate())
        const hh = padZero(dateTime.getHours())
        const mm = padZero(dateTime.getMinutes())
        const ss = padZero(dateTime.getSeconds())
        return `${y}-${m}-${d} ${hh}:${mm}:${ss}`
    })
    function padZero(n){
     return n>9?n:'0'+n
    }
    ...
    </script>
    ```
### 实现添加品牌功能
1. 阻止表单的默认提交行为
    ```html
   <form action="" class="for-inline" @submit.prevent>
    ...
   </form>
    ```
1. 为input输入框双向绑定数据
   ```html
   <form action="" class="for-inline" @submit.prevent>
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text">品牌名称</div>
            </div>
            <input type="text" class="form-control" v-model.trim="brandname">
        </div>
        <button type="submit" class="btn btn-primary mb-2">添加品牌</button>
   </form>
   ```
1. 为button按钮绑定事件处理
    ```html
    <button type="submit" class="btn btn-primary mb-2" @click="btnSubmit">添加品牌</button>
    ...
    <script>
        methods:{
            btnSubmit(){
                if(this.brandname === '') return alert('不能为空')
                brand = {
                    id:this.cursor+1,
                    brandname:this.brandname,
                    addtime:new Date()
                }
                this.brandlist.push(brand)
                this.cursor++
                console.log(this.brandlist)
            }
        }
    </script>
    ```
1. 为输入框添加快速清空功能
    ```html
    <button type="submit" class="btn btn-primary mb-2" @click="btnSubmit">添加品牌</button>
    ```

### 实现删除品牌功能
1. 为删除链接绑定事件处理,并取消默认行为
    ```html
    <a href="#" @click.prement="btnDelete(brand.id)">删除</a>
    ```
1. 声明处理方法
    ```html
    btnDelete(id){
        this.brandlist = this.brandlist.filter(x=>x.id !==id)
    }
    ```
### 实现修改品牌状态功能

# 组件基础
## vite的基本使用

1. 创建vite项目
```shell
npm init vite-app 项目名称
cd 项目名称
npm install
npm run dev
```

1. 目录结构
    - node_modules 目录用来存放第三方依赖包
    - public 公共的静态资源目录
    - src 项目源代码
        - assets 项目中所有的静态资源文件(css.font)
        - components 项目中的所有自定义组件
        - App.vue 项目的根组件
        - index.css 全局样式表
        - main.js 项目的打包入口文件
    - .gitignore
    - index.html 单页面应用的入口HTML文件
    - package.json 包管理配置文件
1. 项目运行流程    
通过main.js把App.vue渲染到index.html的指定区域中
    1. 文件作用 
        - App.vue 用来编写待渲染的模板结构
        - index.html 预留一个el区域
    1. 运行流程
        1. index标记el区域
            ```html
            <div id="app"></div>
            ```
        1. 引入main.js文件渲染
            ```html
            <script type="module" src="/src/main.js"></script>
            ```
            1. 导入vue组件的createApp函数
                ```vue
                import { createApp } from 'vue'
                ```
            1. 导入App组件(待渲染)
                ```vue
                import App from './App.vue'
                ```
            1. 创建实例并挂载
                ```vue
                //调用createApp()函数,返回一个单页面应用程序的实例,用常量spa_app进行接收
                const spa_app = createApp(App)
                //调用实例方法mount(),指定vue控制区域
                spa_app.mount('#app')
                ```

## 组件开发
把页面可重用部分封闭为组件,从而方便项目的开发和维护
### 组件化开发的优点
- 提高代码的利用性和灵活性
- 提升开发效率和可维护性

### vue的组件化开发    
- vue是一个完全支持组件化开发的框架
- vue规定组件的后缀后为.vue
- App.vue就是一个vue组件

### 组件的构成
#### template节点(必选) 组件的模板结构
1. 基本结构
    每个组件的模板结构,需要定义到template节点中
    ```vue
    <template>
        <!-- 当前组件的DOM结构 -->
    </template>
    ```
    > template是vue提供的容器标签,只起到包裹的作用,并不会被渲染为真正的DOM元素
1. 在template使用指令
    ```vue
    <template>
        <h1>App.vue</h1>
        <!-- 使用{{}}插件表达式 -->
        <p>生成一个随机数字:{{(Math:random()*10).toFixed(2)}}</p>
        <!-- 使用v-band绑定属性-->
        <p :title="new Date().toLocalTimeString()">默认文本</p>
        <!--使用v-on绑定事件-->
        <buttom @click="showInfo">按钮</buttom>
    </template>
    ```
1. 定义根节点    
在vue2.x版本中,templete节点内的DOM结构权仅支持单个根节点
    ```html
    <template>
        <!-- vue 2.x版本,节点内的所有元素,最外层必须有唯一的根节点包裹,否则会报错 -->
        <div>
            <h1>Vue 2.x</h1>
        </div>
    </template>
    ```
在vue3.x版本中,template支持定义多个节点
    ```html
    <template>
        <!-- vue 2.x版本,包含多个节点,不需要最外层包裹 -->
        <h1>Vue 3.x</h1>
        <h2>不需要包裹</h2>
    </template>
    ```

#### script节点(可选) 组件的JavaScript业务逻辑
1. 基本结构
    ```html
    <script>
    //默认导出对象
    export default{}
    </script>
    ```
1. name节点    
    定义当前组件名称
    ```html
    export default {
        name:"RootApp"
    }
    ```
1. data节点    
    定义渲染期间用到的数据
    ```html
    export default {
        name:"RootApp",
        data:function data(){
            return {
                username:"gogogo"
            }
        }
    }
    ```
    ```html
    export default {
        name:"RootApp",
        function data(){
            return {
                username:'洋哥'
            }
        }
    }
    ```
    ```html
    data:()=>{
        return {
            username:'洋哥'
        }
    }
    ```
    ```html
    data(){
        return {
            username:'洋哥'
        }
    }
    ```
1. methods节点    
    定义组件中的事件处理方法
    ```html
    export default {
        name:"RootApp",
        data(){
            ...
        },
        methods:{
            test:function()=>{
                //this为当前组件实例
                console.log(this)
            }
        }
    }
    ```

#### style节点(可选) 组件的样式
1. 基本结构
    ```html
    <style lang="css">
    </style>
    ```
    > lang默认只支持css语法,可选值还有less,scss等
1. less语法支持
    1. 安装依赖包
    ```shell
    npm i less -D       //安装less组件到开发依赖
    ```
    1. style标签添加lang="less"属性
    ```html
    <style lang="less">
    </style>
    ```
### 组件的注册
组件之间可以相互引用,组件引用原则:先注册后使用
#### 注册组件的两种方式
1. 全局注册    
    被全局注册的组件,可以在全局任务一个组件内使用
    1. 新建一个组件
    ```javascript
    // components/MySwiper.vue
    <template>
        <h3>轮播图</h3>
    </template>
    <script>
    export default {
        name:"全局轮播图"
    }
    </script>
    ```
    1. 在main.js导入组件
    ```javascript
    import Swiper from "./components/MySwiper.vue"
    import Test from "./components/MyTest.vue"
    ```
    1. 调用vue实例的component()方法,在全局注册组件
    ```javascript
    spa_app.component('my-swiper',Swiper)
    spa_app.component('my-test',Test)
    ```
1. 局部注册
    被局部注册的组件,只能在当前注册范围内使用
    1. 在组件内导入要注册的组件
    ```html
    <script>
    import Search from "./components/MySearch.vue"
    export default{
        componets:{
            'my-search':Search,
        }
    }
    </script>
    ```

#### 组件注册时的命名
1. kebab-case命名法(短横线命名法,my-swiper my-search)
    使用时必须按照kebab-case来使用
    ```html
    <template>
        <my-swiper></my-swiper>
        <my-search></my-search>
    </template>
    <script>
    import Swiper from "./components/my-swiper"
    import Search from "./components/my-search"
    export default{
        components:{
            "my-swiper":Swiper,
            "my-search":Search
        },
    }
    </script>
    ```
1. PascalCase命名法(帕斯卡命名法/大驼峰命名法,MySwiper MySearch)
    使用时可以按照Pascalcase来使用,也可以转换为kebab-case来使用
    ```html
    <template>
        <mySwiper></mySwiper>
        <my-search></my-search>
    </template>
    <script>
    import Swiper from "./components/my-swiper"
    import Search from "./components/my-search"
    export default{
        components:{
            "my-swiper":Swiper,
            "my-search":Search
        },
    }
    </script>
    ```


### 组件的props
#### 什么是props
props是组件的自定义属性,组件的使用者可以通过props把数据传递到子组件内部,代子内部进行使用
```html
<my-articel title="面朝大海,春暖花开" author='海子'</my-articel>
```
- props的作用:父组件通过props向子组件传递要展示的数据
- props的好处:提高了组件的复用性

#### props的声明
在封闭vue组件时,可以把动态的数据声明为props自定义属性,自定义属性可以在当前组件的模板结构中直接使用.
```html
<!-- MyArtical.vue -->
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
```
```html
<!-- App.vue -->
...
<my-articel title="面朝大海,春暖花开" author='海子'</my-articel>
...
<script>
import MyArtical from "./components/MyArtical.vue"
export default {
    name:"RootApp",
    data:function data(){
        return {
       ...
       }
    },
    methods:{
        ...
    },
    components:{
        ...
        MyArtical
    }
}
</script>
```

> 给子组件传递了未声明的props属性,这些属性会被忽略,无法被子组件使用

#### 动态绑定props的值
```html
<my-artical :title="artTitle" :author="artAuthor"></my-artical>
...
    data:function data(){
        return {
            username:"gogogo",
            artTitle:"书名",
            artAuthor:"作者名"
        }
    },
```

#### 组件的大小写命名

组件中如果使用camelCase(驼峰命名法)声明了props属性的名称,则有两种方式绑定属性的值
- 驼峰式(camelCase)
    ```html
    <my-artical :title="artTitle" :author="artAuthor"></my-artical>
    ```
- 短横线(kebab-case)
    ```html
    <my-artical :title="art-title" :author="art-author"></my-artical>
    ```

### class与Style
#### 绑定class
可以通过三元表达式,动态绑定class类名
```html
<h1 @click="test3" :class="isItalic ? 'italic' : ''">App.vue</h1>
<button @click="isItalic = !isItalic">改变字体</button>
<script>
...
export default{
    date(){
        return {
            isItalic:true
        }
    },
}
</script>
<style>
.italic{
    font-style: italic;
}
</style>
```

#### 以数组方式绑定
如果元素需要动态绑定多个class类名,可以使用数组的语法格式
```html
<h3 :class="['thin',isItalic ? 'italic' : '',isDelete ? 'delete' : '']">测试样式</h3>
```
#### 以对象方式绑定
```html
<h3 :class="objStyle">测试样式</h3>
<button @click="objStyle.italic = !objStyle.italic">Toggle Italic</button>
<button @click="objStyle.delete = !objStyle.delete">Toggle Delete</button>
<script>
export default{
    data(){
        return{
            objStyle:{
                italic:true,
                delete:false
            }
        }
    }
}
</script>
```
#### 以对象方式绑定内联style
可以为:style绑定一个对象,对象的属性(css property)可以用驼峰式(camleCase)或者短横线(kebab-case)来命名
```html
<div :style="{color:active,'font-size':fsize+'px',backgroundColor:bgcolor}">
测试文本
</div>
<button @click="fsize ++">增大</button>
<button @click="fsize --">减小</button>
<script>
export default{
    data(){
        return{
            active:'red',
            fsize:24,
            bgcolor:'pink'
        }
    }
}
</script>
```
### 封装一个组件
#### 需求
1. 允许自定义标题
1. 允许自定义背景色
1. 允许自定义文本颜色
1. 组件需要在页面顶部fixed固定
#### 创建一个组件
```html
<template>
    <div class="header-container">
    </div>
</template>
<script>
export default {
    name:"MyHeader",
    data(){
        return{
        }
    },
}
</script>
<style lang="less" scoped>
</style>
```
#### 配置组件样式
1. 配置组件背景颜色
```html
<style lang="less" scoped>
.header-container{
    height: 45px;
    background-color: pink;
    width: 100%;
}
</style>
```
1. 配置文本居中
```html
<style lang="less" scoped>
.header-container{
    ...
    text-align: center;
    line-height: 45px;
}
</style>
```
1. 配置组件定位
```html
<style lang="less" scoped>
.header-container{
    ...
    position: fixed;
    top:0;
    left:0;
    z-index: 999;
}
</style>
```

#### 封装属性
```html
<template>
    <div class="header-container" :style={backgroundColor:bgcolor,color:text_color}>
        {{title}}
    </div>
</template>
<script>
export default {
    name:"MyHeader",
    data(){
        return{
        }
    },
    props:['title','bgcolor','text-color'],
}
</script>
```
#### 传递给子组件属性
```html
<my-header title="MyHeader" bgcolor="#0099ff" text_color="#ffffff"></my-header>
```

### props验证
为了阻止数据不合法,在封闭组件时对外界传递过来的props数据进行合法性校验
> 使用对象类型的props节点,可以对每个props进行数据类型的校验
#### 基础类型检查
```html
props:{
    A:String,               //字符串
    B:Number,               //数字
    C:Boolean,              //布尔
    D:Array,                //数组
    E:Object,               //对象
    F:Date,                 //日期
    G:Function,             //函数
    H:Symbol                //符号
},
```
#### 多个可能的类型
```html
props:{
    info:[String,Number],
},
```
#### 必填项校验
```html
props:{
    info:{
        type:String,
        required:true
    }
},
```
#### 属性默认值
```html
props:{
    info:{
        type:String,
        required:true,
        default:100
    },
},
```
#### 自定义验证函数
```html
props:{
    msg:{
        validator(value){
            return ['success','warning','danger'].indexOf(value) !== -1
        }
    }
},
```
### 计算属性
计算属性本质上就是一个function,可以实时监听data中数据的变化,并return一个计算后的新值
1. 声明    
    计算属性要以function函数的形式声明到组件的computed选项中
    ```html
    <template>
        <h2>计算属性</h2>
        <input type="text" v-model.number="count">
        <p>计算:{{double}}</p>    
    </template>
    <script>
    export default {
        data(){
            return {
                count:0
            }
        },
        computed:{
            double(){
                return this.count * 2
            }
        }
    }
    </script>
    ```

### 组件的自定义事件
为了让组件的使用者可以监听到组件内的状态变化,需要用到组件的自定义事件
1. 声明自定义事件
    ```html
    <template>
        <h3>Counter组件</h3>
        <button>+1</button>
    </template>
    <script>
    export default {
        emits:['change'],
    }
    </script>
    ```
1. 触发自定义事件    
在emits节点下声明的事件,可以通过this.$emit('事件名称')进行触发
    ```html
    <template>
        <h3>Counter组件</h3>
        <button @click="onBtnClick">+1</button>
    </template>
    <script>
    export default {
        emits:['change'],
        methods:{
            onBtnClick(){
                this.$emit('change')
            }
        }
    }
    </script>
    ```
1. 监听自定义事件    
通过v-on监听自定义事件
    ```html
    <my-count @change="getCountChange"></my-count> </template>
    <script>
    export default {
        ...
        methods:{
            getCountChange(){
                this.count ++
                console.log("Count:getCountChange")
            }
        },
        ...
    }
    </script>
    ```
1. 自定义事件传参
    1. 传递参数
    ```html
    <script>
    export default {
        ...
        methods:{
            onBtnClick(){
                this.$emit('change',this.name)
            }
        ...
    }
    </script>
    ```
    1. 接收参数



### 组件的v-model
#### 传递参数到子组件
1. 父组件通过v-bind属性绑定,把数据传递给子组件
    ```html
    <!-- app.vue -->
    <my-count :count="count"> </my-count>
    ```
1. 子组件,通过props接收父组件传递的数据
    ```html
    <!-- MyCount.vue -->
    <template>
        <h2>MyCounter:{{count}}</h2>
        <button @click="onBtnClick">MyCount ++</button>
    </template>
    <script>
    export default{
        ...
        props:['count'],
    }
    </script>
    ```
#### 子组件数据同步到父组件
1. 在v-bind指令前绑定v-model指令
    ```html
    <!-- app.vue -->
    <my-count v-model:count="count" @tt="tt"> </my-count>
    ```
1. 在子组件中自定义事件,格式为update:props的值
    ```html
    <!-- MyCount.vue -->
    <script>
    export default{
        ...
        props:['count'],
        emits:['update:count'],
    }
    </script>
    ```
1. 触发自定义事件,更新你组件的数据
    ```html
    <!-- MyCount.vue -->
    <template>
        <h2>MyCounter:{{count}}</h2>
        <button @click="onBtnClick">MyCount ++</button>
    </template>
    <script>
    export default{
        ...
        props:['count'],
        emits:['update:count'],
        methods:{
            onBtnClick(){
                this.$emit('update:count',this.count +1)
            }
        }
    }
    </script>
    ```

## 组件案例
### 初始化项目
    1. 创建初始化项目
        1. 创建项目
            ```shell
            npm init vite-app todoDemo
            ```
        1. 安装基础依赖包
            ```shell
            cd todoDemo
            npm install
            ```
        1. 安装所需依赖包
            ```shell
            npm i less -D
            ```
    1. 初始化样式及布局
        1. 全局样式
            ```html
            <!-- index.css -->
            :root{
                font-size: 12px;
            }
            body{
                padding: 8px;
            }
            ```
        1. App.vue
            ```html
            <!-- app.vue -->
            <template>
                <div>
                    <h1>App根组件</h1>
                </div>
            </template>
            <script>
            export default {
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
                    }
                },
            }
            </script>
            <style lang="less" scoped>
            </style>
            ```

### 封装组件

#### todo-list
- 创建注册组件
    1. 创建目录及文件
        ```shell
        mkdir src/components/todo-list
        ```
        ```html
        <!-- TodoList.vue -->
        <template>
            <div>TodoList组件</div>
        </template>
        <script>
        export default {
            name:"TodoList",
        }
        </script>
        <style lang="less" scoped>
        </style>
        ```
    1. 导入组件
        ```html
        <!-- App.vue -->
        <script>
        import TodoList from './components/todo-list/TodoList.vue'
        export default {
            name: 'AppRoot',
            components:{TodoList},
            ...
        }
        </script>
        ```
- 基于bootstrap渲染
    1. 安装bootstrap插件
        ```shell
        npm i bootstrap -S
        ```
    1. 引用bootstrap
        ```html
        <!-- main.js -->
        import 'bootstrap/dist/css/bootstrap.css'
        import 'bootstrap/dist/js/bootstrap.js'
        ```
    1. 基础布局
        ```html
        <template>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Default checkbox
                </label>
            </div>
                <span class="badge bg-primary rounded-pill">完成</span>
                <span class="badge bg-warning rounded-pill">未完成</span>
            </li>
        </ul>
        </template>
        ```
- 声名props
    ```html
    <script>
    export default {
        name:"TodoList",
        props:{
            list:{
                type:Array,
                required:true,
                default:[]
            }
        }
    }
    </script>
    ```
- 绑定子组件数据
    ```html
    <todo-list :list="todolist"></todo-list>
    ```
- 渲染列表DOM结构
    1. 循环li
        ```html
        <li class="list-group-item d-flex justify-content-between align-items-center" v-for="item in list" :key="item.id">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" :id="'todo-'+item.id" >
                <label class="form-check-label" :for="'todo-'+item.id">
                    {{item.task}}
                </label>
            </div>
            <span class="badge bg-success rounded-pill" v-if="item.done">完成</span>
            <span class="badge bg-warning rounded-pill" v-else>未完成</span>
        </li>
        ```
    1. 绑定checkbox状态
        ```html
        <input class="form-check-input" type="checkbox" value="" :id="'todo-'+item.id" v-model="item.done">
        ```
    1. 修改完成样式
        ```html
        <label class="form-check-label" :class="item.done?'delete':''" :for="'todo-'+item.id">
        ...
        <style lang="less" scoped>
        label.delete{
            text-decoration: line-through;
            color:gray;
            font-style: italic;
        }
        </style>
        ```

#### todo-input
1. 创建注册组件
    1. 创建组件
        ```shell
        mkdir components/todo-input
        vim components/todo-input/TodoInput.vue
        ```
        ```html
        <template>
            <h2>TodoInput</h2>
        </template>
        <script>
        export default {
            name:"TodoInput",
        }
        </script>
        <style lang="less" scoped>
        </style>
        ```
    1. 注册导入组件
        ```html
        import TodoList from  './components/todo-list/TodoList.vue'
        export default {
            components: { 
                ...
                TodoInput,
            },
        }
        ```
1. 渲染组件结构
    ```html
    <template>
    <form class="row row-cols-lg-auto g-3 align-items-center">
        <div class="input-group mb-2 mt-4">
            <div class="input-group-text">任务</div>
            <input type="text" class="form-control" mr-sm-5 placeholder="任务信息">
            <button type="submit" class="btn btn-primary">添加新任务</button>
        </div>
    </form>
    </template>
    ```
1. 自定义事件
    1. 添加任务消息数据
        ```html
        data(){
            return {
                taskname:'',
            }
        }
        ```
    1. 绑定数据
        ```html
        <input type="text" class="form-control" mr-sm-5 placeholder="任务信息" v-model.trim="taskname">
        ```
    1. 阻止submit事件,并指定处理函数
        ```html
        <form class="row row-cols-lg-auto g-3 align-items-center" @submit.prevent="FmSubmit">
        ...
        ```
    1. 声明自定义事件
        ```html
        methods:{
            FmSubmit(){
                if(this.taskname == '') return alert('不能为空')
                this.$emit('addTask',this.taskname)
                this.taskname=''
            },
        }
        ```
1. 实现添加任务功能
    1. 监听组件addTask自定义事件
        ```html
        <todo-input @addTask="addTask"></todo-input>
        ```
    1. 添加新任务
        ```html
        methods:{
            addTask(taskName){
                const task = {
                    id:this.todolist.length+1,
                    task:taskName,
                    done:false
                }
                this.todolist.push(task)
            }
        }
        ```

#### todo-button
1. 创建并注册组件
    ```html
    <!-- /components/todo-button/TodoButton.vue -->
    <template>
        <h3>TodoButton</h3>
    </template>
    <script>
    export default {
        name:"TodoButton",
    }
    </script>
    <style lang="less" scoped>
    </style>
    ```
    ```html
    <!-- App.vue -->
    ...
    import TodoButton from './components/todo-button/TodoButton.vue'
    export default {
        components: { 
            TodoList,
            TodoInput,
            TodoButton,
        },
    }
    ```
1. 渲染组件结构
    ```html
    <template>
        <div class="btn-group mt-2 col-12" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="btn" :class="flag == 'all' ? 'btn-primary' : 'btn-secondary'">全部</button>
            <button type="button" class="btn" :class="flag == 'done' ? 'btn-success' : 'btn-secondary'">已完成</button>
            <button type="button" class="btn" :class="flag == 'undo' ? 'btn-warning' : 'btn-secondary'">未完成</button>
        </div>
    </template>
    ```
1. 传递子组件选项卡默认值
    ```html
    props:{
        flag:{
            type:String,
            required:true,
            default:"all"
        }
    },
    ```
1. 更新选项卡索引
    1. 为按钮添加click事件
        ```html
        <template>
            <div class="btn-group mt-2 col-12" role="group" aria-label="Basic mixed styles example">
                <button type="button" class="btn" :class="flag == 'all' ? 'btn-primary' : 'btn-secondary'" @click="changeFlag('all')">全部</button>
                <button type="button" class="btn" :class="flag == 'done' ? 'btn-success' : 'btn-secondary'" @click="changeFlag('done')">已完成</button>
                <button type="button" class="btn" :class="flag == 'undo' ? 'btn-warning' : 'btn-secondary'" @click="changeFlag('undo')">未完成</button>
            </div>
        </template>
        ```
    1. 添加自定义事件,传参给父组件
        ```html
        <script>
        export default {
            ...
            emits:['update:flag'],
            methods:{
                changeFlag(val){
                    if(val === this.flag) return
                    this.$emit('update:flag',val)
                }
            }
        }
        </script>
        ```
    1. 父组件绑定接收子组件传参
        ```html
        <todo-button v-model:flag="flag"></todo-button>
        ```
1. 通过计算属性更新列表
    ```html
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
    ```

##  组件高级

### watch侦听器
watch侦听器允许开发者监视神气的变化,针对数据的变化做特定的操作
#### 基本语法
```html
<script>
export default {
  name: 'App',
  components: {
  },
    data(){
        return {
            username:'',
        }
    },
    watch:{
        username(newval,oldval){
            console.log(newval,oldval)
        }
    }
}
</script>
```
#### 示例
使用sxios发起ajax请求,检测用户名是否可用    
1. 安装axios组伯
    ```shell
    npm i axios -S
    ```
1. 导入组件
    ```html
    import axios from 'axios'
    ```
1. 发起请求
    ```html
    watch:{
        async username(newval){
            const {data:res} = await axios.get('https://applet-base-api-t.itheima.net/api/get/')
            console.log(res)
        }
    }
    ```
#### immediate选项
默认情况下,加载完毕不会调用watch侦听器,使用immediate选项,可以立即调用侦听器
    ```html
    watch:{
        username:{
            async handler(newval){
                const {data:res} = await axios.get('https://applet-base-api-t.itheima.net/api')
                console.log(res)
            },
            immediate:true
        }
    }
    ```
#### deep选项
当watch侦听的是一个对象,如果对象中的属性值发生变化,无法被监听到.此时需要使用deep选项
1. 对象属性无法被侦听
    ```html
    <template>
        <input type="text" v-model="info.username">
    </template>
    <script>
    import axios from 'axios'
    export default {
        ...
        data(){
            return {
                info:{
                    username:'zs'
                }

            }
        },
        watch:{
            info:{
                async handler(val){
                    const {data:res} = await axios.get('https://applet-base-api-t.itheima.net/api')
                    console.log(res)
                }
            }
        }
    }
    </script>
    ```
1. 添加deep选项
    ```html
    watch:{
        info:{
            async handler(val){
                const {data:res} = await axios.get('https://applet-base-api-t.itheima.net/api/get')
                console.log(res)
            },
            deep:true
        }
    }
    ```
1. 监听单个属性
    ```html
    watch:{
        'info.username':{
            async handler(val){
                const {data:res} = await axios.get('https://applet-base-api-t.itheima.net/api/get')
                console.log(res)
            },
        }
    }
    ```
#### 计算属性和侦听器的区别
> 计算属性侧重于监听多个值的变化,最终计算并返回一个新值    
> 侦听器侧重于监听单个数据的变化,最终执行特定的业务处理,不需要有任何返回值

### 组件的生命周期
#### created
#### mounted
#### unmounted
#### before
    - beforeCreate
    - beforeMount
    - beforeUnmount
### 组件之间的数据共享
#### 组件之间的关系
在项目开发中,组件之间的三种关系
- 父子关系
- 兄弟关系
- 后代关系
#### 父子组件之间的数据共享
1. 父->子    
    ```html
    <!-- 父组件 -->
    <my-test :msg="message"></my-test>
    ...
    data(){
        return {
            message:"hello world"
        }
    }
    ```
    ```html
    <!-- 子组件 -->
    <template>
        <h3>{{msg}}</h3>
    </template>

    ...
    <script>
    export default{
        props:['msg'],
    }
    ```
1. 子->父
    ```html
    <!-- 子组件 -->
    <template>
        <button @click="btnClick('hi')">传递</button>
    </template>
    <script>
    export default{
        emits:['onValChange'],
        methods:{
            btnClick(val){
                this.emit('onValChange',val)
            }
        }
    }
    ```
    ```html
    <!-- 父组件 -->
    <template>
        <h1>Son:{{val}}</h1>
        <my-son @onValChange="(val)=>{this.val = val}"></my-son>
    </template>
    ...
    data(){
        return {
            val:''
        }
    }
    ```
1. 父子双向同步    
    ```html
    <!-- 父组件 -->
    <template>
        <h1>Son:{{val}}</h1>
        <my-son v-model:son-val="val"></my-son>
    </template>
    ...
    data(){
        return {
            val:''
        }
    }
    ```
    ```html
    <!-- 子组件 -->
    <template>
      <button @click="btnClick('Son')">Click</button>
      <h2>Son:{{sonVal}}</h2>
    </template>
    <script>
    export default {
        props:['sonVal'],
        emits:['update:sonVal'],
        methods:{
            btnClick(val){
                this.$emit('update:sonVal',val)
            }
        }
    }
    </script>
    ```
#### 兄弟组件之间的数据共享
兄弟组件之间可以用EventBus实现.可以借助于第三方的包mitt来创建eventBus对象
1. 安装mitt包
    ```shell
    npm i mitt -S
    ```
1. 导入EventBus对象
    ```javascript
    <!-- eventBus.js -->
    //导入mitt包
    import mitt from "mitt"
    //创建实例对象
    const bus = mitt()
    //导出实例化的对象
    export default bus
    ```
1. 接收数据
    ```html
    <template>
        <div class="com2">
            <h3>接收方:{{num}}</h3>
            <button>+1</button>
        </div>
    </template>
    <script>
    import bus from '..eventBus'
    export default {
        name:'component02',
        data(){
            return{
                num:0
            }
        },
        created(){
            bus.on('countChange',()=>{
                this.num = count
            })
        }

    }
    </script>
    ```
1. 发送数据
    ```html
    <template>
        <div class="com1">
            <h3>发送方:{{count}}</h3>
            <button @click="com01_add">+1</button>
        </div>
    </template>

    <script>
    import bus from '../eventBus.js'
    export default {
        name:"component01",
        data(){
            return{
                count:0,
            }
        },
        methods:{
            com01_add(){
                this.count ++
                bus.emit('countChange',this.count)
            }
        },
    }
    </script>
    ```
1. 数据互通
    ```html
    <template>
        <div class="com1">
            <h3>发送方:{{count}}</h3>
            <button @click="com01_add">+1</button>
        </div>
    </template>

    <script>
    import bus from '../eventBus.js'
    export default {
        name:"component01",
        data(){
            return{
                count:0,
            }
        },
        methods:{
            com01_add(){
                this.count ++
                bus.emit('countChange',this.count)
            }
        },
        created(){
            bus.on('com2_num_change',(num)=>{
                this.count = num
            })
        }
    }
    </script>
    ```

#### 后代关系之间的数据共享
在父节点向子孙节点组件共享数据时,由于嵌套关系复杂,可以使用provide和inject实现后代关系组件的数据共享
1. 父组件通过provide共享数据
    ```html
    <script>
    import Component01 from './components/Component01.vue'
    export default {
      name: 'App',
      components: {
        Component01,
      },
        data(){
            return {
                color:'red'
            }
        },
        provide(){
            return{
                color:this.color
            }
        },
    }
    ```
1. 子孙节点通过inject接收数据
    ```html
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
    ```
#### 父节点对外共享响应式数据
默认情况,provide出去的数据,不是响应式的.可以通过computed函数对外共享响应数据
### 全局配置axios
#### 为什么要全局配置
- 每个组件都需要导入axios,代码臃肿
- 每次请求都需要填写完整的请求路径,不得后期维护
#### 全局配置
1. 在main.js入口文件中,通过app.config.globalProperties全局挂载axios
    ```javascript
    //配置请求根路径
    baseurl = ''
    axois.defaults.baseURL = baseurl
    //将axios挂载为app的全局自定义属性$http
    app.config.globalProperties.$http = axios
    ```
1. 发起请求
    ```html
    <script>
    export default {
        name:'GetInfo',
        methods:{
            async getInfo(){
                const {data:res} = await this.$http('/api/get',{
                    params:{
                        name:'ls',
                        age:33
                    }
                })
            }
        }
    }
    </script>
    ```
### 购物车案例
#### 初始化项目
1. 初始化vite项目
    ```shell
    npm init vite-app cart
    cd cart 
    npm install
    ```
1. 安装bootstrap插件
    ```shell
    npm i bootstrap -S
    ```
1. 引用bootstrap
    ```html
    <!-- main.js -->
    import 'bootstrap/dist/css/bootstrap.css'
    import 'bootstrap/dist/js/bootstrap.js'
    ...
    const vm = createApp(App)
    vm.mount('#app')
    ```
1. 清理项目结构
    - 清空App.vue
    - 删除comonets目录下的HelloWorld.vue
1. 安装less插件
    ```shell
    npm i less -D
    ```
1. 初始化index.css全局样式
    ```css
    :root{
        font-size: 12px;
    }
    ```
#### 封装Header组件
1. 创建组件
    ```html
    <!-- EsHeader.vue -->
    <template>
        <div :style="style" class='esheader'>
            <h2>{{estitle}}</h2>
        </div>
    </template>
    <script>
    export default {
        name:'EsHeader',
        data(){
            return{
                style:{
                    'backgroundColor':this.bgcolor,
                    'color':this.color,
                    'fontSize':this.fsize
                }
            }
        },
        props:{
            estitle:{
                type:String,
                default:'es-header'
            },
            bgcolor:{
                type:String,
                default:'#0099ff'
            },
            color:{
                type:String,
                default:'#ffffff'
            },
            fsize:{
                type:Number,
                default:12
            },
        },
        created(){
        }
    }
    </script>
    <style lang="less" scoped>
    .esheader{
        position: fixed;
        top: 0;
        left: 0;
        width:100%;
        height:48px;
        text-align: center;
        line-height: 48px;
        z-index: 999;
        h2{
            line-height:48px;
        }
    }
    </style>
    ```
1. 导入组件
    ```html
    <!-- App.vue -->
    <template>
        <h1>Root组件</h1>
        <es-header></es-header>
    </template>
    <script>
    import EsHeader from "./components/EsHeader.vue"
    export default {
      name: 'CartRoot',
      components: {
        EsHeader
      }
    }
    </script>
    ```
#### 基于axios请求商品数据
1. 全局配置axios模块
    1. 安装axios模块
        ```shell
        npm i axios -S
        ```
    1. 导入并配置
        ```javascript
        <!-- main.js -->
        import axios from 'axios'
        axios.defaults.baseURL = 'https://applet-base-api-t.itheima.net'
        const vm = createApp(App)
        vm.config.globalProperties.$http = axios
        vm.mount('#app')
        ```
1. 请求商品数据
    1. 新建getGoodsList方法
        ```html
        <!-- App.vue -->
        <script>
        methods:{
            async getGoodsList(){
                const {data:res} = await this.$http.get('/api/cart')
                if (res.status !=200) return alert('请求商品列表数据失败')
                this.googslist = res.list
            }
        }
        </script>
        ```
    1. 在created同期,调用getGoodsList方法
        ```html
        <!-- App.vue -->
        <script>
        export default{
            ...
            data(){
                return {
                    goodsList:[],
                }
            },
            created(){
                this.getGoodsList()
            }
        }
        </script>
        ```

#### 封装Footer组件
1. 创建组件
1. 导入注册组件
    ```html
    <template>
       ... 
       <es-footer></es-footer>
    </template>
    <script>
    ...
    import EsHeader from "./components/EsFooter.vue"
    export default {
      name: 'CartRoot',
      components: {
        EsHeader,
        EsFooter
      }
    }
    </script>
    ```
1. 接收父组件传递的参数
    1. 声明自定义属性
        ```html
        <script>
        export default {
            name:'EsFooter',
            props:{
                total:{
                    type:Number,
                    default:0
                },
                amount:{
                    type:Number,
                    default:0
                },
                isfull:{
                    type:Boolean,
                    default:false
                }
            }
        }
        </script>
        ```
    1. 渲染
        ```html
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="fullCheck" :checked="isfull">
            <label class="form-check-label" for="fullCheck">
                全选
            </label>
        </div>
        <div class="amount-container">
            <span>合计:</span>
            <span class="amount"> ￥{{amount.toFixed(2)}}元</span>
        </div>
        <button type="button" class="btn btn-primary btn-buy">结算({{total}})</button>
        ```
1. 自定义事件,监听全选按钮状态
    1. 声明自定义事件
        ```html
        emits:['fullChange'],
        ```
    1. 创建方法,触发自定义事件
        ```html
        <template>
            ...
            <input class="form-check-input" type="checkbox" value="" id="fullCheck" :checked="isfull" @change="fullCheckChange">
        </template>
        <script>
        methods:{
            fullCheckChange(){
                this.$emit('fullChange',e.target.checked)
            }
        }
        </script>
        ```
    1. App组件接收全选状态
        ```html
        <es-footer @fullChange="fullCheckChange"></es-footer>
        <script>
        methods:{
            fullCheckChange(val){
                console.log(val)
            }
        }
        </script>
        ```
#### 封装Goods组件
1. 创建EsGoods组件
    ```html
    <template>
        <div class="goods-container">
            <div class="left">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" :id="'goods-'+goods.goods_id">
                    <label class="form-check-label" :for="'goods-'+goods.goods_id">
                        <img :src="goods.goods_img" alt="" class="thumb">
                    </label>
                </div>
            </div>
            <div class="right">
                <div class="top">{{goods.goods_name}}</div>
                <div class="bottom">
                    <div class="price">￥{{goods.goods_price.toFixed(2)}}</div>
                    <div class="count">数量:{{goods.goods_count}}</div>
                </div>
            </div>
        </div>
    </template>
    <script>
    export default {
        name:'EsGoods',
        props:['goods'],
    }
    </script>
    <style lang="less" scoped>
    .goods-container{
        border-top: 1px solid #efefef;
        display: flex;
        padding-bottom: 10px;
        .left{
            margin-right: 10px;
            .form-check{
                .form-check-input{
                    margin-top: 43px;
                }
                .form-check-label{
                    .thumb{
                        display: block;
                        width:100px;
                        height:100px;
                        background-color: #efefef;
                    }
                }
            }
        }
        .right{
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex:1;
            .top{
                font-weight: bold;
            }
            .bottom{
                display: flex;
                justify-content: space-between;
                align-content: center;
                .price{
                    color:red;
                    font-weight: bold;
                }
            }
        }
    }
    </style>
    ```
1. 导入注册组件
    ```html
    <div class="goods-list" v-for="goods in goodsList" :key="goods.goods_id">
        <es-goods :goods="goods" :id="goods.goods_id"></es-goods>
    </div>

    ```
1. 封装自定义事件
    ```html
    <template>
        ...
        <input class="form-check-input" type="checkbox" value="" :id="'goods-'+goods.goods_id" :checked="goods.goods_state" @change="onInputChecked">
    </template>
    <script>
        ...
        emits:['goodsStateChange'],
        methods:{
            onInputChecked(){
                this.$emit('goodsStateChange',{id:this.goods.goods_id,state:e.target.checked})
            }
        }
    </script>
    ```
1. 父组件接收EsGoods组件商品状态
    ```html
    <template>
        ...
        <es-goods :goods="goods" :id="goods.goods_id" @goodsStateChange="onGoodsStateChange"></es-goods>
    </template>
    <script>
        methods:{
            onGoodsStateChange(e){
                const goods = this.goodsList.find(item => item.goods_id === e.id)
                if(goods){
                    goods.goods_state = e.state
                }
            }
        }
    </script>
    ```
1. 父组件根据商品状态生成计算属性
    ```html
    <script>
        computed:{
            amount(){
                let amount= 0
                this.goodsList
                    .filter(x => x.goods_state)
                    .forEach(x => {
                    amount += x.goods_price * x.goods_count
                })
                return amount
            },
            total(){
                let total = 0
                this.goodsList.filter(goods => goods.goods_state).forEach(goods => {
                    //console.log(goods)
                    total += goods.goods_count
                })
                return total
            },
            isfull(){
                if(this.goodsList.filter(goods => !goods.goods_state).length > 0){
                    return false
                }else{
                    return true
                }
            }
        }
    </script>
    ```
#### 封装Counter组件
1. 创建组件
    ```html
    <template>
        <div class="input-group counter-container">
            <button type="button" class="btn btn-secondary" @click="onSubClick">-</button>
            <input type="number" class="form-control text-number"  v-model.number="num" >
            <button type="button" class="btn btn-secondary" @click="onAddClick">+</button>
        </div>
    </template>
    <script>
    export default {
        name:"EsCounter",
        data(){
            return{
                num:this.number
            }
        },
        props:{
            number:{
                type:Number,
                default:0
            }
        },
        emits:[
            'goodsNumChange'
        ],
        watch:{
            num( newV,oldV){
                let parseVal = parseInt(newV)
                if(isNaN(parseVal) || parseVal < 0){
                    this.num = 0
                    return
                }
                if(isNaN(parseVal) || parseVal >999){
                    this.num = 999
                    return
                }
                this.num = parseVal
                this.$emit('goodsNumChange',this.num)
            }
        },
        methods:{
            onSubClick(){
                if(this.num > 0){
                    this.num --
                }
            },
            onAddClick(){
                if(this.num < 999) this.num ++
            },
        }
    }
    </script>
    <style lang="less" scoped>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button { 
        -webkit-appearance: none; 
    }
    /* 火狐浏览器 */
    input[type="number"]{ 
        -moz-appearance: textfield; 
    }
    .counter-container{
        button{
            width:35px;
        }
        .text-number{
            min-width: 35px;
            width: 40px;
            text-align: center;
            font-style: 12px;
            padding: 5px;
        }
    }
    </style>
    ```
1. 注册导入
    ```html
    <!-- EsGoods.vue -->
    <div class="count">
        <es-counter :number="goods.goods_count" @goodsNumChange="onGoodsNumChange"></es-counter>
    </div>
    ...
    <script>
    export default {
        name:"EsGoods",
        components: { EsCounter },
        emits:['goodsStateChange'],
        methods:{
            onInputChecked(e){
                const goodsTemp = this.goods
                goodsTemp.goods_state = e.target.checked
                //this.$emit('goodsStateChange',{id:this.goods.goods_id,state:e.target.checked})
                this.$emit('goodsStateChange',goodsTemp)
            },
            onGoodsNumChange(e){
                const goodsTemp = this.goods
                goodsTemp.goods_count = e
                this.$emit('goodsStateChange',goodsTemp)
            }
        }
    }
    </script>
    ```
1. 向上传值
    1. 传递值给EsGoods
        ```html
        emits:[
            'goodsNumChange'
        ],
        watch:{
            num( newV){
                let parseVal = parseInt(newV)
                if(isNaN(parseVal) || parseVal < 0){
                    this.num = 0
                    return
                }
                if(isNaN(parseVal) || parseVal >999){
                    this.num = 999
                    return
                }
                this.num = parseVal
                this.$emit('goodsNumChange',this.num)
            }
        },
        ```
