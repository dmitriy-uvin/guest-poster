<template>
    <AuthLayout>
        <SignUpForm />
    </AuthLayout>
</template>

<script>
import AuthLayout from '@/components/common/AuthLayout';
import SignUpForm from '@/components/auth/SignUpForm';
export default {
    name: 'SignUp',
    components: {
        AuthLayout,
        SignUpForm
    }
}
</script>

<style scoped>

</style>