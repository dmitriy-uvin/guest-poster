<template>
    <div class="">
        <UserHeader />
        <div class="py-3 gray-bg" v-if="!isEmailVerified">
            <p class="text-center red--text mb-0">Email not confirmed!</p>
        </div>
        <slot></slot>
    </div>
</template>

<script>
import UserHeader from '@/components/common/layouts/user/UserHeader';
import { mapGetters } from 'vuex';
import * as getters from '@/store/modules/user/types/getters';
export default {
    name: 'UserLayout',
    components: {
        UserHeader
    },
    computed: {
        ...mapGetters('user', {
            user: getters.GET_LOGGED_USER
        }),
        isEmailVerified() {
            return this.user.emailVerifiedAt;
        }
    }
}
</script>

<style scoped>
.gray-bg {
    background: #dedede;
}
</style>