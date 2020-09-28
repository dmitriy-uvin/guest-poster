import * as mutations from './types/mutations';
import { platformMapper } from '@/services/normalizer/Normalizer';

export default {
    [mutations.SET_PLATFORMS]: (state, platforms) => {
        state.platforms = platforms.map(platformMapper);
    }
}