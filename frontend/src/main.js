import { createApp } from 'vue'
import App from './App.vue'
import axios from "axios";
import {createBootstrap} from 'bootstrap-vue-next'
import VueDatePicker from '@vuepic/vue-datepicker';

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-next/dist/bootstrap-vue-next.css'
import '@vuepic/vue-datepicker/dist/main.css'


const axiosInstance = axios.create({
    baseURL: 'http://localhost:80',
});
let app = createApp(App);
app.use(createBootstrap({components: true, directives: true}))
app.component('VueDatePicker', VueDatePicker);

app.config.globalProperties.$axios = axiosInstance;

app.mount('#app')
