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
    async moveInTrashByIds(ids) {
        return await requestInternalService.put(API_PREFIX + '/trash-in', ids);
    },
    async moveFromTrashByIds(ids) {
        return await requestInternalService.put(API_PREFIX + '/trash-from', ids);
    },
    async fetchPlatformsInTrash(params = {}) {
        const response = await requestInternalService.get(API_PREFIX + '/trash', params);
        return response?.data;
    },
    async deletePlatformsByIds(ids) {
        return await requestInternalService.delete(API_PREFIX, {
            params: {
                ids
            }
        });
    },
    async importPlatforms(data) {
        const response = await requestInternalService.post(API_PREFIX + '/import', data);
        return response;
    },
    async updatePlatformById(data) {
        const response = await requestInternalService.put(API_PREFIX + '/' + data.id, data.data);
        return response?.data?.data;
    },
    async fetchPlatformById(id) {
        const response = await requestInternalService.get(API_PREFIX + '/' + id);
        return response?.data?.data;
    }
};

export default platformService;