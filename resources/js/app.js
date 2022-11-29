import {createApp} from 'vue';
import App from "./App.vue";

import router from "./router";
import vuetify from "./plugins/vuetify";
import axiosInstance from "./plugins/axios";

const app = createApp(App)

// AXIOS
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

app.use(router).use(vuetify).mount("#app");


