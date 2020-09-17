import * as mutations from './types/mutations';
import { platformMapper } from '@/services/normalizer/Normalizer';

export default {
    [mutations.SET_PLATFORM]: (state, platform) => {
        state.platforms = {
            ...state.platforms,
            [platform.id]: { ...platform }
        }
    },
    [mutations.SET_PLATFORMS]: (state, platforms) => {
        // state.platforms = {
        //     ...state.platforms,
        //     ...platforms.reduce(
        //         (prev, platform) => ({
        //             ...prev,
        //             [platform.id]: {
        //                 ...platformMapper(platform)
        //             }
        //         }),
        //         {}
        //     )
        // }
        state.platforms = platforms.map(platformMapper);
    }
}