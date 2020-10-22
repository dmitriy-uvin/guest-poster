<template>
    <div>
        <VChip v-for="(item, key) in visibleFilterItems" :key="key" class="mr-1 mb-1">
            <span v-if="key !== 'deadline'">{{ item.name }}:</span>
            <span v-if="item.value && key === 'deadline'">{{ item.value }}</span>
            <span v-if="item.from" class="ml-1">from {{ item.from }}</span>
            <span v-if="item.to"  class="ml-1">to {{ item.to }}</span>
            <VIcon
                right
                small
                @click="deleteFilterByKey(item.type, key, item.property)"
            >
                mdi-close-circle
            </VIcon>
        </VChip>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import * as actions from '@/store/modules/filter/types/actions';
import * as getters from '@/store/modules/filter/types/getters';
export default {
    name: 'FilterChipsIcons',
    methods: {
        ...mapActions('filter', {
            deleteFilterItemByKey: actions.DELETE_FILTER_ITEM,
            clearFilterItems: actions.CLEAR_FILTER_ITEMS,
        }),
        deleteFilterByKey(type, key, property) {
            this.deleteFilterItemByKey(key);
            this.$emit('filter-item-deleted', property);
        }
    },
    computed: {
        ...mapGetters('filter', {
            filterItems: getters.GET_FILTER_ITEMS,
            visibleFilterItems: getters.GET_VISIBLE_FILTER_ITEMS
        }),
    },
}
</script>

<style scoped>

</style>