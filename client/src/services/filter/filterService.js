import requestInternalService from '@/services/requestInternalService';

const API_PREFIX = '/filters';

export default {
    async saveUserFilter(filterData) {
        const response = await requestInternalService.post(API_PREFIX, filterData);
        return response?.data?.data;
    },
    async getUserFilters() {
        const response = await requestInternalService.get(API_PREFIX);
        return response?.data?.data;
    },
    async deleteUserFilterById(id) {
        return await requestInternalService.delete(API_PREFIX + '/' + id);
    },
    async renameUserFilterById(data) {
        return await requestInternalService.put(API_PREFIX + '/' + data.id + '/name', {
            name: data.name
        });
    }
};