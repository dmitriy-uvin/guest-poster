<template>
    <div class="">
        <AdminHeader />
        <slot></slot>
    </div>
</template>

<script>
import AdminHeader from '@/components/common/layouts/admin/AdminHeader';
export default {
    name: 'AdminLayout',
    components: {
        AdminHeader
    }
}
</script>

<style scoped>

</style>