import * as getters from './types/getters';

export default {
    [getters.GET_PLATFORMS]: state => state.platforms,
    [getters.GET_TOPICS]: state => state.topics,
    [getters.GET_PLATFORM_BY_ID]: state => state.platformById
}
