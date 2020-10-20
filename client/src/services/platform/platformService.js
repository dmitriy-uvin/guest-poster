import requestInternalService from '@/services/requestInternalService';
import moment from 'moment';
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
    },
    async downloadImportFileTemplate() {
        await requestInternalService.downloadFile(
            API_PREFIX + '/import-file',
            'import-template.csv'
        );
    },
    async exportPlatformsAll() {
        await requestInternalService.downloadFile(
            API_PREFIX + '/export-all',
            'export-all-' + moment(moment.now()).format('DD-M-Y_' + moment.now()) + '.csv'
        );
    },
    async exportPlatformsByIds(ids) {
        await requestInternalService.downloadFile(
            API_PREFIX + '/export-by-ids?ids=' + ids,
            'export-' + moment(moment.now()).format('DD-M-Y_' + moment.now()) + '.csv'
        );
    },
    async updatePlatformsApiByIds(ids) {
        await requestInternalService.post(API_PREFIX + '/update-by-ids', ids);
    },
    async updatePlatformsApiAll() {
        await requestInternalService.post(API_PREFIX + '/update-all');
    }
};

export default platformService;