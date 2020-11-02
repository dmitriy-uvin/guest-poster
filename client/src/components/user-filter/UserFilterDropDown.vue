<template>
    <span>
        <VMenu offset-y right>
            <template v-slot:activator="{ on, attrs }">
                <VIcon
                    small
                    class="user-filter-dots"
                    :color="color"
                    v-bind="attrs"
                    v-on="on"
                >
                    mdi-dots-vertical
                </VIcon>
            </template>
            <VList>
                <VListItem dense @click="onEditFilter" v-if="appliedFilterId">
                    <VListItemTitle>Edit</VListItemTitle>
                </VListItem>
                <VListItem dense @click="onRenameById">
                    <VListItemTitle>Rename</VListItemTitle>
                </VListItem>
                <VListItem dense @click="onClickDelete">
                    <VListItemTitle>Delete</VListItemTitle>
                </VListItem>
            </VList>
        </VMenu>
        <ConfirmDeleteFilterDialog
            :visibility="deleteFilterConfirm"
            @close-dialog="deleteFilterConfirm = false"
            @delete-filter="onDeleteFilterById"
        />
        <RenameFilterNameDialog
            :filter="filter"
            :visibility="renameNameDialog"
            @close-dialog="renameNameDialog = false"
        />
    </span>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import * as actions from '@/store/modules/filter/types/actions';
import notificationMixin from '@/mixins/notificationMixin';
import ConfirmDeleteFilterDialog from '@/components/user-filter/ConfirmDeleteFilterDialog';
import * as getters from '@/store/modules/filter/types/getters';
import RenameFilterNameDialog from '@/components/user-filter/RenameFilterNameDialog';
export default {
    name: 'UserFilterDropDown',
    props: {
        filter: {
            required: true
        }
    },
    components: {
        ConfirmDeleteFilterDialog,
        RenameFilterNameDialog
    },
    data: () => ({
        deleteFilterConfirm: false,
        renameNameDialog: false
    }),
    mixins: [notificationMixin],
    methods: {
        ...mapActions('filter', {
            deleteFilterById: actions.DELETE_USER_FILTER
        }),
        onEditFilter() {
            this.$emit('edit-filter');
        },
        onRenameById() {
            this.renameNameDialog = true;
        },
        onClickDelete() {
            this.deleteFilterConfirm = true;
        },
        onDeleteFilterById() {
            try {
                const id = this.filter.id;
                this.deleteFilterById(this.filter.id);
                this.$emit('filter-deleted', id);
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
            appliedFilter: getters.GET_APPLIED_USER_FILTER
        }),
        color() {
            if (this.appliedFilter) {
                if (this.appliedFilter.id === Number(this.filter.id)) return '#2f80ed';
            }
            return 'black';
        },
        appliedFilterId() {
            if (this.appliedFilter) {
                if (this.appliedFilter.id === Number(this.filter.id)) return true;
            }
            return false;
        }
    }
}
</script>

<style scoped>

</style>