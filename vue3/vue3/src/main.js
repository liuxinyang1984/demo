//导入vue包的createApp函数
import { createApp } from 'vue'
//导入App组件(待渲染)
// import App from './Header.vue'
import Cart from './Cart.vue'
import Count from './Count.vue'
import Model from './Model.vue'

//导入需要全局注册的组件
// import Swiper from "./components/MySwiper.vue"
// import MyStyle from "./components/MyStyle.vue"
import MyHeader from './components/MyHeader.vue'
import MyCount from './components/MyCount.vue'


import './index.css'

//调用createApp()函数,返回一个单页面应用程序的实例,用常量spa_app进行接收
const spa_app = createApp(Model)
// 注册全局组件
spa_app.component('MyHeader',MyHeader)
spa_app.component('MyCount',MyCount)

//调用实例方法mount(),指定vue控制区域
spa_app.mount('#app')
