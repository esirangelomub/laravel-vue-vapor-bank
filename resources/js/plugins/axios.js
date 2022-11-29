import axios from 'axios'

const axiosInstance = axios.create({
    baseURL: 'api/v1/',
    headers: {
        "Content-type": "application/json",
        "Access-Control-Allow-Origin": "*",
        "Authorization": 'Bearer ' + localStorage.getItem('access_token')
    },
})

export default axiosInstance;
