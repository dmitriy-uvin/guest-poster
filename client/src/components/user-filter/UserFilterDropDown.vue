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
    </span>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import * as actions from '@/store/modules/filter/types/actions';
import notificationMixin from '@/mixins/notificationMixin';
import ConfirmDeleteFilterDialog from '@/components/user-filter/ConfirmDeleteFilterDialog';
import * as getters from "@/store/modules/filter/types/getters";
export default {
    name: 'UserFilterDropDown',
    props: {
        filterId: {
            required: true
        }
    },
    components: {
        ConfirmDeleteFilterDialog
    },
    data: () => ({
        deleteFilterConfirm: false
    }),
    mixins: [notificationMixin],
    methods: {
        ...mapActions('filter', {
            deleteFilterById: actions.DELETE_USER_FILTER
        }),
        onRenameById() {

        },
        onClickDelete() {
            this.deleteFilterConfirm = true;
        },
        async onDeleteFilterById() {
            try {
                await this.deleteFilterById(this.filterId);
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
                if (this.appliedFilter.id === Number(this.filterId)) return '#2f80ed';
            }
            return 'black';
        }
    }
}
</script>

<style scoped>

</style>