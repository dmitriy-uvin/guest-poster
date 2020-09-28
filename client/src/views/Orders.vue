<template>
    <AdminOrders v-if="isAdmin"/>
    <UserOrders v-else />
</template>

<script>
import AdminOrders from '@/components/orders/AdminOrders';
import UserOrders from '@/components/orders/UserOrders';
import rolemixin from '@/mixins/rolemixin';

export default {
    name: 'Orders',
    components: {
        AdminOrders,
        UserOrders
    },
    mixins: [rolemixin]
}
</script>

<style scoped>

</style>