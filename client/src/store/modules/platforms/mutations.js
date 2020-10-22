import * as mutations from './types/mutations';
import { platformMapper } from '@/services/normalizer/Normalizer';

export default {
    [mutations.SET_PLATFORMS]: (state, platforms) => {
        state.platforms = platforms.map(platformMapper);
    },
    [mutations.SET_TOPICS]: (state, topics) => {
        state.topics = {
            ...state.topics,
            ...topics.reduce(
                (prev, topic) => ({
                    ...prev,
                    [topic.name]: topic.id
                }),
                {}
            )
        }
    },
    [mutations.DELETE_PLATFORM]: (state, id) => {
        const index = state.platforms.findIndex(platform => platform.id === id);
        state.platforms = [
            ...state.platforms.slice(0, index),
            ...state.platforms.slice(index + 1),
        ];
    },
    [mutations.SET_PLATFORM_BY_ID]: (state, platform) => {
        state.platformById = platformMapper(platform)
    },
    [mutations.SET_DOMAIN_ZONES]: (state, domainZones) => {
        state.domainZones = domainZones;
    }
}