import * as actions from './types/actions';
import * as mutations from './types/mutations';

export default {
    [actions.SET_FILTER_ITEM]: ({ commit }, filterItem) => {
        commit(mutations.SET_FILTER_ITEM, filterItem);
    },
    [actions.DELETE_FILTER_ITEM]: ({ commit }, id) => {
        commit(mutations.DELETE_FILTER_ITEM, id);
    },
    [actions.SHOW_FILTER_ITEMS]: ({ commit }) => {
        commit(mutations.SHOW_FILTER_ITEMS);
    },
    [actions.CLEAR_FILTER_ITEMS]: ({ commit }) => {
        commit(mutations.CLEAR_FILTER_ITEMS);
    },
    [actions.DELETE_FILTER_ITEM_ARRAY]: ({ commit }, data) => {
        commit(mutations.DELETE_FILTER_ITEM_ARRAY, data);
    }
}