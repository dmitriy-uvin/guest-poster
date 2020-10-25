<template>
    <VCard class="pa-12">
        <div class="text-center mb-6">
            <h3 v-if="!verified">Email verification...</h3>
            <h3 v-else>Your email was verified!</h3>
        </div>

        <div class="buttons">
            <RouterLink :to="{ name: 'SignIn' }">
                <VBtn
                    block
                    color="#eaf3ff"
                    class="py-2"
                    large
                >
                    CONTINUE WORKING
                </VBtn>
            </RouterLink>
        </div>
    </VCard>
</template>

<script>
import { mapActions } from 'vuex';
import * as actions from '@/store/modules/user/types/actions';
import notificationMixin from '@/mixins/notificationMixin';
import authService from '@/services/auth/authService';

export default {
    name: 'VerifiedEmailComponent',
    mixins: [notificationMixin],
    data: () => ({
        verified: false
    }),
    methods: {
        ...mapActions('user', {
            verifyEmail: actions.VERIFY_EMAIL,
            fetchLoggedUser: actions.FETCH_LOGGED_USER
        }),
    },
    async created() {
        try {
            await this.verifyEmail(this.$route.query);
            if (authService.hasToken()) {
                await this.fetchLoggedUser();
            }
            this.verified = true;
            this.setNotification({
                message: 'Email was verified!',
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
</script>

<style scoped>
.buttons > a {
    text-decoration: none;
}
</style>