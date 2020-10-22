import * as getters from './types/getters';

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
            ) {
                result[key] = state.filterItems[key];
            }
        });
        return result;
    }
}