import * as mutations from './types/mutations';
// import * as gettersTypes from './types/getters';

export default {
    [mutations.SET_FILTER_ITEM]: (state, { filterItem }) => {
        state.filterItems = {
            ...state.filterItems,
            [filterItem.id]: {
                ...state.filterItems[filterItem.id],
                name: filterItem.name,
                visible: filterItem.visible,
                type: filterItem.type,
                property: filterItem.property,
                value: filterItem?.value,
                items: filterItem?.items,
                columnName: filterItem.columnName
            }
        };
        if (filterItem.limit === 'from') {
            state.filterItems[filterItem.id].from = filterItem.from;
        }
        if (filterItem.limit === 'to') {
            state.filterItems[filterItem.id].to = filterItem.to;
        }
    },
    [mutations.DELETE_FILTER_ITEM]: (state, id) => {
        const result = {};
        Object.keys(state.filterItems).map(key => {
            if (key !== id) {
                result[key] = state.filterItems[key];
            }
        });
        state.filterItems = result;
    },
    [mutations.DELETE_FILTER_ITEM_ARRAY]: (state, data) => {
        const filteredItems = state.filterItems[data.key].items.filter(item => item !== data.value);

        state.filterItems = {
            ...state.filterItems,
            [data.key]: {
                ...state.filterItems[data.key],
                items: filteredItems
            }
        }
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
    },
    [mutations.SET_COLUMN]: (state, column) => {
        const columns = state.columns;
        columns.push(column);
        state.columns = columns;
    },
    [mutations.REMOVE_COLUMN_BY_PROPERTY]: (state, property) => {
        const index = state.columns.findIndex(column => column.property === property);
        let columns = state.columns;
        columns = [
            ...columns.slice(0, index),
            ...columns.slice(index + 1),
        ];
        state.columns = columns;
    },
    [mutations.CLEAR_COLUMNS]: state => {
        state.columns = [];
    },
    [mutations.SHOW_COLUMNS]: state => {
        const columns = [];
        Object.keys(state.filterItems).map(key => {
            if (state.filterItems[key].type === 'additional') {
                if (state.filterItems[key].from || state.filterItems[key].to) {
                    if (state.filterItems[key].columnName) {
                        columns.push({
                            property: state.filterItems[key].property,
                            name: state.filterItems[key].columnName,
                            sorting: state.filterItems[key].property,
                            visible: true
                        });
                    }
                }
            }
        });
        state.columns = columns;
    }
}