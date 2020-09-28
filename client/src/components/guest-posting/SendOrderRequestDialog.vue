<template>
    <VDialog
        scrollable
        v-model="dialog"
        width="500"
        activator="#send-request-modal"
    >
        <VCard>
            <VCardTitle class="headline">
                Request sending
            </VCardTitle>

            <VCardText>
                <p class="black--text text-center">
                    Check your personal details, write commentary and send request.
                </p>
                <div class="sub-info">
                    <div class="d-flex justify-space-between">
                        <span class="black--text">
                            You had selected {{ chosenPlatformsCounter }} platforms
                        </span>
                        <span class="check-list" @click="$emit('on-check-list')">Check List</span>
                    </div>
                </div>
                <div class="form mt-5">
                    <VTextField
                        append-icon="mdi-account"
                        outlined
                        label="Name"
                        readonly
                        v-model="user.name"
                    >
                    </VTextField>

                    <VTextField
                        append-icon="mdi-email"
                        outlined
                        label="Email"
                        readonly
                        :value="user.email"
                    >
                    </VTextField>

                    <VTextField
                        append-icon="mdi-skype"
                        outlined
                        label="Skype"
                        readonly
                        :value="user.skype"
                    >
                    </VTextField>

                    <VTextField
                        append-icon="mdi-web"
                        outlined
                        label="Website"
                        readonly
                        :value="user.website"
                    >
                    </VTextField>

                    <VTextarea
                        no-resize
                        outlined
                        placeholder="Your Comment"
                        rows="3"
                    >
                    </VTextarea>
                </div>

                <div class="row dialog-buttons">
                    <VCol col="12" md="6">
                        <VBtn
                            color="primary"
                            block
                            @click="onSendRequest"
                            depressed
                        >
                            SEND
                        </VBtn>
                    </VCol>
                    <VCol col="12" md="6">
                        <VBtn
                            color="#ebf3ff"
                            block
                            @click="dialog = false"
                            depressed
                        >
                            <span style="color: #5295f0">CLOSE</span>
                        </VBtn>
                    </VCol>
                </div>
            </VCardText>
        </VCard>
    </VDialog>
</template>

<script>
import { mapGetters } from 'vuex';
import * as getters from '@/store/modules/user/types/getters';

export default {
    name: 'SendOrderRequestDialog',
    props: {
        chosenPlatformsCounter: {
            required: true
        }
    },
    data: () => ({
        dialog: false
    }),
    methods: {
        async onSendRequest() {
            this.$emit('send-request');
            this.dialog = false;
        }
    },
    computed: {
        ...mapGetters('user', {
            user: getters.GET_LOGGED_USER
        }),
    }
}
</script>

<style scoped>
.sub-info {
    background: #f5f5f5;
    padding: 15px;
    border-radius: 5px;
}
.check-list {
    text-decoration: underline;
    cursor: pointer;
    color: #5b9bf0;
    font-weight: bold;
}
</style>