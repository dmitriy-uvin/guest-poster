<template>
    <div class="d-inline-block user-filters-container">
        <div
            :class="{ 'active-border' : appliedFilterId === Number(id) }"
            class="user-filter-block mr-3"
            v-for="(userFilter, id) in userFilters" :key="id"
            @click="onApplyFilter(id)"
        >
            <span
                class="user-filter-name d-inline-block mr-2"
                :class="{ 'active-text' : appliedFilterId === Number(id) }"
            >
                {{ userFilter.name }}
            </span>
            <UserFilterDropDown
                :filter="userFilter"
                @edit-filter="onEditFilter(id)"
                @filter-deleted="onFilterDeleted"
            />
        </div>
        <div class="d-inline-block create-filters" @click="onCreateFilter">
            <VIcon color="#2f80ed">mdi-plus</VIcon>
            <span>Create Filters</span>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import * as getters from '@/store/modules/filter/types/getters';
import * as actions from '@/store/modules/filter/types/actions';
import notificationMixin from '@/mixins/notificationMixin';
import UserFilterDropDown from '@/components/user-filter/UserFilterDropDown';
export default {
    name: 'UserFiltersBlock',
    mixins: [notificationMixin],
    components: {
        UserFilterDropDown
    },
    methods: {
        ...mapActions('filter', {
            deleteFilterById: actions.DELETE_USER_FILTER,
            applyUserFilter: actions.APPLY_USER_FILTER
        }),
        onFilterDeleted(id) {
            this.$emit('filter-deleted', id);
        },
        onEditFilter(id) {
            this.$emit('edit-filter', id);
        },
        onApplyFilter(id) {
            this.applyUserFilter(id);
        },
        async onDeleteFilterById(id) {
            try {
                await this.deleteFilterById(id);
            } catch (error) {
                this.setNotification({
                    type: 'error',
                    message: error
                });
            }
        },
        onCreateFilter() {
            this.$emit('create-filter');
        }
    },
    computed: {
        ...mapGetters('filter', {
            userFilters: getters.GET_USER_FILTERS,
            appliedFilter: getters.GET_APPLIED_USER_FILTER
        }),
        appliedFilterId() {
            if (this.appliedFilter) {
                return this.appliedFilter.id;
            }
            return '';
        }
    }
}
</script>

<style scoped>
.user-filter-block {
    border: 2px solid #F3F3F3;
    border-radius: 4px;
    padding: 4px 8px;
    display: inline-block;
    cursor: pointer;
}

.user-filters-container {
    margin-left: 32px;
}

.user-filter-name {
    line-height: 24px;
    font-size: 14px;
    font-weight: 500;
}

.active-border {
    border: 2px solid #2f80ed;
}

.active-text {
    color: #2f80ed;
}
.create-filters {
    margin-left: 8px;
    padding-left: 14px;
}

.create-filters span{
    margin-left: 5px;
    color: #2f80ed;
    font-weight: 500;
    font-size: 14px;
    line-height: 24px;
    cursor: pointer;
    display: inline-block;
    vertical-align: middle;
}
</style>