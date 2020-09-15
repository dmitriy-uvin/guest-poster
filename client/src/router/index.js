import Vue from 'vue';
import VueRouter from 'vue-router';
import authService from '@/services/auth/authService';

Vue.use(VueRouter);
import UserDataProvider from '@/components/guard/UserDataProvider';

const routes = [
    {
        path: '/',
        component: UserDataProvider,
        children: [
            {
                path: '/sign-in',
                name: 'SignIn',
                component: () => import('../views/SignIn'),
                meta: { handleAuth: true, layout: 'auth' }
            },
            {
                path: '/sign-up',
                name: 'SignUp',
                component: () => import('../views/SignUp'),
                meta: { handleAuth: true, layout: 'auth' }
            },
            {
                path: '/forgot-password',
                name: 'ForgotPassword',
                component: () => import('../views/ForgotPassword'),
                meta: { handleAuth: true, layout: 'auth' }
            },
            {
                path: '/reset-password',
                name: 'ResetPassword',
                component: () => import('../views/ResetPassword'),
                meta: { requiresAuth: false, layout: 'auth' }
            },
            {
                path: '/',
                name: 'GuestPosting',
                component: () => import('../views/GuestPosting'),
                meta: { requiresAuth: true }
            },
            {
                path: '/verified-email',
                name: 'VerifiedEmail',
                component: () => import('../views/VerifiedEmail'),
                meta: { requiresAuth: false, layout: 'auth' }
            }
        ]
    }
];

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: routes
});

router.beforeEach(
    (to, from, next) => {
        const isAuthorizedUser = to.matched.some(record => record.meta.requiresAuth);
        const isUnauthorizedUser = to.matched.some(record => record.meta.handleAuth);


        if (isAuthorizedUser && !authService.hasToken()) {
            next({ name: 'SignIn' });
            return;
        }

        if (isUnauthorizedUser && authService.hasToken()) {
            next({ name: 'GuestPosting' });
            return;
        }

        next({ path: to });
    },
);

export default router;