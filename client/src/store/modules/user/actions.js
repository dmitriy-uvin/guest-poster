import * as actions from './types/actions';
import * as mutations from './types/mutations';
import authService from '@/services/auth/authService';

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
    [actions.SIGN_OUT]: async ({ commit }) => {
        authService.removeToken();
        commit(mutations.USER_SIGN_OUT);
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
    }
}