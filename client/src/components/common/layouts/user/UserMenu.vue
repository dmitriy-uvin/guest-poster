<template>
    <VMenu offset-y rounded>
        <template v-slot:activator="{ on, attrs }">
            <span
                v-bind="attrs"
                v-on="on"
                class="user-menu"
            >
                {{ name }}
                <VIcon color="#2F80ED">mdi-menu-down</VIcon>
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
                <VIcon left>mdi-logout-variant</VIcon>
                <VListItemTitle>Log Out</VListItemTitle>
            </VListItem>
        </VList>
    </VMenu>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import * as getters from '@/store/modules/user/types/getters';
import * as actions from '@/store/modules/user/types/actions';
import authService from '@/services/auth/authService';
export default {
    name: 'UserMenu',
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
    },
    methods: {
        ...mapActions('user', {
            signOut: actions.SIGN_OUT
        }),
        async onLogOut() {
            await authService.signOut();
            this.signOut();
            this.$router.push({ name: 'SignIn' }).catch(error => {error});
        },
        onProfile() {
            this.$router.push({ name: 'Profile' });
        },
    },
}
</script>

<style scoped>
.user-menu {
    text-transform: uppercase;
    color: #2F80ED;
    font-weight: 500;
    padding: 8px;
    transition: 0.5s;
    border-radius: 5px;
}
.user-menu:hover {
    background: #EAF3FF;
}
.v-list > div {
    cursor: pointer;
}
</style>