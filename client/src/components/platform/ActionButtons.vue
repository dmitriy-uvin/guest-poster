<template>
    <VSpeedDial
        v-model="visible"
        class="float-btn-action"
    >
        <template v-slot:activator>
            <VBtn
                v-model="visible"
                color="blue darken-2"
                dark
                fab
            >
                <VIcon v-if="visible">
                    mdi-close
                </VIcon>
                <VIcon v-else>
                    mdi-format-list-bulleted-square
                </VIcon>
            </VBtn>
        </template>
        <VTooltip left>
            <template v-slot:activator="{ on, attrs }">
                <VBtn
                    fab
                    dark
                    small
                    v-bind="attrs"
                    v-on="on"
                    color="orange"
                    @click="onTrash"
                >
                    <VIcon>mdi-delete</VIcon>
                </VBtn>
            </template>
            <span>Trash</span>
        </VTooltip>
        <VTooltip left>
            <template v-slot:activator="{ on, attrs }">
                <VBtn
                    fab
                    dark
                    small
                    v-bind="attrs"
                    v-on="on"
                    color="primary"
                    @click="onImport"
                >
                    <VIcon>mdi-import</VIcon>
                </VBtn>
            </template>
            <span>Import</span>
        </VTooltip>
        <VTooltip left>
            <template v-slot:activator="{ on, attrs }">
                <VBtn
                    fab
                    dark
                    small
                    color="red"
                    v-bind="attrs"
                    v-on="on"
                    @click="onAddPlatform"
                >
                    <VIcon>mdi-plus</VIcon>
                </VBtn>
            </template>
            <span>Add Platform</span>
        </VTooltip>
    </VSpeedDial>
</template>

<script>
import rolemixin from '@/mixins/rolemixin';
export default {
    name: 'ActionButtons',
    mixins: [rolemixin],
    data: () => ({
        visible: false
    }),
    methods: {
        onAddPlatform() {
            if (this.isAdmin) {
                this.$router.push({ name: 'AddPlatform' });
            }
        },
        onTrash() {
            if (this.isAdmin) {
                this.$router.push({ name: 'Trash' });
            }
        },
        onImport() {
            if (this.isAdmin) {
                this.$router.push({ name: 'ImportPlatforms' });
            }
        }
    }
}
</script>

<style scoped>

</style>