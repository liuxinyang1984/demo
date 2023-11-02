import { createApp } from 'vue'
// import App from './App.vue'
import App from './http.vue'
import './index.css'
import axios from 'axios'

const vm = createApp(App)
const baseurl = 'https://applet-base-api-t.itheima.net' 


axios.defaults.baseURL = baseurl
vm.config.globalProperties.$http = axios
vm.mount('#app')
