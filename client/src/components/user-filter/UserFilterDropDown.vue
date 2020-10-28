<template>
    <span>
        <VMenu offset-y right>
            <template v-slot:activator="{ on, attrs }">
                <VIcon
                    small
                    class="user-filter-dots"
                    color="black"
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
import { mapActions } from 'vuex';
import * as actions from '@/store/modules/filter/types/actions';
import notificationMixin from '@/mixins/notificationMixin';
import ConfirmDeleteFilterDialog from '@/components/user-filter/ConfirmDeleteFilterDialog';
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
}
</script>

<style scoped>

</style>