<template>
    <AdminOrders v-if="isAdmin"/>
    <UserOrders v-else />
</template>

<script>
import AdminOrders from '@/components/orders/AdminOrders';
import UserOrders from '@/components/orders/UserOrders';
import { mapGetters } from 'vuex';
import * as getters from '@/store/modules/user/types/getters';

export default {
    name: 'Orders',
    components: {
        AdminOrders,
        UserOrders
    },
    computed: {
        ...mapGetters('user', {
            user: getters.GET_LOGGED_USER
        }),
        isAdmin() {
            return this.user.role === 'admin';
        }
    }
}
</script>

<style scoped>

</style>