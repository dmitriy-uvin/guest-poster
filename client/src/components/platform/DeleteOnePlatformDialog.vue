<template>
    <VDialog
        v-model="dialogShow"
        persistent
        max-width="600px"
    >
        <VCard>
            <VCardTitle>
                <span class="headline">Delete platform?</span>
            </VCardTitle>
            <VCardText>
                <p class="red--text">Are you sure you want to delete that platform?
                    <span class="black--text">(Platform will be moved to trash!)</span>
                </p>
                <ul>
                    <li><b>{{ deleteProtocol(platform.websiteUrl) }}</b></li>
                </ul>

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
    name: 'DeleteOnePlatformDialog',
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
            moveInTrashByIds: actions.MOVE_IN_TRASH_BY_IDS
        }),
        async onDeletePlatform() {
            await this.moveInTrashByIds({
                ids: [this.platform.id]
            });
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