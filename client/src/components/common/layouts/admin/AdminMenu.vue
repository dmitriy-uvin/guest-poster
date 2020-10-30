<template>
    <VMenu offset-y rounded>
        <template v-slot:activator="{ on, attrs }">
            <span
                v-bind="attrs"
                v-on="on"
                class="user-menu"
            >
                {{ name }}
                <VIcon color="#ff430f">mdi-menu-down</VIcon>
            </span>
        </template>
        <VList>
            <VListItem @click="onProfile">
                <VListItemTitle>
                    <VIcon left>mdi-account</VIcon>
                    Profile
                </VListItemTitle>
            </VListItem>
            <VListItem @click="onLogOut">
                <VListItemTitle>
                    <VIcon left>mdi-logout-variant</VIcon>
                    Log Out
                </VListItemTitle>
            </VListItem>
        </VList>
    </VMenu>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import * as getters from '@/store/modules/user/types/getters';
import * as actions from '@/store/modules/user/types/actions';
export default {
    name: 'AdminMenu',
    methods: {
        ...mapActions('user', {
            signOut: actions.SIGN_OUT
        }),
        async onLogOut() {
            await this.signOut();
            // this.$router.push({ name: 'SignIn' });
        },
        onProfile() {
            this.$router.push({ name: 'Profile' });
        }
    },
    computed: {
        ...mapGetters('user', {
            user: getters.GET_LOGGED_USER
        }),
        name() {
            if (Object.keys(this.user).length) {
                return this.user?.name;
            }
            return '';
        }
    }
}
</script>

<style scoped>
.user-menu {
    text-transform: uppercase;
    color: #ff430f;
    font-weight: 500;
    padding: 8px;
    transition: 0.5s;
    border-radius: 5px;
}
.user-menu:hover {
    background: #ffdbcf;
}
.v-list > div {
    cursor: pointer;
}
</style>