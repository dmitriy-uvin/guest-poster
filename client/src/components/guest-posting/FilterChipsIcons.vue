<template>
    <div class="d-inline-block">
        <span v-for="(filterItem, key) in allFilterItems" :key="key">
             <VChip
                 v-if="!filterItem.items"
                 label
                 class="mr-1 mb-1"
                 small
             >
                <span v-if="key !== 'deadline'">{{ filterItem.name }}:</span>
                <span
                    v-if="filterItem.value && radioKeys.includes(key)"
                    class="ml-1"
                >{{ filterItem.value }}</span>
                <span v-if="filterItem.from" class="ml-1">from {{ filterItem.from }}</span>
                <span v-if="filterItem.to"  class="ml-1">to {{ filterItem.to }}</span>
                <VIcon
                    right
                    small
                    @click="deleteFilterByKey(filterItem.type, filterItem.property, key)"
                >
                    mdi-close-circle
                </VIcon>
            </VChip>
            <span v-else>
                <VChip
                    label
                    small
                    v-for="(item, index) in filterItem.items"
                    :key="index"
                    class="mr-1 mb-1"
                >
                {{ item }}
                <VIcon
                    right
                    small
                    @click="deleteFilterItemByKeyFromArray(filterItem.type, filterItem.property, item)"
                >
                    mdi-close-circle
                </VIcon>
            </VChip>
            </span>
        </span>
        <span
            v-if="!isEmpty"
            @click="clearAllFilters"
        >
            <VIcon color="#2f80ed" small>mdi-delete</VIcon>
            <span class="clear">Clear Filters</span>
        </span>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import * as actions from '@/store/modules/filter/types/actions';
import * as getters from '@/store/modules/filter/types/getters';
export default {
    name: 'FilterChipsIcons',
    data: () => ({
        radioKeys: [
            'deadline',
            'dofollow',
            'niche_edit_link',
            'home_featured',
            'money_anchor',
        ]
    }),
    methods: {
        ...mapActions('filter', {
            deleteFilterItemByKey: actions.DELETE_FILTER_ITEM,
            deleteFilterItemByKeyArray: actions.DELETE_FILTER_ITEM_ARRAY,
            clearFilterItems: actions.CLEAR_FILTER_ITEMS
        }),
        clearAllFilters() {
            this.clearFilterItems();
            this.$emit('clear-all-filters');
        },
        deleteFilterByKey(type, property, key) {
            this.deleteFilterItemByKey(key);
            this.$emit('filter-item-deleted', property);
        },
        deleteFilterItemByKeyFromArray(type, property, value) {
            this.deleteFilterItemByKeyArray({
                key: property.split('.')[1] === 'domainZones' ? 'domains' : property.split('.')[1],
                value
            });
            this.$emit('filter-item-deleted-array', type, value, property);
        }
    },
    computed: {
        ...mapGetters('filter', {
            filterItems: getters.GET_FILTER_ITEMS,
            allFilterItems: getters.GET_VISIBLE_FILTER_ITEMS_ALL,
            isEmpty: getters.IS_EMPTY_FILTERS
        }),
    },
}
</script>

<style scoped>
.clear {
    font-weight: bold;
    font-size: 12px;
    color: #2f80ed;
    cursor: pointer;
}
</style>