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
                        <VBtn
                            depressed
                            text
                            @click="onConfirmEmail"
                        >
                            Confirm Email
                        </VBtn>
                    </VCol>
                </VRow>

                <VCol cols="12">
                    <VTextField
                        label="Name"
                        append-icon="mdi-account"
                        v-model="name"
                        :error-messages="nameErrors"
                        @input="onNameInput"
                    ></VTextField>
                </VCol>
                <VCol cols="12">
                    <VTextField
                        label="Email"
                        append-icon="mdi-at"
                        v-model="email"
                        :error-messages="emailErrors"
                        @input="onEmailInput"
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
                            @click="onSaveChanges"
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
                            @click="changePasswordFormDialog = true"
                        >
                            <span style="color: #2f80ed">Change Password</span>
                        </VBtn>
                    </VCol>
                </VRow>
            </div>
        </VCol>

        <ChangePasswordFormDialog
            :visibility="changePasswordFormDialog"
            @close-dialog="changePasswordFormDialog = false"
        />
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import * as getters from '@/store/modules/user/types/getters';
import * as actions from '@/store/modules/user/types/actions';
import notificationMixin from '@/mixins/notificationMixin';
import { validationMixin } from 'vuelidate';
import {
    required,
    email
} from 'vuelidate/lib/validators';
import ChangePasswordFormDialog from '@/components/profile/ChangePasswordFormDialog';
export default {
    name: 'ProfileComponent',
    components: {
        ChangePasswordFormDialog
    },
    validations: {
        name: { required },
        email: { required, email }
    },
    data: () => ({
        name: '',
        email: '',
        skype: '',
        website: '',
        emailVerified: '',
        changePasswordFormDialog: false,
    }),
    mixins: [validationMixin, notificationMixin],
    methods: {
        ...mapActions('user', {
            updateAuthUser: actions.UPDATE_AUTH_USER,
            sendVerifyEmailLink: actions.SEND_VERIFY_EMAIL_LINK
        }),
        async onConfirmEmail() {
            try {
                await this.sendVerifyEmailLink();
                this.setNotification({
                    type: 'success',
                    message: 'Verify email link was sent!'
                })
            } catch (error) {
                this.setNotification({
                    type: 'error',
                    message: error
                });
            }
        },
        onNameInput() {
            this.$v.name.$touch();
        },
        onEmailInput() {
            this.$v.email.$touch();
        },
        async onSaveChanges() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                try {
                    const userData = {
                        name: this.name,
                        skype: this.skype,
                        website: this.website,
                        email: this.email
                    };
                    await this.updateAuthUser(userData);
                    this.emailVerified = !!this.user.emailVerifiedAt;
                    this.setNotification({
                        type: 'success',
                        message: 'Profile was successfully updated!'
                    });
                } catch (error) {
                    this.setNotification({
                        type: 'error',
                        message: error
                    });
                }
            }
        }
    },
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
        },
        nameErrors() {
            const errors = [];
            if (!this.$v.name.$dirty) {
                return errors;
            }
            !this.$v.name.required &&
                errors.push('Name is required!');
            return errors;
        },
        emailErrors() {
            const errors = [];
            if (!this.$v.email.$dirty) {
                return errors;
            }
            !this.$v.email.required &&
                errors.push('Email is required!');
            !this.$v.email.email &&
                errors.push('Email must be valid!');
            return errors;
        },
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