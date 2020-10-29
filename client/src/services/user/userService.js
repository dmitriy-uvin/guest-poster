import requestInternalService from '@/services/requestInternalService';

const API_PREFIX = '/users';

export default {
    async getAllUsers(params) {
        const response = await requestInternalService.get(API_PREFIX, params);
        return response?.data;
    },
    async getUserById(id) {
        const response = await requestInternalService.get(API_PREFIX + '/' + id);
        return response?.data?.data;
    },
    async deleteUserById(id) {
        return await requestInternalService.delete(API_PREFIX + '/' + id);
    },
    async changeUserBlockStatusById(data) {
        return await requestInternalService.put(API_PREFIX + '/' + data.id + '/block', data);
    }
}