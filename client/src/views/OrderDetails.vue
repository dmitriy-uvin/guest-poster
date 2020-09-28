<template>
    <AdminOrderDetails v-if="isAdmin" />
    <UserOrderDetails v-else />
</template>

<script>

import UserOrderDetails from '@/components/orders/UserOrderDetails';
import AdminOrderDetails from '@/components/orders/AdminOrderDetails';
import rolemixin from '@/mixins/rolemixin';

export default {
    name: 'OrderDetails',
    components: {
        UserOrderDetails,
        AdminOrderDetails
    },
    mixins: [rolemixin]
}
</script>

<style scoped>

</style>