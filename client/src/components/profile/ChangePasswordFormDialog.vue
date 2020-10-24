<template>
    <VDialog
        v-model="showDialog"
        persistent
        max-width="600px"
    >
        <VCard>
            <VCardTitle>
                <VContainer>
                    <span class="headline">Password changing</span>
                    <VRow class="container error-block pa-0 ml-0 mt-6" v-if="error">
                        <VCol cols="12" md="8" class="text-left">
                            <span class="error--text">
                                {{ error }}
                            </span>
                        </VCol>
                        <VCol cols="12" md="4" class="text-right">
                            <span class="link">Or recovery password</span>
                        </VCol>
                    </VRow>
                </VContainer>

            </VCardTitle>
            <VCardText>
                <VCol cols="12">
                    <VTextField
                        outlined
                        label="Old Password"
                        :type="oldPasswordShow ? 'text' : 'password'"
                        :append-icon="oldPasswordShow ? 'mdi-eye-off' : 'mdi-eye'"
                        @click:append="oldPasswordShow = !oldPasswordShow"
                        aria-autocomplete="none"
                        :error-messages="oldPasswordErrors"
                        v-model="oldPassword"
                    ></VTextField>
                </VCol>
                <VCol cols="12">
                    <VTextField
                        outlined
                        label="New Password"
                        :type="newPasswordShow ? 'text' : 'password'"
                        :append-icon="newPasswordShow ? 'mdi-eye-off' : 'mdi-eye'"
                        @click:append="newPasswordShow = !newPasswordShow"
                        aria-autocomplete="none"
                        :error-messages="newPasswordErrors"
                        v-model="newPassword"
                    ></VTextField>
                </VCol>
                <VCol cols="12">
                    <VTextField
                        outlined
                        label="Repeat New Password"
                        :type="newPasswordConfirmShow ? 'text' : 'password'"
                        :append-icon="newPasswordConfirmShow ? 'mdi-eye-off' : 'mdi-eye'"
                        @click:append="newPasswordConfirmShow = !newPasswordConfirmShow"
                        aria-autocomplete="none"
                        :error-messages="newPasswordConfirmationErrors"
                        v-model="newPasswordConfirmation"
                    ></VTextField>
                </VCol>
                <VContainer>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VBtn
                                color="primary"
                                depressed
                                block
                                large
                                @click="onSaveNewPassword"
                            >
                                Save
                            </VBtn>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VBtn
                                color="#eaf3ff"
                                depressed
                                block
                                large
                                @click="showDialog = false"
                            >
                                <span style="color: #2f80ed">Close</span>
                            </VBtn>
                        </VCol>
                    </VRow>
                </VContainer>
            </VCardText>
        </VCard>
        <PasswordChangedDialog
            :visibility="passwordChangedDialog"
            @close-dialog="passwordChangedDialog = false"
        />
    </VDialog>
</template>

<script>
import { mapActions } from 'vuex';
import * as actions from '@/store/modules/user/types/actions';
import { validationMixin } from 'vuelidate';
import {
    required,
    minLength,
    sameAs
} from 'vuelidate/lib/validators';
import PasswordChangedDialog from '@/components/profile/PasswordChangedDialog';
export default {
    name: 'ChangePasswordFormDialog',
    components: {
        PasswordChangedDialog
    },
    data: () => ({
        oldPasswordShow: false,
        newPasswordShow: false,
        newPasswordConfirmShow: false,
        passwordChangedDialog: false,
        oldPassword: '',
        newPassword: '',
        newPasswordConfirmation: '',
        error: ''
    }),
    mixins: [validationMixin],
    validations: {
        oldPassword: { required, minLength: minLength(8) },
        newPassword: { required, minLength: minLength(8) },
        newPasswordConfirmation: { required, sameAsPassword: sameAs('newPassword') }
    },
    props: {
        visibility: {
            required: true
        }
    },
    methods: {
        ...mapActions('user', {
            updateAuthUserPassword: actions.UPDATE_AUTH_USER_PASSWORD
        }),
        async onSaveNewPassword() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                try {
                    await this.updateAuthUserPassword({
                        old_password: this.oldPassword,
                        new_password: this.newPassword,
                        new_password_confirmation: this.newPasswordConfirmation,
                    });
                    this.showDialog = false;
                    this.passwordChangedDialog = true;
                    this.error = '';
                } catch (error) {
                    this.error = error;
                }
            }
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
        oldPasswordErrors() {
            const errors = [];
            if (!this.$v.oldPassword.$dirty) {
                return errors;
            }
            !this.$v.oldPassword.required &&
                errors.push('Old password is required!');
            !this.$v.oldPassword.minLength &&
                errors.push('Old password must be minimum 8 characters!');
            return errors;
        },
        newPasswordErrors() {
            const errors = [];
            if (!this.$v.newPassword.$dirty) {
                return errors;
            }
            !this.$v.newPassword.required &&
                errors.push('New password is required!');
            !this.$v.newPassword.minLength &&
                errors.push('New password must be minimum 8 characters!');
            return errors;
        },
        newPasswordConfirmationErrors() {
            const errors = [];
            if (!this.$v.newPasswordConfirmation.$dirty) {
                return errors;
            }
            !this.$v.newPasswordConfirmation.required &&
                errors.push('Password confirmation is required!');
            !this.$v.newPasswordConfirmation.sameAsPassword &&
                errors.push("Passwords don't match!");
            return errors;
        }
    }
}
</script>

<style scoped>
.error-block {
    border-radius: 5px;
    border: 1px solid #ff5252;
}
.error--text {
    font-size: 16px;
}
.link {
    font-size: 14px;
    color: #2f80ed;
}
</style>