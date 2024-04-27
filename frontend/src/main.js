import { createApp } from 'vue'
import App from './App.vue'
import axios from "axios";
import {createBootstrap} from 'bootstrap-vue-next'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-next/dist/bootstrap-vue-next.css'

const axiosInstance = axios.create({
    baseURL: 'http://localhost:8000',
});
let app = createApp(App);
app.use(createBootstrap({components: true, directives: true}))
app.config.globalProperties.$axios = axiosInstance;

app.mount('#app')
