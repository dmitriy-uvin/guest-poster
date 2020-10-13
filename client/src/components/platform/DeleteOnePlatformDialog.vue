<template>
    <VDialog
        v-model="dialogShow"
        persistent
        max-width="600px"
    >
        <VCard>
            <VCardTitle>
                <span class="headline">Delete platform</span>
            </VCardTitle>
            <VCardText>
                <p class="red--text">Are you sure you want to delete platform
                    <b><u v-if="platform.websiteUrl">
                        {{ deleteProtocol(platform.websiteUrl) }}</u></b>
                    ? <span class="black--text">(Platform will be moved to trash!)</span>
                </p>
            </VCardText>
            <VCardActions>
                <VSpacer></VSpacer>
                <VBtn
                    color="blue darken-1"
                    text
                    @click="dialogShow = false"
                >
                    Close
                </VBtn>
                <VBtn
                    color="red"
                    text
                    @click="onDeletePlatform"
                >
                    Delete
                </VBtn>
            </VCardActions>
        </VCard>
    </VDialog>
</template>

<script>
import valueFormatMixin from '@/mixins/valueFormatMixin';
import { mapActions } from 'vuex';
import * as actions from '@/store/modules/platforms/types/actions';

export default {
    name: 'DeletePlatformDialog',
    mixins: [valueFormatMixin],
    props: {
        visible: {
            required: true
        },
        platform: {
            required: true
        }
    },
    methods: {
        ...mapActions('platforms', {
            moveInBucket: actions.MOVE_IN_BUCKET_BY_ID
        }),
        async onDeletePlatform() {
            await this.moveInBucket(this.platform.id);
            this.$emit('on-delete');
            this.dialogShow = false;
        }
    },
    computed: {
        dialogShow: {
            get() {
                return this.visible;
            },
            set(value) {
                if(!value) {
                    this.$emit('close');
                }
            }
        }
    }
}
</script>

<style scoped>

</style>