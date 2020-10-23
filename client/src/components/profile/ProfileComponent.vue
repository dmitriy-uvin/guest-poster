<template>
    <div class="d-flex justify-center mt-16">
        <VCol cols="12" md="4">
            <div class="profile-form">
                <div class="profile-form-head text-center">
                    <h1>Personal details</h1>
                    <p>Filling or editing of your personal data and password management</p>
                </div>

                <VRow class="email-not-confirmed align-center" v-if="!emailVerified">
                    <VCol cols="12" md="6" class="text-left">
                        <span>Your email is not confirmed</span>
                    </VCol>
                    <VCol cols="12" md="6" class="text-right">
                        <VBtn depressed text>
                            Confirm Email
                        </VBtn>
                    </VCol>
                </VRow>

                <VCol cols="12">
                    <VTextField
                        label="Name"
                        append-icon="mdi-account"
                        v-model="name"
                    ></VTextField>
                </VCol>
                <VCol cols="12">
                    <VTextField
                        label="Email"
                        append-icon="mdi-at"
                        v-model="email"
                    ></VTextField>
                </VCol>
                <VCol cols="12">
                    <VTextField
                        label="Skype"
                        append-icon="mdi-skype"
                        v-model="skype"
                    ></VTextField>
                </VCol>
                <VCol cols="12">
                    <VTextField
                        label="Website"
                        append-icon="mdi-web"
                        v-model="website"
                    ></VTextField>
                </VCol>
                <VRow>
                    <VCol cols="12" md="6">
                        <VBtn
                            color="primary"
                            :disabled="!changed"
                            depressed
                            block
                            large
                        >
                            Save Changes
                        </VBtn>
                    </VCol>
                    <VCol cols="12" md="6">
                        <VBtn
                            color="#eaf3ff"
                            depressed
                            block
                            large
                        >
                            <span style="color: #2f80ed">Change Password</span>
                        </VBtn>
                    </VCol>
                </VRow>
            </div>
        </VCol>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import * as getters from '@/store/modules/user/types/getters';
export default {
    name: 'ProfileComponent',
    data: () => ({
        name: '',
        email: '',
        skype: '',
        website: '',
        emailVerified: ''
    }),
    async mounted() {
        this.name = this.user.name;
        this.email = this.user.email;
        this.skype = this.user.skype;
        this.website = this.user.website;
        this.emailVerified = !!this.user.emailVerifiedAt;
    },
    computed: {
        ...mapGetters('user', {
            user: getters.GET_LOGGED_USER
        }),
        changed() {
            return !((this.name === this.user.name) && (this.email === this.user.email)
                && (this.skype === this.user.skype) && (this.website === this.user.website));
        }
    }
}
</script>

<style scoped>
.profile-form-head p {
    margin: 0;
    font-size: 14px;
    color: #333333;
    opacity: 0.6;
}
.email-not-confirmed {
    background: #f9f9f9;
}
</style>