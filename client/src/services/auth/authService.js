import requestService from '@/services/requestService';

const API_PREFIX = '/auth';

const authService = {
    setToken(token) {
        localStorage.setItem('auth.accessToken', token);
    },
    getToken() {
        return localStorage.getItem('auth.accessToken');
    },
    hasToken() {
        return !!localStorage.getItem('auth.accessToken');
    },
    removeToken() {
        localStorage.removeItem('auth.accessToken');
    },
    async signIn(userLoginData) {
        const response = await requestService.post(API_PREFIX + '/login', userLoginData);
        this.setToken(response?.data?.data?.access_token);
        return response?.data?.data;
    },
    async signUp(userRegData) {
        const response = await requestService.post(API_PREFIX + '/register', userRegData);
        return response?.data?.data;
    },
    async fetchLoggedUser() {
        const response = await requestService.get(API_PREFIX + '/me');
        return response?.data?.data;
    },
    async signOut() {
        const response = await requestService.post(API_PREFIX + '/logout');
        this.removeToken();
        return response?.data?.data;
    },
    async verifyEmail(verifyData) {
        const response = await requestService.post(API_PREFIX + '/email/verify', verifyData);
        return response?.data?.data;
    },
    async forgotPassword(userEmail) {
        const response = await requestService.post(API_PREFIX + '/forgot-password', userEmail);
        return response?.data?.data;
    },
    async resetPassword(newPasswordData) {
        const response = await requestService.post(API_PREFIX + '/reset-password', newPasswordData);
        return response?.data?.data;
    }
};

export default authService;