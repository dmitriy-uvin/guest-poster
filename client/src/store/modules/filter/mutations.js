import * as mutations from './types/mutations';

export default {
    [mutations.SET_FILTER_ITEM]: (state, filterItem) => {
        state.filterItems = {
            ...state.filterItems,
            [filterItem.id]: {
                name: filterItem.name,
                from: filterItem.from ? filterItem.from : state.filterItems[filterItem.id]?.from,
                to: filterItem.to ? filterItem.to : state.filterItems[filterItem.id]?.to,
                visible: filterItem.visible,
                type: filterItem.type
            }
        }
    },
    [mutations.DELETE_FILTER_ITEM]: (state, id) => {
        const filterItems = state.filterItems;
        delete filterItems[id];
        state.filterItems = filterItems;
    },
    [mutations.SHOW_FILTER_ITEMS]: state => {
        const res = {};
        Object.keys(state.filterItems).map(key => {
            res[key] = {
                ...state.filterItems[key],
                visible: true
            };
        });
        state.filterItems = res;
    },
    [mutations.CLEAR_FILTER_ITEMS]: state => {
        state.filterItems = {};
    }
}