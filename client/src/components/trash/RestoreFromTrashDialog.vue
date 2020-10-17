<template>
    <VDialog
        v-model="show"
        persistent
        max-width="600px"
    >
        <VCard>
            <VCardTitle>
                <span class="headline">Restore platforms?</span>
            </VCardTitle>
            <VCardText>
                <p class="green--text">
                    Are you sure you want to restore followings platforms?
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
                    color="green"
                    @click="onRestoreClick"
                    dark
                >
                    Restore
                </VBtn>
            </VCardActions>
        </VCard>
    </VDialog>
</template>

<script>
import valueFormatMixin from '@/mixins/valueFormatMixin';
import notificationMixin from '@/mixins/notificationMixin';

export default {
    name: "RestoreFromTrashDialog",
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
        onRestoreClick() {
            this.$emit('restore', this.platformsIds);
        }
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