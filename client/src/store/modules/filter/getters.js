import * as getters from './types/getters';

const radioKeys = [
    'deadline',
    'dofollow',
    'niche_edit_link',
    'home_featured',
    'money_anchor',
];

export default {
    [getters.GET_FILTER_ITEMS]: state => state.filterItems,
    [getters.GET_FILTER_ITEM_BY_ID]: state => id => state.filterItems[id],
    [getters.GET_VISIBLE_FILTER_ITEMS]: state => {
        const result = {};
        Object.keys(state.filterItems).map(key => {
            if (state.filterItems[key].visible
                && (
                    state.filterItems[key].from || state.filterItems[key].to
                )
                && !state.filterItems[key].items
            ) {
                result[key] = state.filterItems[key];
            }
            if (radioKeys.includes(key) && state.filterItems[key].value !== 'any') {
                result[key] = state.filterItems[key];
            }
        });
        return result;
    },
    [getters.GET_VISIBLE_FILTER_ITEMS_ARRAY]: state => {
        const result = {};
        Object.keys(state.filterItems).map(key => {
            if (state.filterItems[key].items) {
                result[key] = state.filterItems[key];
            }
        });
        return result;
    },
    [getters.GET_VISIBLE_FILTER_ITEMS_ALL]: state => {
        const result = {};
        Object.keys(state.filterItems).map(key => {
            if (state.filterItems[key].items) {
                result[key] = state.filterItems[key];
                return;
            }
            if (state.filterItems[key].visible
                && (
                    state.filterItems[key].from || state.filterItems[key].to
                )
                && !state.filterItems[key].items
            ) {
                result[key] = state.filterItems[key];
            }
            if (radioKeys.includes(key) && state.filterItems[key].value !== 'any') {
                result[key] = state.filterItems[key];
            }
        });
        return result;
    }
}