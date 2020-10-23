import * as gettersTypes from './types/getters';

const radioKeys = [
    'deadline',
    'dofollow',
    'niche_edit_link',
    'home_featured',
    'money_anchor',
];

export default {
    [gettersTypes.GET_FILTER_ITEMS]: state => state.filterItems,
    [gettersTypes.GET_FILTER_ITEM_BY_ID]: state => id => state.filterItems[id],
    [gettersTypes.GET_VISIBLE_FILTER_ITEMS_ALL]: state => {
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
    },
    [gettersTypes.MAX_AMOUNT_FILTERS]: state => {
        let result = 0;
        Object.keys(state.filterItems).map(key => {
            if (state.filterItems[key].type === 'additional') {
                if (state.filterItems[key].from || state.filterItems[key].to) {
                    result += 1;
                    return
                }
                if (state.filterItems[key].value) {
                    result += 1;
                    return
                }
                if (state.filterItems[key].items?.length) {
                    result += 1;
                    return;
                }
            }
        });
        return result;
    },
    [gettersTypes.CAN_ADD_FILTER_ITEM]: (state, getters) => {
        return getters[gettersTypes.MAX_AMOUNT_FILTERS] < 5;
    }
}