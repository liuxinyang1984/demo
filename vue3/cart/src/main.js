import { createApp } from 'vue'
import App from './App.vue'
import './index.css'

//bootstrap
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.js'

//axios
import axios from 'axios'
axios.defaults.baseURL = 'https://applet-base-api-t.itheima.net'

const vm = createApp(App)
vm.config.globalProperties.$http = axios
vm.mount('#app')
