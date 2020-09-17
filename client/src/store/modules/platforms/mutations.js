import * as mutations from './types/mutations';

export default {
    [mutations.SET_PLATFORM]: (state, platform) => {
        state.platforms = {
            ...state.platforms,
            [platform.id]: { ...platform }
        }
    }
}