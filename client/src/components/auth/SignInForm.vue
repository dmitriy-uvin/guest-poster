<template>
    <VCard class="pa-12">
        <span class="mb-6 font-weight-bold d-block card-title">Log In to your account</span>
        <div>
            <VTextField
                outlined
                label="Email"
                placeholder="user-email@guest-poster.com"
                v-model="userData.email"
                :error-messages="emailErrors"
            ></VTextField>

            <VTextField
                outlined
                label="Password"
                :type="showPassword ? 'text' : 'password'"
                :append-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
                @click:append="showPassword = !showPassword"
                v-model="userData.password"
                :error-messages="passwordErrors"
            ></VTextField>
        </div>
        <div class="pb-7">
            <RouterLink :to="{ name: 'ForgotPassword' }" class="forgot-password">Forgot password?</RouterLink>
        </div>
        <div class="buttons">
            <VBtn block color="blue" large @click="onSignIn">Sign In</VBtn>
            <RouterLink :to="{ name: 'SignUp' }">
                <VBtn
                    block
                    color="#eaf3ff"
                    class="py-2"
                    large
                >
                    DON'T HAVE AN ACCOUNT?
                </VBtn>
            </RouterLink>

        </div>
    </VCard>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { required, minLength, email } from 'vuelidate/lib/validators';
import { mapActions } from 'vuex';
import * as actions from '@/store/modules/user/types/actions';
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
        ...mapActions('user', {
            signIn: actions.SIGN_IN
        }),
        async onSignIn() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                await this.signIn(this.userData);
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
.forgot-password {
    color: #828282;
    text-decoration: underline;
}
.v-card {
    border-radius: 10px;
}
</style>