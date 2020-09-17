import requestService from '@/services/requestService';

const API_PREFIX = '/platforms';

const platformService = {
    async createPlatform(platformData) {
        const response = await requestService.post(API_PREFIX + '/store', platformData);
        return response?.data?.data;
    },
    async fetchPlatforms() {
        const response = await requestService.get(API_PREFIX,);
        return response?.data;
    }
};

export default platformService;