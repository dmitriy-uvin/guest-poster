import * as actions from './types/actions';
import * as mutations from './types/mutations';
import platformService from '@/services/platform/platformService';

export default {
    [actions.CREATE_PLATFORM]: async (context , platformData) => {
        await platformService.createPlatform(platformData);
    },
    [actions.FETCH_PLATFORMS]: async ({ commit, dispatch }, params = {}) => {
        const response = await platformService.fetchPlatforms(params);
        const platforms = response?.data;
        const metaData = response?.meta;
        await dispatch(actions.FETCH_TOPICS);
        commit(mutations.SET_PLATFORMS, platforms);
        return Promise.resolve(metaData);
    },
    [actions.FETCH_TOPICS]: async ({ commit }) => {
        const response = await platformService.fetchTopics();
        commit(mutations.SET_TOPICS, response);
    }
}