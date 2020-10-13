import requestInternalService from '@/services/requestInternalService';

const API_PREFIX = '/platforms';

const platformService = {
    async createPlatform(platformData) {
        const response = await requestInternalService.post(API_PREFIX, platformData);
        return response?.data?.data;
    },
    async fetchPlatforms(params = {}) {
        const response = await requestInternalService.get(API_PREFIX, params);
        return response?.data;
    },
    async fetchTopics() {
        const response = await requestInternalService.get('/topics');
        return response?.data?.data;
    },
    async deletePlatformById(id) {
        return await requestInternalService.delete(API_PREFIX + '/' + id);
    },
    async moveInBucketById(id) {
        return await requestInternalService.put(API_PREFIX + '/' + id + '/bucket-in');
    },
    async moveFromBucketById(id) {
        return await requestInternalService.put(API_PREFIX + '/' + id + '/bucket-from');
    }
};

export default platformService;