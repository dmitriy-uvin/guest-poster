<template>
    <div class="order-footer" :class="{ 'd-block': chosenPlatformsCounter }">
        <div class="container">
            <VRow class="justify-space-between">
                <div class="">
                    <VBtn color="#eaf3ff" class="mr-4">
                        <span style="color: #408bef;">{{ chosenPlatformsCounter }} Selected Platforms</span>
                    </VBtn>
                    <VBtn color="#f4f4f4" depressed @click="onUnselectAll">Unselect All</VBtn>
                </div>
                <div class="">
                    <VBtn
                        color="primary"
                        id="send-request-modal"
                    >
                        Send Request
                        <VIcon right>mdi-chevron-right</VIcon>
                    </VBtn>
                    <SendOrderRequestDialog
                        :chosen-platforms-counter="chosenPlatformsCounter"
                        @send-request="onSendRequested"/>

                    <VDialog
                        v-model="dialogResult"
                        width="500"
                    >
                        <VCard>
                            <VCardTitle class="headline lighten-2">
                                Request was created!
                            </VCardTitle>

                            <VCardText>
                                We'll contact you. You can also monitor requests status in your orders list!

                                <div class="row dialog-buttons">
                                    <VCol col="12" md="6">
                                        <VBtn
                                            color="primary"
                                            block
                                            @click="dialogResult = false"
                                            depressed
                                        >
                                            OK
                                        </VBtn>
                                    </VCol>
                                    <VCol col="12" md="6">
                                        <VBtn
                                            color="#ebf3ff"
                                            block
                                            @click="onOrderList"
                                            depressed
                                        >
                                            <span style="color: #5295f0">ORDER LIST</span>
                                        </VBtn>
                                    </VCol>
                                </div>
                            </VCardText>
                        </VCard>
                    </VDialog>
                </div>
            </VRow>
        </div>
    </div>
</template>

<script>
import SendOrderRequestDialog from '@/components/guest-posting/SendOrderRequestDialog';

export default {
    name: 'SendRequestFooter',
    components: {
        SendOrderRequestDialog
    },
    props: {
        chosenPlatformsIds: {
            required: true
        }
    },
    data: () => ({
       dialogResult: false
    }),
    methods: {
        onUnselectAll() {
            this.$emit('unselected');
        },
        async onSendRequested() {
            this.dialogResult = true;
            this.$emit('request-created');
        },
        onOrderList() {
            this.dialogResult = false;
            this.$router.push({ name: 'Orders' });
        }
    },
    computed: {
        chosenPlatformsCounter() {
            return this.chosenPlatformsIds.length;
        }
    }
}
</script>

<style scoped>
.order-footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: white;
    box-shadow:
        0px 2px 4px 4px rgba(0, 0, 0, 0.2),
        0px 4px 5px 5px rgba(0, 0, 0, 0.14),
        0px 1px 10px 4px rgba(0, 0, 0, 0.12);
    display: none;
}
</style>