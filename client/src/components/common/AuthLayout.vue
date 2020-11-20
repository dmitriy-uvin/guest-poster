<template>
    <VApp class="auth-bg">
        <div class="text-center app-logo">
            <RouterLink :to="{ name: 'SignIn' }">
                <img src="../../assets/login-logo.png" alt="Guest Poster Logo" class="mb-10">
            </RouterLink>
        </div>
        <div class="d-flex align-center justify-center">
            <VCol cols="12" md="4" sm="12" lg="4">
                <div class="elevation-1 content">
                    <slot></slot>
                </div>
            </VCol>
        </div>
    </VApp>
</template>

<script>
export default {
    name: 'AuthLayout'
}
</script>

<style scoped>
.auth-bg {
    background: #f9f9f9;
    width: 100%;
    height: 100%;
    overflow-y: hidden;
}
.app-logo {
    margin-top: 40px;
}
.content {
    border-radius: 10px;
}
.card-title {
    font-weight: bold;
    font-size: 20px;
}
.buttons > .v-btn {
    margin-bottom: 45px;
    color: white;
}
.buttons > a .v-btn {
    color: #2f80ed;
}
.buttons a {
    text-decoration: none;
}
.forgot-password {
    color: #828282;
    text-decoration: underline;
}
.v-card {
    border-radius: 10px;
}
</style>