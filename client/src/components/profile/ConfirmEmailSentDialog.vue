<template>
    <VDialog
        v-model="showDialog"
        persistent
        max-width="600px"
    >
        <VCard>
            <VCardTitle>
                <VContainer>
                    <span class="headline font-weight-bold">Check your Email!</span>
                    <p class="simple-text ma-0 mt-2 text-break">
                        Within 30 minutes you'll get our letter with link to confirm entered e-mail!
                    </p>
                </VContainer>
                <VContainer>
                    <VBtn
                        color="primary"
                        block
                        @click="showDialog = false"
                        large
                        class="mb-3"
                    >
                        OK
                    </VBtn>
                </VContainer>
            </VCardTitle>
        </VCard>
    </VDialog>
</template>

<script>
export default {
    name: 'ConfirmEmailSentDialog',
    props: {
        visibility: {
            required: true
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
        }
    }
}
</script>

<style scoped>
.simple-text {
    font-weight: normal;
    font-size: 15px;
}
</style>