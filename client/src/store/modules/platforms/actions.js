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
    },
    [actions.DELETE_PLATFORM_BY_ID]: async ({ commit }, id) => {
        await platformService.deletePlatformById(id);
        commit(mutations.DELETE_PLATFORM, id);
    },
    [actions.MOVE_IN_BUCKET_BY_ID]: async ({ commit }, id) => {
        await platformService.moveInBucketById(id);
        commit(mutations.MOVE_IN_BUCKET_BY_ID, id);
    },
    [actions.MOVE_FROM_BUCKET_BY_ID]: async ({ commit }, id) => {
        await platformService.moveFromBucketById(id);
        commit(mutations.MOVE_FROM_BUCKET_BY_ID, id);
    },
}