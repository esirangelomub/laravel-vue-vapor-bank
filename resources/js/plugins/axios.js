import axios from 'axios'
const baseURL = import.meta.env.VITE_BASE_API;

const axiosInstance = axios.create({
    baseURL: baseURL,
    headers: {
        "Content-type": "application/json",
        "Access-Control-Allow-Origin": "*",
        "Authorization": 'Bearer ' + localStorage.getItem('access_token')
    },
})

export default axiosInstance;
