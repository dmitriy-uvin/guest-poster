<template>
    <VCard class="pa-11">
        <span class="mb-6 font-weight-bold d-block card-title">Sign Up</span>
        <div>
            <VTextField
                outlined
                label="Name"
                placeholder="Your name"
                :error-messages="nameErrors"
                v-model="regUserData.name"
            ></VTextField>

            <VTextField
                outlined
                label="Email"
                placeholder="your-email@domain.com"
                :error-messages="emailErrors"
                v-model="regUserData.email"
            ></VTextField>

            <VTextField
                outlined
                label="Password"
                :type="showPassword ? 'text' : 'password'"
                :append-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
                @click:append="showPassword = !showPassword"
                :error-messages="passwordErrors"
                v-model="regUserData.password"
            ></VTextField>

            <VTextField
                outlined
                label="Confirm Password"
                :type="showConfirmPassword ? 'text' : 'password'"
                :append-icon="showConfirmPassword ? 'mdi-eye-off' : 'mdi-eye'"
                @click:append="showConfirmPassword = !showConfirmPassword"
                :error-messages="passwordConfirmationErrors"
                v-model="regUserData.password_confirmation"
            ></VTextField>
        </div>
        <div class="mb-5">
            <span class="subtitle-2">Optional fields:</span>
        </div>
        <div>
            <VTextField
                outlined
                label="Skype"
                append-icon="mdi-skype"
                placeholder="Your skype login"
                v-model="regUserData.skype"
            ></VTextField>
            <VTextField
                outlined
                label="Website"
                append-icon="mdi-earth"
                placeholder="Your website"
                v-model="regUserData.website"
            ></VTextField>
        </div>
        <div class="buttons">
            <VBtn block color="blue" large @click="onSignUp">Sign Up</VBtn>
            <RouterLink :to="{ name: 'SignIn' }">
                <VBtn
                    block
                    color="#eaf3ff"
                    class="py-2"
                    large
                >
                    HAVE AN ACCOUNT?
                </VBtn>
            </RouterLink>
        </div>
    </VCard>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { required, minLength, email, sameAs } from 'vuelidate/lib/validators';
export default {
    name: 'SignUpForm',
    mixins: [validationMixin],
    validations: {
        regUserData: {
            name: { required },
            email: { required, email },
            password: { required, minLength: minLength(8) },
            password_confirmation: { required, sameAsPassword: sameAs('password') }
        }
    },
    data: () => ({
        showPassword: false,
        showConfirmPassword: false,
        regUserData: {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            skype: '',
            website: ''
        }
    }),
    methods: {
        async onSignUp() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                console.log('SignUp');
            }
        }
    },
    computed: {
        nameErrors() {
            const errors = [];
            if (!this.$v.regUserData.name.$dirty) {
                return errors;
            }
            !this.$v.regUserData.name.required &&
                errors.push('Email is required!');
            return errors;
        },
        emailErrors() {
            const errors = [];
            if (!this.$v.regUserData.email.$dirty) {
                return errors;
            }
            !this.$v.regUserData.email.required &&
                errors.push('Email is required!');
            !this.$v.regUserData.email.email &&
                errors.push('Email must be valid!');
            return errors;
        },
        passwordErrors() {
            const errors = [];
            if (!this.$v.regUserData.password.$dirty) {
                return errors;
            }
            !this.$v.regUserData.password.required &&
                errors.push('Password is required!');
            !this.$v.regUserData.password.minLength &&
                errors.push('Password must be longer than 8 characters!');
            return errors;
        },
        passwordConfirmationErrors() {
            const errors = [];
            if (!this.$v.regUserData.password_confirmation.$dirty) {
                return errors;
            }
            !this.$v.regUserData.password_confirmation.required &&
                errors.push('Password confirmation is required!');
            !this.$v.regUserData.password_confirmation.sameAsPassword &&
                errors.push("Passwords don't match!");
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