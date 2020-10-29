<template>
    <VDialog
        v-model="showDialog"
        persistent
        max-width="500px"
    >
        <VCard>
            <VCardTitle>
                <span class="headline">Delete filter?</span>
            </VCardTitle>
            <VCardText>
                Filter will be deleted permanently!
            </VCardText>
            <VCardActions>
                <VSpacer></VSpacer>
                <VBtn
                    color="#eaf3ff"
                    depressed
                    large
                    @click="showDialog = false"
                >
                    <span style="color: #2f80ed">Close</span>
                </VBtn>
                <VBtn
                    color="primary"
                    depressed
                    large
                    @click="onDeleteClick"
                >
                    Delete
                </VBtn>
            </VCardActions>
        </VCard>
    </VDialog>
</template>

<script>
export default {
    name: 'ConfirmDeleteFilterDialog',
    props: {
        visibility: {
            required: true
        }
    },
    methods: {
        onDeleteClick() {
            this.showDialog = false;
            this.$emit('delete-filter');
        }
    },
    computed: {
        showDialog: {
            get() {
                return this.visibility;
            },
            set(value) {
                if (!value) {
                    this.$emit('close-dialog');
                }
            }
        },
    }
}
</script>

<style scoped>

</style>