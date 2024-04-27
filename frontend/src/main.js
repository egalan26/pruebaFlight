import { createApp } from 'vue'
import App from './App.vue'
import axios from "axios";


const axiosInstance = axios.create({
    baseURL: 'http://localhost:8000',
});
let app = createApp(App);
app.config.globalProperties.$axios = axiosInstance;

app.mount('#app')
