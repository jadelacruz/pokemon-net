import axios from 'axios';

const token = document.querySelector('meta[name="jwt-token"]')?.content;

if (token) {
    axios.interceptors.request.use(
        config => {

            if (token) {
                config.headers.Authorization = `Bearer ${token}`;
            }

            return config;
        },
        error => {
            return Promise.reject(error);
        }
    );
}


export default axios;
