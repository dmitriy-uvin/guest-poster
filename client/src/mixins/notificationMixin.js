import { mapActions } from 'vuex';
import * as actions from '@/store/modules/notification/types/actions';

export default {
    methods: {
        ...mapActions('notification', {
            setNotification: actions.SET_NOTIFICATION
        })
    }
};