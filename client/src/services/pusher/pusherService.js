import Pusher from 'pusher-js';

const config = {
    authEndpoint: process.env.VUE_APP_PUSHER_APP_AUTH_ENDPOINT,
    cluster: process.env.VUE_APP_PUSHER_APP_CLUSTER,
    forceTLS: true,
    auth: {
        headers: {}
    }
};
if (localStorage.getItem('auth.accessToken')) {
    config.auth.headers = {
        Authorization: `Bearer ${localStorage.getItem('auth.accessToken')}`
    }
}

export const pusher = new Pusher(process.env.VUE_APP_PUSHER_APP_KEY, config);

export const updateSocketAuthToken = (accessToken) => {
    pusher.config.auth.headers.Authorization =
        `Bearer ${accessToken}`;
};

export const removeSocketAuthToken = () => {
    pusher.config.auth.headers = {};
}