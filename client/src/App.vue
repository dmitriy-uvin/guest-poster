<template>
    <VApp>
        <Alert />
        <component :is="layout">
            <RouterView></RouterView>
        </component>
    </VApp>
</template>

<script>
import { mapGetters } from 'vuex';
import * as getters from '@/store/modules/user/types/getters';
import AuthLayout from '@/components/common/AuthLayout';
import UserLayout from '@/components/common/layouts/user/UserLayout';
import AdminLayout from '@/components/common/layouts/admin/AdminLayout';
import ModeratorLayout from '@/components/common/layouts/moderator/ModeratorLayout';
import Alert from '@/components/notification/Alert';
import { pusher } from '@/services/pusher/pusherService';
import notificationMixin from '@/mixins/notificationMixin';
export default {
    name: 'App',
    components: {
        AuthLayout,
        UserLayout,
        AdminLayout,
        ModeratorLayout,
        Alert
    },
    mixins: [notificationMixin],
    computed: {
        ...mapGetters('user', {
            user: getters.GET_LOGGED_USER
        }),
        layout() {
            let layout = 'AuthLayout';
            if (this.user) {
                layout = this.user?.role.charAt(0).toUpperCase() + this.user?.role.slice(1) + 'Layout';
            }
            if (this.$route.meta.layout === 'auth') layout = 'AuthLayout';
            return layout;
        }
    },
    async created() {
        if (this.user?.role === 'admin') {
            const channel = pusher.subscribe('platform-import');
            channel.bind('platform-import-updated', (data) => {
                this.setNotification({
                    type: data.type,
                    message: data.message,
                });
            });
        }
    }
};
</script>