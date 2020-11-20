<template>
    <span class="">
        <span v-for="(filterItem, key) in allFilterItems" :key="key">
             <VChip
                 v-if="!filterItem.items && (filterItem.value || filterItem.from || filterItem.to )"
                 label
                 class="mr-2 mb-1 d-inline-block"
                 small
             >
                <span v-if="key !== 'deadline'">{{ filterItem.name }}:</span>
                 <span v-if="filterItem.value !== ''">
                     <span
                         v-if="radioKeys.includes(key)"
                         class="ml-1"
                     >{{ filterItem.value }}</span>
                 </span>
                <span v-if="filterItem.from" class="ml-1">from {{ filterItem.from }}</span>
                <span v-if="filterItem.to" class="ml-1">to {{ filterItem.to }}</span>
                <VIcon
                    right
                    small
                    @click="deleteFilterByKey(filterItem.type, filterItem.property, key)"
                >
                    mdi-close-circle
                </VIcon>
            </VChip>
            <VChip
                label
                small
                v-for="(item, index) in filterItem.items"
                :key="index"
                class="mr-1 mb-1 d-inline-block"
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
        <div
            v-if="!isEmpty"
            @click="clearAllFilters"
            class="d-inline-block ml-3"
        >
            <VIcon color="#2f80ed" small>mdi-delete</VIcon>
            <span class="clear">Clear Filters</span>
        </div>
    </span>
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
            allFilterItems: getters.GET_VISIBLE_FILTER_ITEMS_ALL,
            isEmpty: getters.IS_EMPTY_FILTERS
        }),
    },
}
</script>

<style scoped>

.clear {
    display: inline-block;
    vertical-align: middle;
    font-weight: bold;
    font-size: 12px;
    color: #2f80ed;
    cursor: pointer;
}

.theme--light.v-chip:not(.v-chip--active) {
    background: #f3f3f3;
}
</style>