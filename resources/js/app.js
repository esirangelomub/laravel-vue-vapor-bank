import {createApp} from 'vue';
import App from "./App.vue";

import router from "./router";
import vuetify from "./plugins/vuetify";
import axiosInstance from "./plugins/axios";
import VueUploadComponent from 'vue-upload-component'

const app = createApp(App)

// AXIOS
axiosInstance.interceptors.request.use(config => {
    config.headers.Authorization = 'Bearer ' + localStorage.getItem('access_token');
    console.log(config)
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

//FILE UPLOAD COMPONENT
app.component('file-upload', VueUploadComponent)

app.use(router).use(vuetify).mount("#app");


