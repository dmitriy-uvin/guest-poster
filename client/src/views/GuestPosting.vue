<template>
    <AdminGuestPostingComponent v-if="isAdmin"/>
    <GuestPostingComponent v-else/>
</template>

<script>
import rolemixin from '@/mixins/rolemixin';
import AdminGuestPostingComponent from '@/components/admin/AdminGuestPostingComponent';
import GuestPostingComponent from '@/components/guest-posting/GuestPostingComponent';
export default {
    name: 'GuestPosting',
    mixins: [rolemixin],
    components: {
        GuestPostingComponent,
        AdminGuestPostingComponent
    }
}
</script>

<style scoped>

</style>