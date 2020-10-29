import * as mutations from './types/mutations';
import { userMapper } from '@/services/normalizer/Normalizer';

export default {
    [mutations.SET_LOGGED_USER]: (state, userData) => {
        state.user = userMapper(userData);
    },
    [mutations.USER_SIGN_OUT]: state => {
        state.user = null;
    },
    [mutations.SET_ALL_USERS]: (state, users) => {
        state.users = users;
    },
    [mutations.SET_USER_BY_ID]: (state, userById) => {
        state.userById = userById;
    },
    [mutations.CHANGE_USER_BLOCK_STATUS_BY_ID]: (state, data) => {
        const index = state.users.findIndex(user => user.id === data.id);
        const users = state.users;
        users[index].blocked = data.block_status;
        state.users = users;
    }
}