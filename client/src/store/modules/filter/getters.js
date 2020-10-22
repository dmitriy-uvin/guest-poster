import * as getters from './types/getters';

export default {
    [getters.GET_FILTER_ITEMS]: state => state.filterItems,
    [getters.GET_FILTER_ITEM_BY_ID]: state => id => state.filterItems[id]
}