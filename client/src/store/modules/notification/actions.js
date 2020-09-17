import * as actions from './types/actions';
import * as mutations from './types/mutations';

export default {
    [actions.SET_NOTIFICATION]: ({ commit }, notification) => {
        commit(mutations.SET_NOTIFICATION, notification);
    },
    [actions.REMOVE_NOTIFICATION]: ({ commit }) => {
        commit(mutations.REMOVE_NOTIFICATION);
    },
}