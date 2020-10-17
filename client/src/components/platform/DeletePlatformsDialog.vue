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
                    <span class="black--text">(Platforms will be moved in trash!)</span>
                </p>
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
                    @click="onDeleteRequest"
                >
                    Delete
                </VBtn>
            </VCardActions>
        </VCard>
    </VDialog>
</template>

<script>
import { mapActions } from 'vuex';
import * as actions from "@/store/modules/platforms/types/actions";
import valueFormatMixin from '@/mixins/valueFormatMixin';
export default {
    name: 'DeletePlatformsDialog',
    mixins: [valueFormatMixin],
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
            moveInTrashByIds: actions.MOVE_IN_TRASH_BY_IDS
        }),
        async onDeleteRequest() {
            const ids = this.platforms.map(platform => platform.id);
            await this.moveInTrashByIds({
                ids
            });
            this.show = false;
            this.$emit('on-delete');
        }
    },
    computed: {
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