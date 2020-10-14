<template>
    <VDialog
        v-model="show"
        persistent
        max-width="600px"
    >
        <VCard>
            <VCardTitle>
                <span class="headline">Restore platform?</span>
            </VCardTitle>
            <VCardText>
                <p class="green--text">
                    Are you sure you want to restore following platform?
                </p>
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
export default {
    name: 'RestoreOneFromTrashDialog',
    mixins: [valueFormatMixin],
    props: {
        visibility: {
            required: true
        },
        platform: {
            required: true
        }
    },
    methods: {
        onRestoreClick() {
            this.$emit('restore', this.platform);
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