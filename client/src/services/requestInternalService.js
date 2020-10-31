import axios from 'axios';
import authService from '@/services/auth/authService';
import router from '@/router';
import store from '@/store';
import * as notificationActions from '@/store/modules/notification/types/actions';

const API_URL = process.env.VUE_APP_API_URL;

axios.interceptors.request.use(
    config => {
        if (authService.getToken()) {
            config.headers[
                'Authorization'
                ] = `Bearer ${authService.getToken()}`;
        }
        return config;
    },
    error => Promise.reject(error)
);

axios.interceptors.response.use(
    function (response) {
        return response;
    },
    function (error) {
        if (error.response.status === 401) {
            authService.removeToken();
            router.push({ name: 'SignIn' });
        }
        if (error.response.data.error === 'blocked' && error.response.status === 403) {
            store.dispatch('notification/' + notificationActions.SET_NOTIFICATION, {
                type: 'error',
                message: 'Your account was blocked!'
            });
            authService.removeToken();
            router.push({ name: 'SignIn' });
        }
        return Promise.reject(error.response.data.message);
    }
);

const requestInternalService = {
    get(url, params = {}, headers = {}) {
        return axios.get(API_URL + url, {
            params,
            headers
        });
    },
    post(url, body = {}, config = {}) {
        return axios.post(API_URL + url, body, config);
    },
    put(url, body = {}, config = {}) {
        return axios.put(API_URL + url, body, config);
    },
    delete(url, config = {}) {
        return axios.delete(API_URL + url, config);
    },
    async downloadFile(url, fileName, params = {}) {
        const response = await axios.get(
            API_URL + url,
            {
                params,
                responseType: 'blob'
            }
        );
        const blob = new Blob([response.data], { type: 'text/csv'});
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = fileName;
        link.click();
        URL.revokeObjectURL(link.href);
        return response;
    }
};

export default requestInternalService;
