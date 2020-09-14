<template>
    <AuthLayout>
        <SignInForm />
    </AuthLayout>
</template>

<script>
import AuthLayout from '@/components/common/AuthLayout';
import SignInForm from '@/components/auth/SignInForm';
export default {
    name: 'SignIn',
    components: {
        AuthLayout,
        SignInForm
    }
}
</script>

<style scoped>

</style>