import * as mutations from './types/mutations';

export default {
    [mutations.SET_NOTIFICATION]: (state, notification) => {
        state.notification = {
            message: null,
            type: '',
            visible: false
        };
        state.notification = {
            visible: true,
            message: notification.message,
            type: notification.type
        };
    },
    [mutations.REMOVE_NOTIFICATION]: state => {
        state.notification = {
            message: null,
            type: '',
            visible: false
        };
    }
}