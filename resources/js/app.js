import {createApp} from 'vue';
import App from "./App.vue";

import router from "./router";
import vuetify from "./plugins/vuetify";
import axiosInstance from "./plugins/axios";
import VueUploadComponent from 'vue-upload-component'
import money from 'v-money'
import VueTheMask from 'vue-the-mask'

const app = createApp(App)

// AXIOS
axiosInstance.interceptors.request.use(config => {
    config.headers.Authorization = 'Bearer ' + localStorage.getItem('access_token');
    return config;
})
app.config.globalProperties.$axios = { ...axiosInstance }

// GLOBAL DIRECTIVES
app.config.globalProperties.$filters = {
    currency(value) {
        return '$' + value.toLocaleString()
    },
    formatDate(dateString) {
        const date = new Date(dateString);
        return new Intl.DateTimeFormat('default', {dateStyle: 'long'}).format(date);
    }
}

// FILE UPLOAD PLUGIN
app.component('file-upload', VueUploadComponent)

// MASK PLUGIN
app.use(money, {precision: 2})
app.use(VueTheMask)

app.use(router).use(vuetify).mount("#app");


