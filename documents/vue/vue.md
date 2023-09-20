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


    

