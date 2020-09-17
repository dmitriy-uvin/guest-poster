import * as getters from '@/store/modules/notification/types/getters';

export default {
    [getters.GET_NOTIFICATION]: state => state.notification
}