import { createApp } from 'vue'
import App from './App.vue'
import { Vue3TreeOrg } from 'vue3-tree-org'
import "vue3-tree-org/lib/vue3-tree-org.css";

//createApp(App).mount('#app')
const app = createApp(App)
app.use(Vue3TreeOrg)
app.mount('#app')
