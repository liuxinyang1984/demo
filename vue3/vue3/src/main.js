//导入vue包的createApp函数
import { createApp } from 'vue'
//导入App组件(待渲染)
import App from './App.vue'

//导入需要全局注册的组件
import Swiper from "./components/MySwiper.vue"
import Test from "./components/MyTest.vue"
import MyStyle from "./components/MyStyle.vue"
console.log(Test.name)

import './index.css'

//调用createApp()函数,返回一个单页面应用程序的实例,用常量spa_app进行接收
const spa_app = createApp(App)

// 注册全局组件
spa_app.component('my-swiper',Swiper,MyStyle)
spa_app.component(Test.name,Test)

//调用实例方法mount(),指定vue控制区域
spa_app.mount('#app')
