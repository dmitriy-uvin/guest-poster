import * as actions from './types/actions';
import * as mutations from './types/mutations';
import authService from '@/services/auth/authService';
import userService from '@/services/user/userService';
import router from '@/router';
import * as notificationActions from '@/store/modules/notification/types/actions';

export default {
    [actions.SIGN_IN]: async (context, userData) => {
        await authService.signIn(userData);
    },
    [actions.SIGN_UP]: async (context, userData) => {
        await authService.signUp(userData);
    },
    [actions.FETCH_LOGGED_USER]: async ({ commit }) => {
        const userData = await authService.fetchLoggedUser();
        commit(mutations.SET_LOGGED_USER, userData);
    },
    [actions.SIGN_OUT]: async ({ commit, dispatch }) => {
        try {
            authService.signOut();
            authService.removeToken();
            commit(mutations.USER_SIGN_OUT);
        } catch (error) {
            dispatch(actions.CHECK_IF_UNAUTHORIZED, error);
        }
    },
    [actions.VERIFY_EMAIL]: async (context, verifyData) => {
        await authService.verifyEmail(verifyData);
    },
    [actions.FORGOT_PASSWORD]: async (context, userEmail) => {
        await authService.forgotPassword(userEmail);
    },
    [actions.RESET_PASSWORD]: async (context, newPasswordData) => {
        await authService.resetPassword(newPasswordData);
    },
    [actions.UPDATE_AUTH_USER]: async ({ commit }, userData) => {
        const response = await authService.updateAuthUser(userData);
        commit(mutations.SET_LOGGED_USER, response);
    },
    [actions.SEND_VERIFY_EMAIL_LINK]: async () => {
        await authService.sendVerifyEmailLink();
    },
    [actions.UPDATE_AUTH_USER_PASSWORD]: async (context, passwordData) => {
        await authService.updateAuthUserPassword(passwordData);
    },
    [actions.GET_ALL_USERS]: async ({ commit }, params = {}) => {
        const response = await userService.getAllUsers(params);
        const users = response?.data;
        const meta = response?.meta;
        commit(mutations.SET_ALL_USERS, users);
        return Promise.resolve(meta);
    },
    [actions.GET_USER_BY_ID]: async ({ commit }, id) => {
        const response = await userService.getUserById(id);
        commit(mutations.SET_USER_BY_ID, response);
    },
    [actions.CHANGE_USER_BLOCK_STATUS_BY_ID]: async ({ commit }, data) => {
        await userService.changeUserBlockStatusById(data);
        commit(mutations.CHANGE_USER_BLOCK_STATUS_BY_ID, data);
    },
    [actions.DELETE_USER_BY_ID]: async (context, id) => {
        await userService.deleteUserById(id);
    },
    [actions.CHECK_IF_UNAUTHORIZED]: (
        { state, dispatch },
        error
    ) => {
        if (error.response.status === 401) {
            authService.removeToken();
            state.user = null;
            router.push({ name: 'SignIn' });
            dispatch('notification/' + notificationActions.SET_NOTIFICATION, {
                type: 'error',
                message: 'Unauthorized!'
            });
        }
    },
}