import { mapGetters } from 'vuex';
import * as getters from '@/store/modules/user/types/getters';

export default {
    computed: {
        ...mapGetters('user', {
            user: getters.GET_LOGGED_USER
        }),
        isAdmin() {
            return this.user.role === 'admin';
        },
        isUser() {
            return this.user.role === 'user';
        },
        isModerator() {
            return this.user.role === 'moderator';
        }
    }
};