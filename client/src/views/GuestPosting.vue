<template>
    <GuestPostingComponent />
</template>

<script>
import GuestPostingComponent from '@/components/guest-posting/GuestPostingComponent';
import { mapGetters } from 'vuex';
import * as getters from '@/store/modules/user/types/getters';

export default {
    name: 'GuestPosting',
    components: {
        GuestPostingComponent
    },
    computed: {
        ...mapGetters('user', {
            user: getters.GET_LOGGED_USER
        }),
        isAdmin() {
            return this.user?.role === 'admin';
        },
    }
}
</script>

<style scoped>

</style>