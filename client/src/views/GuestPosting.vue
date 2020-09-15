<template>
    <div>
        <AdminGuestPosting v-if="isAdmin"/>
        <UserGuestPosting v-else />
    </div>
</template>

<script>
import AdminGuestPosting from '@/components/admin/AdminGuestPosting';
import UserGuestPosting from '@/components/user/UserGuestPosting';
import { mapGetters } from 'vuex';
import * as getters from '@/store/modules/user/types/getters';

export default {
    name: 'GuestPosting',
    components: {
        AdminGuestPosting,
        UserGuestPosting
    },
    computed: {
        ...mapGetters('user', {
            user: getters.GET_LOGGED_USER
        }),
        isAdmin() {
            return this.user.role === 'admin';
        },
    }
}
</script>

<style scoped>

</style>