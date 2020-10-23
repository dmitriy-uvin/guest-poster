import * as mutations from './types/mutations';
import { userMapper } from '@/services/normalizer/Normalizer';

export default {
    [mutations.SET_LOGGED_USER]: (state, userData) => {
        state.user = userMapper(userData);
    },
    [mutations.USER_SIGN_OUT]: state => {
        state.user = null;
    }
}