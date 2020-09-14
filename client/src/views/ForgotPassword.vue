<template>
    <AuthLayout>
        <ForgotPasswordForm />
    </AuthLayout>
</template>

<script>
import AuthLayout from '@/components/common/AuthLayout';
import ForgotPasswordForm from '@/components/auth/ForgotPasswordForm';
export default {
    name: 'ForgotPassword',
    components: {
        AuthLayout,
        ForgotPasswordForm
    }
}
</script>

<style scoped>

</style>