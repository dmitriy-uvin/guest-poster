<template>
    <VSnackbar
        v-model="notification.visible"
        bottom
        left
        :color="color"
        timeout="3500"
        multi-line
    >
        {{ notification.message }}
        <template v-slot:action="{ attrs }">
            <v-btn
                color="white"
                text
                v-bind="attrs"
                @click="closeSnackbar"
            >
                Close
            </v-btn>
        </template>
    </VSnackbar>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import * as getters from '@/store/modules/notification/types/getters';
import * as actions from '@/store/modules/notification/types/actions';

export default {
    name: 'Alert',
    computed: {
        ...mapGetters('notification', {
            notification: getters.GET_NOTIFICATION
        }),
        color() {
            if (this.notification.type === 'success') {
                return 'green';
            }
            if (this.notification.type === 'error') {
                return 'red';
            }
            return '';
        }
    },
    methods: {
        ...mapActions('notification', {
            removeNotification: actions.REMOVE_NOTIFICATION
        }),
        closeSnackbar() {
            this.removeNotification();
        }
    }
}
</script>

<style scoped>

</style>