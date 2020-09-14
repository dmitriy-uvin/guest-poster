<template>
    <VCard class="pa-12">
        <span class="mb-6 font-weight-bold d-block card-title">Password recovering</span>
        <div>
            <VTextField
                outlined
                label="Email"
                placeholder="user-email@guest-poster.com"
                :error-messages="emailErrors"
                v-model="userEmail"
            ></VTextField>
        </div>
        <div class="buttons">
            <VBtn block color="blue" large @click="onResetForm">
                RESET PASSWORD
            </VBtn>
            <RouterLink :to="{ name: 'SignIn' }">
                <VBtn
                    block
                    color="#eaf3ff"
                    class="py-2"
                    large
                >
                    BACK TO SIGN IN
                </VBtn>
            </RouterLink>
        </div>
    </VCard>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { required, email } from 'vuelidate/lib/validators';
export default {
    name: 'ForgotPasswordForm',
    mixins: [validationMixin],
    validations: {
        userEmail: { required, email }
    },
    data: () => ({
        userEmail: '',
    }),
    methods: {
        async onResetForm() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                console.log('reset paswd');
            }
        }
    },
    computed: {
        emailErrors() {
            const errors = [];
            if (!this.$v.userEmail.$dirty) {
                return errors;
            }
            !this.$v.userEmail.required &&
                errors.push('Email is required!');
            !this.$v.userEmail.email &&
                errors.push('Email must be valid!');
            return errors;
        },
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