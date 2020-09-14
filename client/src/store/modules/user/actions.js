import * as actions from './types/actions';
import * as mutations from './types/mutations';
import authService from "@/services/auth/authService";

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
        commit(mutations.USER_SIGN_OUT);
    }
}