<template>
    <VMenu offset-y>
        <template v-slot:activator="{ on, attrs }">
            <span
                v-bind="attrs"
                v-on="on"
                class="user-menu"
            >
                {{ user.name }}
                <VIcon color="#2F80ED">mdi-menu-down</VIcon>
            </span>
        </template>
        <VList>
            <VListItem>
                <VListItemTitle>Profile</VListItemTitle>
            </VListItem>
            <VListItem @click="onLogOut">
                <VListItemTitle>Log Out</VListItemTitle>
            </VListItem>
        </VList>
    </VMenu>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import * as getters from '@/store/modules/user/types/getters';
import * as actions from '@/store/modules/user/types/actions';
export default {
    name: "UserMenu",
    computed: {
        ...mapGetters('user', {
            user: getters.GET_LOGGED_USER
        })
    },
    methods: {
        ...mapActions('user', {
            signOut: actions.SIGN_OUT
        }),
        async onLogOut() {
            await this.signOut();
            this.$router.push({ name: 'SignIn' });
        }
    }
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
</style>