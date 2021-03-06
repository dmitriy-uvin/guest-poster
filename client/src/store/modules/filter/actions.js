import * as actions from './types/actions';
import * as mutations from './types/mutations';
import filterService from '@/services/filter/filterService';

export default {
    [actions.SET_FILTER_ITEMS]: ({ commit }, filterItems) => {
        Object.keys(filterItems).map(key => {
            commit(mutations.SET_FILTER_ITEM, filterItems[key]);
        });
    },
    [actions.SET_FILTER_ITEM]: ({ commit }, filterItem) => {
        commit(mutations.SET_FILTER_ITEM, filterItem);
    },
    [actions.DELETE_FILTER_ITEM]: ({ commit }, id) => {
        commit(mutations.DELETE_FILTER_ITEM, id);
    },
    [actions.SHOW_FILTER_ITEMS]: ({ commit }) => {
        commit(mutations.SHOW_FILTER_ITEMS);
    },
    [actions.CLEAR_FILTER_ITEMS]: ({ commit }, mode) => {
        commit(mutations.CLEAR_FILTER_ITEMS, mode);
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
    [actions.SAVE_USER_FILTER]: async ({ commit }, filterData) => {
        const response = await filterService.saveUserFilter(filterData);
        commit(mutations.SET_USER_FILTER, response);
    },
    [actions.GET_USER_FILTERS]: async ({ commit }) => {
        const response = await filterService.getUserFilters();
        commit(mutations.SET_USER_FILTERS, response);
    },
    [actions.DELETE_USER_FILTER]: async ({ commit, getters }, id) => {
        await filterService.deleteUserFilterById(id);
        commit(mutations.DELETE_USER_FILTER, { id, getters });
    },
    [actions.APPLY_USER_FILTER]: async ({ commit }, id) => {
        commit(mutations.APPLY_USER_FILTER, id);
    },
    [actions.SET_FILTER_ITEM_FROM_APPLIED_FILTER]: ({ commit }, filterItem) => {
        commit(mutations.SET_FILTER_ITEM_FROM_APPLIED_FILTER, filterItem);
    },
    [actions.RENAME_USER_FILTER]: async ({ commit }, data) => {
        await filterService.renameUserFilterById(data);
        commit(mutations.RENAME_USER_FILTER, data);
    },
    [actions.UPDATE_USER_FILTER_BY_ID]: async ({ commit }, filterData) => {
        const filterResponse = await filterService.updateFilterById(filterData);
        commit(mutations.UPDATE_USER_FILTER_BY_ID, filterResponse.id);
        commit(mutations.SET_USER_FILTER, filterResponse);
    }
}