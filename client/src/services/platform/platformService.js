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
    async moveInTrashByIds(ids) {
        return await requestInternalService.put(API_PREFIX + '/trash-in', ids);
    },
    async moveFromTrashByIds(ids) {
        return await requestInternalService.put(API_PREFIX + '/trash-from', ids);
    },
    async fetchPlatformsInTrash(params = {}) {
        const response = await requestInternalService.get(API_PREFIX + '/trash', params);
        return response?.data;
    }
};

export default platformService;