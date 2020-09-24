import requestInternalService from '@/services/requestInternalService';

const API_PREFIX = '/platforms';

const platformService = {
    async createPlatform(platformData) {
        const response = await requestInternalService.post(API_PREFIX + '/store', platformData);
        return response?.data?.data;
    },
    async fetchPlatforms(params = {}) {
        const response = await requestInternalService.get(API_PREFIX, params);
        return response?.data;
    },
};

export default platformService;