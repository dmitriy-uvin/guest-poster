import * as getters from './types/getters';

export default {
    [getters.GET_LOGGED_USER]: state => state.user,
    [getters.GET_ALL_USERS]: state => state.users,
    [getters.GET_USER_BY_ID]: state => state.userById
}