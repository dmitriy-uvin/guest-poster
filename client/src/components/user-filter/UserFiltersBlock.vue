<template>
    <div class="d-inline-block ml-4">
        <div
            :class="{ 'active-border' : appliedFilterId === Number(id) }"
            class="user-filter-block mr-2"
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
            />
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
    border: 2px solid #dcdcdc;
    border-radius: 4px;
    padding: 5px 8px;
    display: inline-block;
    cursor: pointer;
}

.user-filter-name {
    font-size: 14px;
    font-weight: 500;
}

.active-border {
    border: 2px solid #2f80ed;
}

.active-text {
    color: #2f80ed;
}
</style>