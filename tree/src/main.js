import { createApp } from 'vue'
import './style.css'
import App from './App.vue'

import axios from 'axios'
import { Vue3TreeOrg } from 'vue3-tree-org'
import "vue3-tree-org/lib/vue3-tree-org.css"
const baseurl = 'http://taibai.localhost/api/'
axios.defaults.baseURL=baseurl
// createApp(App).mount('#app')
const app = createApp(App)
app.use(Vue3TreeOrg)
app.config.globalProperties.$http = axios
app.mount('#app')
