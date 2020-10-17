<template>
    <VDialog
        v-model="show"
        persistent
        max-width="600px"
    >
        <VCard>
            <VCardTitle>
                <span class="headline">Delete platforms?</span>
            </VCardTitle>
            <VCardText>
                <p class="red--text">
                    Are you sure you want to delete followings platforms?
                </p>
                <h3 class="red--text mb-3">It's can't be undone!</h3>
                <ul v-if="Object.values(platforms).length">
                    <li v-for="platform in platforms" :key="platform.id">
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
import valueFormatMixin from '@/mixins/valueFormatMixin';
import notificationMixin from '@/mixins/notificationMixin';
export default {
    name: 'DeleteFromTrashDialog',
    mixins: [valueFormatMixin, notificationMixin],
    props: {
        visibility: {
            required: true
        },
        platforms: {
            required: true
        }
    },
    methods: {
        ...mapActions('platforms', {
            deleteFromTrashByIds: actions.DELETE_PLATFORMS_BY_IDS
        }),
        async onDeleteClick() {
            try {
                await this.deleteFromTrashByIds(this.platformsIds);
                this.show = false;
                this.$emit('delete-request');
            } catch (error) {
                this.setNotification({
                    type: 'error',
                    message: error
                });
            }
        },
    },
    computed: {
        platformsIds() {
            return this.platforms.map(platform => platform.id);
        },
        show: {
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