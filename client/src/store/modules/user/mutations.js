import * as mutations from './types/mutations';

export default {
    [mutations.SET_LOGGED_USER]: (state, userData) => {
        state.user = userData;
    },
    [mutations.USER_SIGN_OUT]: state => {
        state.user = null;
    }
}