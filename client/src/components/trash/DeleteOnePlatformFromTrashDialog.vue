<template>
    <VDialog
        v-model="show"
        persistent
        max-width="600px"
    >
        <VCard>
            <VCardTitle>
                <span class="headline">Delete platform?</span>
            </VCardTitle>
            <VCardText>
                <p class="red--text">
                    Are you sure you want to delete following platform?
                </p>
                <h3 class="red--text mb-3">It's can't be undone!</h3>
                <ul>
                    <li>
                        <b>{{ deleteProtocol(platform.websiteUrl) }}</b>
                    </li>
                </ul>
            </VCardText>
            <VCardActions>
                <VSpacer></VSpacer>
                <VBtn
                    color="blue darken-1"
                    text
                    @click="show = false"
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
import * as actions from '@/store/modules/platforms/types/actions';
import notificationMixin from '@/mixins/notificationMixin';
import valueFormatMixin from '@/mixins/valueFormatMixin';
export default {
    name: 'DeleteOnePlatformFromTrashDialog',
    mixins: [notificationMixin, valueFormatMixin],
    props: {
        visibility: {
            required: true,
        },
        platform: {
            required: true
        }
    },
    methods: {
        ...mapActions('platforms', {
            deleteFromTrash: actions.DELETE_PLATFORMS_BY_IDS
        }),
        async onDeleteClick() {
            try {
                const websiteUrl = this.platform.websiteUrl;
                await this.deleteFromTrash([this.platform.id]);
                this.show = false;
                this.$emit('platform-deleted', websiteUrl);
            } catch (error) {
                this.setNotification({
                    type: 'error',
                    message: error
                });
            }
        }
    },
    computed: {
        show:{
            get() {
                return this.visibility;
            },
            set(value) {
                if (!value) {
                    this.$emit('close');
                }
            }
        }
    }
}
</script>

<style scoped>

</style>