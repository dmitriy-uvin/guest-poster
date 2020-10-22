<template>
    <div class="order-footer" :class="{ 'd-block': chosenPlatformsCounter }">
        <div class="container">
            <VRow class="justify-space-between">
                <div class="">
                    <VBtn color="#e1eeff" depressed @click="onUnselectAll">Unselect All</VBtn>
                </div>
                <div class="">
                    <VBtn
                        color="blue"
                        @click="onUpdateByApiAll"
                        dark
                        class="mr-3"
                    >
                        Update All
                        <VIcon right>mdi-export</VIcon>
                    </VBtn>
                    <VBtn
                        color="orange"
                        @click="onUpdateByApiByIds"
                        dark
                        class="mr-3"
                    >
                        Update
                        <VIcon right>mdi-export</VIcon>
                    </VBtn>
                    <VBtn
                        color="purple"
                        @click="onPlatformsExportAll"
                        dark
                        class="mr-3"
                    >
                        Export All
                        <VIcon right>mdi-export</VIcon>
                    </VBtn>
                    <VBtn
                        color="green"
                        @click="onPlatformsExport"
                        dark
                        class="mr-3"
                    >
                        Export
                        <VIcon right>mdi-export</VIcon>
                    </VBtn>
                    <VBtn
                        color="red"
                        @click="onPlatformsDelete"
                        dark
                    >
                        Delete
                        <VIcon right>mdi-delete</VIcon>
                    </VBtn>
                </div>
            </VRow>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import * as actions from '@/store/modules/platforms/types/actions';
import notificationMixin from '@/mixins/notificationMixin';
export default {
    name: 'AdminPlatformsFooter',
    props: {
        chosenPlatformsIds: {
            required: true
        }
    },
    mixins: [notificationMixin],
    methods: {
        ...mapActions('platforms', {
            exportByIds: actions.EXPORT_PLATFORMS_BY_IDS,
            exportAll: actions.EXPORT_PLATFORMS_ALL,
            updateDataByApi: actions.UPDATE_PLATFORMS_API_BY_IDS,
            updateDataByApiAll: actions.UPDATE_PLATFORMS_API_ALL,
        }),
        async onUpdateByApiAll() {
            try {
                await this.updateDataByApiAll();
                this.$emit('updateByApi');
                this.setNotification({
                    type: 'success',
                    message: 'Updating platforms started!'
                });
            } catch (error) {
                this.setNotification({
                    type: 'error',
                    message: error
                });
            }
        },
        async onUpdateByApiByIds() {
            try {
                await this.updateDataByApi({
                    ids: this.chosenPlatformsIds
                });
                this.$emit('updateByApi');
                this.setNotification({
                    type: 'success',
                    message: 'Updating platforms started!'
                });
            } catch (error) {
                this.setNotification({
                    type: 'error',
                    message: error
                });
            }
        },
        onUnselectAll() {
            this.$emit('unselect-all');
        },
        onPlatformsDelete() {
            this.$emit('platforms-delete', this.chosenPlatformsIds);
        },
        async onPlatformsExportAll() {
            try {
                await this.exportAll();
                this.$emit('export');
            } catch (error) {
                this.setNotification({
                    type: 'error',
                    message: error
                });
            }
        },
        async onPlatformsExport() {
            try {
                await this.exportByIds({
                    ids: this.chosenPlatformsIds
                });
                this.$emit('export');
            } catch (error) {
                this.setNotification({
                    type: 'error',
                    message: error
                });
            }
        }
    },
    computed: {
        chosenPlatformsCounter() {
            return this.chosenPlatformsIds.length;
        },
    }
}
</script>

<style scoped>
.order-footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    box-shadow:
        0px 2px 4px 4px rgba(0, 0, 0, 0.2),
        0px 4px 5px 5px rgba(0, 0, 0, 0.14),
        0px 1px 10px 4px rgba(0, 0, 0, 0.12);
    display: none;
    background: white;
}
</style>