<template>
    <RouterView></RouterView>
</template>

<script>
import authService from '@/services/auth/authService';
import store from '@/store';
import * as actions from '@/store/modules/user/types/actions';

export default {
    name: "UserDataProvider",
    async beforeRouteEnter(to, from, next) {
        if (authService.hasToken() && !store.state.user.user) {
            await store.dispatch('user/' + actions.FETCH_LOGGED_USER);
            next();
        } else {
            next();
        }
    }
}
</script>

<style scoped>

</style>