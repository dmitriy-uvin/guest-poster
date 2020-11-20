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
                    depressed
                >
                    <span v-if="user !== null">Continue Working</span>
                    <span v-else>Back to SignIn</span>
                </VBtn>
            </RouterLink>
        </div>
    </VCard>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import * as actions from '@/store/modules/user/types/actions';
import * as getters from '@/store/modules/user/types/getters';
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
    },
    computed: {
        ...mapGetters('user', {
            user: getters.GET_LOGGED_USER
        })
    }
}
</script>

<style scoped>
.buttons > a {
    text-decoration: none;
}
</style>