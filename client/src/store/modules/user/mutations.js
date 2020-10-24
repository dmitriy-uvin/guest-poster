import * as mutations from './types/mutations';
import { userMapper } from '@/services/normalizer/Normalizer';

export default {
    [mutations.SET_LOGGED_USER]: (state, userData) => {
        state.user = userMapper(userData);
    },
    [mutations.USER_SIGN_OUT]: state => {
        state.user = null;
    },
    [mutations.UPDATE_AUTH_USER]: (state, userData) => {
        const user = state.user;
        user.name = userData?.name ? userData?.name : state.user.name;
        user.skype = userData?.skype ? userData?.skype : state.user.skype;
        user.website = userData?.website ? userData?.website : state.user.website;
        state.user = {
            ...user
        };
    }
}