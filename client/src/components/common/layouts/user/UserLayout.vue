<template>
    <div class="">
        <UserHeader />
        <slot></slot>
    </div>
</template>

<script>
import UserHeader from '@/components/common/layouts/user/UserHeader';
export default {
    name: 'UserLayout',
    components: {
        UserHeader
    }
}
</script>

<style scoped>

</style>