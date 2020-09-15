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

export default {
    name: 'VerifiedEmailComponent',
    data: () => ({
        verified: false
    }),
    methods: {
        ...mapActions('user', {
            verifyEmail: actions.VERIFY_EMAIL
        })
    },
    async created() {
        await this.verifyEmail(this.$route.query);
        this.verified = true;
    }
}
</script>

<style scoped>
.buttons > a {
    text-decoration: none;
}
</style>