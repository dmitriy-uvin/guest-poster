<template>
    <VAppBar color="white">
        <div class="container">
            <VRow class="d-flex justify-space-between">
                <div class="align-center">
                    <VToolbarTitle class="">
                        <img :src="require('@/assets/logo.png')" @click="onMain" class="logo"/>
                    </VToolbarTitle>
                </div>
                <div class="menu-actions">
                    <RouterLink
                        :to="{ name: 'GuestPosting' }"
                        :class="{'link-active': $route.name === 'GuestPosting'}"
                    >
                        Guest Posting
                    </RouterLink>
<!--                    <RouterLink-->
<!--                        :to="{ name: 'NicheEdit' }"-->
<!--                        :class="{'link-active': $route.name === 'NicheEdit'}"-->
<!--                    >-->
<!--                        Niche Edits-->
<!--                    </RouterLink>-->
<!--                    <RouterLink-->
<!--                        :to="{ name: 'Outreach' }"-->
<!--                        :class="{'link-active': $route.name === 'Outreach'}"-->
<!--                    >-->
<!--                        Outreach-->
<!--                    </RouterLink>-->
<!--                    <RouterLink-->
<!--                        :to="{ name: 'Backlinks' }"-->
<!--                        :class="{'link-active': $route.name === 'Backlinks'}"-->
<!--                    >-->
<!--                        Backlinks-->
<!--                    </RouterLink>-->
                    <RouterLink
                        :to="{ name: 'Orders' }"
                        :class="{'link-active': $route.name === 'Orders'}"
                    >
                        Orders
                    </RouterLink>

                    <UserMenu />
                </div>
            </VRow>
        </div>
    </VAppBar>
</template>

<script>
import UserMenu from '@/components/common/layouts/user/UserMenu';
export default {
    name: 'UserHeader',
    components: {
        UserMenu
    },
    methods: {
        onMain() {
            if (this.$route.name !== 'GuestPosting') {
                this.$router.push({ name: 'GuestPosting' });
            }
        }
    }
}
</script>

<style scoped>
.menu-actions > a {
    margin-right: 25px;
    text-decoration: none;
    text-transform: uppercase;
    color: #000;
    padding: 8px;
    transition: 0.5s;
    border-radius: 5px;
    font-weight: 500;
}
.menu-actions > a:hover {
    background: #F2F2F2;
}
.link-active {
    background: #F2F2F2;
}
.logo {
    cursor: pointer;
}
</style>