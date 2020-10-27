import requestInternalService from '@/services/requestInternalService';

const API_PREFIX = '/filters';

export default {
    async saveUserFilter(filterData) {
        return await requestInternalService.post(API_PREFIX, filterData);
    }
};