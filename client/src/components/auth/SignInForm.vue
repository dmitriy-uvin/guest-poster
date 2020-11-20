<template>
    <VCard class="pb-10 pl-12 pr-12 pt-12">
        <VForm @submit.prevent="onSignIn">
            <span class="mb-6 font-weight-bold d-block card-title">Log In to your account</span>
            <div class="mb-0 mt-0">
                <VTextField
                    outlined
                    label="Email"
                    v-model="userData.email"
                    :error-messages="emailErrors"
                    id="email"
                    aria-autocomplete="none"
                ></VTextField>
                <VTextField
                    outlined
                    label="Password"
                    :type="showPassword ? 'text' : 'password'"
                    :append-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
                    @click:append="showPassword = !showPassword"
                    v-model="userData.password"
                    :error-messages="passwordErrors"
                    id="password"
                    aria-autocomplete="none"
                ></VTextField>
            </div>
            <div class="mb-6">
                <RouterLink
                    :to="{ name: 'ForgotPassword' }"
                    class="forgot-password"
                >
                    Forgot password?
                </RouterLink>
            </div>
            <div class="buttons">
                <VBtn block
                      color="#2f80ed"
                      large
                      type="submit"
                      depressed
                      class="mb-6"
                >
                    <span class="white--text">Sign In</span>
                </VBtn>
                <div class="divider mb-6"></div>
                <RouterLink :to="{ name: 'SignUp' }">
                    <VBtn
                        block
                        color="#eaf3ff"
                        depressed
                        class="py-2"
                        large
                    >
                        DON'T HAVE AN ACCOUNT?
                    </VBtn>
                </RouterLink>
            </div>
        </VForm>
    </VCard>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { required, minLength, email } from 'vuelidate/lib/validators';
import { mapActions } from 'vuex';
import * as actions from '@/store/modules/user/types/actions';
import * as notifyActions from '@/store/modules/notification/types/actions';

export default {
    name: 'SignInForm',
    mixins: [validationMixin],
    validations: {
        userData: {
            email: { required, email },
            password: { required, minLength: minLength(8) }
        }
    },
    data: () => ({
        showPassword: false,
        userData: {
            email: '',
            password: ''
        },
        validForm: true
    }),
    methods: {
        ...mapActions('notification', {
            setNotification: notifyActions.SET_NOTIFICATION
        }),
        ...mapActions('user', {
            signIn: actions.SIGN_IN
        }),
        async onSignIn() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                try {
                    await this.signIn(this.userData);
                    this.setNotification({
                        message: 'Welcome!',
                        type: 'success'
                    });
                    this.$router.push({ name: 'GuestPosting' }).catch(error => {error});
                } catch (error) {
                    this.setNotification({
                        message: error,
                        type: 'error'
                    });
                }
            }
        }
    },
    computed: {
        emailErrors() {
            const errors = [];
            if (!this.$v.userData.email.$dirty) {
                return errors;
            }
            !this.$v.userData.email.required &&
                errors.push('Email is required!');
            !this.$v.userData.email.email &&
                errors.push('Email must be valid!');
            return errors;
        },
        passwordErrors() {
            const errors = [];
            if (!this.$v.userData.password.$dirty) {
                return errors;
            }
            !this.$v.userData.password.required &&
                errors.push('Password is required!');
            !this.$v.userData.password.minLength &&
                errors.push('Password must be longer than 8 characters!');
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
    line-height: 24px;
    color: #333333;
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
.forgot-password {
    color: #828282;
    font-size: 14px;
    line-height: 16px;
    text-decoration: underline;
}
.v-card {
    border-radius: 8px;
}
</style>