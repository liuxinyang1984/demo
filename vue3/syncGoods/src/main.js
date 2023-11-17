import { createApp } from 'vue'
import App from './App.vue'
import './index.css'

//导入axios
import axios from 'axios'

axios.defaults.baseURL = "https://web.tysxls.com/test/"


const vm = createApp(App)
vm.config.globalProperties.$http = axios
vm.mount('#app')
