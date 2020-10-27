import * as actions from './types/actions';
import * as mutations from './types/mutations';
import filterService from '@/services/filter/filterService';

export default {
    [actions.SET_FILTER_ITEM]: ({ commit, getters }, filterItem) => {
        commit(mutations.SET_FILTER_ITEM, { filterItem, getters });
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
    },
    [actions.SET_COLUMN]: ({ commit }, column) => {
        commit(mutations.SET_COLUMN, column);
    },
    [actions.REMOVE_COLUMN_BY_PROPERTY]: ({ commit }, property) => {
        commit(mutations.REMOVE_COLUMN_BY_PROPERTY, property);
    },
    [actions.CLEAR_COLUMNS]: ({ commit }) => {
        commit(mutations.CLEAR_COLUMNS);
    },
    [actions.SHOW_COLUMNS]: ({ commit }) => {
        commit(mutations.SHOW_COLUMNS);
    },
    [actions.SAVE_USER_FILTER]: async (context, filterData) => {
        await filterService.saveUserFilter(filterData);
    }
}