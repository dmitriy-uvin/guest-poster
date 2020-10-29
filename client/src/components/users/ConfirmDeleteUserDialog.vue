<template>
    <VDialog
        v-model="showDialog"
        persistent
        max-width="600px"
    >
        <VCard>
            <VCardTitle>
                <span class="headline">Delete user?</span>
            </VCardTitle>
            <VCardText>
                <p class="red--text">
                    Are you sure you want to delete <u>{{ user.name }}</u>?
                </p>
                <h3 class="red--text mb-3">It's can't be undone!</h3>
            </VCardText>
            <VCardActions>
                <VSpacer></VSpacer>
                <VBtn
                    color="blue darken-1"
                    text
                    @click="showDialog = false"
                >
                    Close
                </VBtn>
                <VBtn
                    color="red"
                    text
                    @click="onDeleteClick"
                >
                    Delete
                </VBtn>
            </VCardActions>
        </VCard>
    </VDialog>
</template>

<script>
import { mapActions } from 'vuex';
import * as actions from '@/store/modules/user/types/actions';
import notificationMixin from '@/mixins/notificationMixin';
export default {
    name: 'ConfirmDeleteUserDialog',
    props: {
        visibility: {
            required: true
        },
        user: {
            required: true
        }
    },
    mixins: [notificationMixin],
    methods: {
        ...mapActions('user', {
            deleteUserById: actions.DELETE_USER_BY_ID
        }),
        async onDeleteClick() {
            try {
                await this.deleteUserById(this.user.id);
                this.showDialog = false;
                this.setNotification({
                    type: 'success',
                    message: 'User was deleted!'
                });
                this.$emit('delete-user');
            } catch (error) {
                this.setNotification({
                    type: 'error',
                    message: error
                });
            }
        }
    },
    computed: {
        showDialog:{
            get() {
                return this.visibility;
            },
            set(value) {
                if (!value) {
                    this.$emit('close-dialog');
                }
            }
        }
    }
}
</script>

<style scoped>

</style>