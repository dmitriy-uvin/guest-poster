import * as actions from './types/actions';
import * as mutations from './types/mutations';
import platformService from '@/services/platform/platformService';

export default {
    [actions.CREATE_PLATFORM]: async ({ commit }, platformData) => {
        const response = await platformService.createPlatform(platformData);
        commit(mutations.SET_PLATFORM, response);
    },
    [actions.FETCH_PLATFORMS]: async ({ commit }, params = {}) => {
        const response = await platformService.fetchPlatforms(params);
        const platforms = response?.data;
        const metaData = response?.meta;
        commit(mutations.SET_PLATFORMS, platforms);
        return Promise.resolve(metaData);
    }
}