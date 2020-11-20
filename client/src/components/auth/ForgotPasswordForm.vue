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
            <VBtn
                block
                color="#2f80ed"
                large @click="onResetForm"
                :loading="btnLoad"
                class="mb-6"
                depressed
            >
                <span class="white--text">RESET PASSWORD</span>
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
                    <span v-else>Back to Sign In</span>
                </VBtn>
            </RouterLink>
        </div>
    </VCard>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { required, email } from 'vuelidate/lib/validators';
import { mapActions, mapGetters } from 'vuex';
import * as actions from '@/store/modules/user/types/actions';
import * as getters from '@/store/modules/user/types/getters';
import * as notifyActions from '@/store/modules/notification/types/actions';

export default {
    name: 'ForgotPasswordForm',
    mixins: [validationMixin],
    validations: {
        userEmail: { required, email }
    },
    data: () => ({
        userEmail: '',
        btnLoad: false
    }),
    methods: {
        ...mapActions('user', {
            forgotPassword: actions.FORGOT_PASSWORD
        }),
        ...mapActions('notification', {
            setNotification: notifyActions.SET_NOTIFICATION
        }),
        async onResetForm() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                try {
                    this.btnLoad = true;
                    await this.forgotPassword({
                        email: this.userEmail
                    });
                    this.btnLoad = false;
                    this.userEmail = '';
                    this.$v.$reset();
                    this.setNotification({
                        message: 'Link with instructions was sent!',
                        type: 'success'
                    });
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
            if (!this.$v.userEmail.$dirty) {
                return errors;
            }
            !this.$v.userEmail.required &&
                errors.push('Email is required!');
            !this.$v.userEmail.email &&
                errors.push('Email must be valid!');
            return errors;
        },
        ...mapGetters('user', {
            user: getters.GET_LOGGED_USER
        })
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
.divider {
    border-bottom: 1px solid #f2f2f2;
}
</style>