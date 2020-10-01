import { mapGetters } from 'vuex';
import * as getters from '@/store/modules/user/types/getters';

export default {
    computed: {
        ...mapGetters('user', {
            user: getters.GET_LOGGED_USER
        }),
        isAdmin() {
            if (this.user) {
                return this.user.role === 'admin';
            }
        },
        isUser() {
            if (this.user) {
                return this.user.role === 'user';
            }
        },
        isModerator() {
            if (this.user) {
                return this.user.role === 'moderator';
            }
        }
    }
};