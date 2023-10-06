import { createApp } from 'vue'
import App from './App.vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.js'
import './index.css'

import Header from './components/Header.vue'
const vm=createApp(App)
vm.component('MyHeader',Header)
vm.mount('#app')

