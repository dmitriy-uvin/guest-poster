<template>
    <VCard class="pa-12">
        <span class="mb-6 font-weight-bold d-block card-title">Reset Password</span>
        <div>
            <VTextField
                outlined
                label="Password"
                :type="showPassword ? 'text' : 'password'"
                :append-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
                @click:append="showPassword = !showPassword"
                :error-messages="passwordErrors"
                v-model="password"
                id="password"
            ></VTextField>

            <VTextField
                outlined
                label="Confirm Password"
                :type="showPasswordConfirm ? 'text' : 'password'"
                :append-icon="showPasswordConfirm ? 'mdi-eye-off' : 'mdi-eye'"
                @click:append="showPasswordConfirm = !showPasswordConfirm"
                :error-messages="passwordConfirmationErrors"
                v-model="passwordConfirm"
                id="password_confirmation"
            ></VTextField>
        </div>
        <div class="buttons">
            <VBtn
                block
                color="#2f80ed"
                class="mb-6"
                large
                @click="onResetPassword"
                :loading="btnLoad"
            >
                <span class="white--text">SAVE NEW PASSWORD</span>
            </VBtn>
            <div class="divider mb-6"></div>
            <RouterLink :to="{ name: 'SignIn' }">
                <VBtn
                    block
                    color="#eaf3ff"
                    class="py-2"
                    large
                    depressed
                >
                    <span v-if="user !== null">CONTINUE</span>
                    <span v-else>Back to SignIn</span>
                </VBtn>
            </RouterLink>
        </div>
    </VCard>
</template>

<script>
import { validationMixin } from 'vuelidate';
import {required, minLength, sameAs} from 'vuelidate/lib/validators';
import { mapActions, mapGetters } from 'vuex';
import * as actions from '@/store/modules/user/types/actions';
import * as getters from '@/store/modules/user/types/getters';
import * as notifyActions from '@/store/modules/notification/types/actions';

export default {
    name: 'ResetPasswordForm',
    mixins: [validationMixin],
    validations: {
        password: { required, minLength: minLength(8) },
        passwordConfirm: { required, sameAsPassword: sameAs('password') }
    },
    data: () => ({
        showPassword: false,
        showPasswordConfirm: false,
        password: '',
        passwordConfirm: '',
        btnLoad: false
    }),
    methods: {
        ...mapActions('user', {
            resetPassword: actions.RESET_PASSWORD
        }),
        ...mapActions('notification', {
            setNotification: notifyActions.SET_NOTIFICATION
        }),
        async onResetPassword() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                try {
                    this.btnLoad = true;
                    this.resetPassword({
                        password: this.password,
                        password_confirmation: this.passwordConfirm,
                        token: this.$route.query.token,
                        email: this.$route.query.email
                    })
                    this.btnLoad = false;
                    this.passwordConfirm = this.password = '';
                    this.$v.$reset();
                    this.setNotification({
                        message: 'Password was reset! You can Sign In!',
                        type: 'success'
                    });
                } catch (error) {
                    this.setNotification({
                        message: error,
                        type: 'error'
                    });
                    this.btnLoad = false;
                }
            }
        }
    },
    computed: {
        ...mapGetters('user', {
            user: getters.GET_LOGGED_USER
        }),
        passwordErrors() {
            const errors = [];
            if (!this.$v.password.$dirty) {
                return errors;
            }
            !this.$v.password.required &&
                errors.push('Password is required!');
            !this.$v.password.minLength &&
                errors.push('Password must be longer than 8 characters!');
            return errors;
        },
        passwordConfirmationErrors() {
            const errors = [];
            if (!this.$v.passwordConfirm.$dirty) {
                return errors;
            }
            !this.$v.passwordConfirm.required &&
                errors.push('Password confirmation is required!');
            !this.$v.passwordConfirm.sameAsPassword &&
                errors.push("Passwords don't match!");
            return errors;
        }
    }
}
</script>

<style scoped>
.divider {
    border-bottom: 1px solid #f2f2f2;
}
.card-title {
    font-weight: bold;
    font-size: 20px;
}
.buttons > .v-btn {
    margin-bottom: 45px;
    color: white;
}
.buttons > a .v-btn {
    color: #2f80ed;
}
.buttons a {
    text-decoration: none;
}
</style>