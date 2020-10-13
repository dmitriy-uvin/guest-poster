import Vue from 'vue';
import VueRouter from 'vue-router';
import authService from '@/services/auth/authService';
import store from '@/store';

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
                meta: { notAuthorizedUser: true, layout: 'auth' }
            },
            {
                path: '/sign-up',
                name: 'SignUp',
                component: () => import('../views/SignUp'),
                meta: { notAuthorizedUser: true, layout: 'auth' }
            },
            {
                path: '/forgot-password',
                name: 'ForgotPassword',
                component: () => import('../views/ForgotPassword'),
                meta: { notAuthorizedUser: true, layout: 'auth' }
            },
            {
                path: '/reset-password',
                name: 'ResetPassword',
                component: () => import('../views/ResetPassword'),
                meta: { notAuthorizedUser: true, layout: 'auth' }
            },
            {
                path: '',
                name: 'GuestPosting',
                component: () => import('../views/GuestPosting'),
                meta: { AuthorizedUser: true }
            },
            {
                path: '/verified-email',
                name: 'VerifiedEmail',
                component: () => import('../views/VerifiedEmail'),
                meta: { layout: 'auth' }
            },
            {
                path: '/add-platform',
                name: 'AddPlatform',
                component: () => import('../views/AdminAddPlatform'),
                meta: { AuthorizedUser: true, adminRoute: true }
            },
            {
                path: 'orders',
                name: 'Orders',
                component: () => import('../views/Orders'),
                meta: { AuthorizedUser: true }
            },
            {
                path: 'orders/:id/details',
                name: 'OrderDetails',
                component: () => import('../views/OrderDetails'),
                meta: { AuthorizedUser: true }
            },
            {
                path: 'profile',
                name: 'Profile',
                component: () => import('../views/Profile'),
                meta: { AuthorizedUser: true }
            },
            {
                path: 'export',
                name: 'ExportPlatforms',
                component: () => import('../views/ExportPlatforms'),
                meta: { AuthorizedUser: true, adminRoute: true }
            },
            {
                path: 'import',
                name: 'ImportPlatforms',
                component: () => import('../views/ImportPlatforms'),
                meta: { AuthorizedUser: true, adminRoute: true }
            },
            {
                path: 'trash',
                name: 'Trash',
                component: () => import('../views/Trash'),
                meta: { AuthorizedUser: true, adminRoute: true }
            },
        ]
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

router.beforeEach(
    (to, from, next) => {
        const isAuthorizedUser = to.matched.some(record => record.meta.AuthorizedUser);
        const isUnauthorizedUser = to.matched.some(record => record.meta.notAuthorizedUser);
        const isAdminRoute = to.matched.some(record => record.meta.adminRoute);

        if (isAuthorizedUser && !authService.hasToken()) {
            next({ name: 'SignIn' });
            return;
        }

        if (isAuthorizedUser && authService.hasToken()) {
            next({ path: to });
            return;
        }

        if (isAdminRoute && store.state.user.user?.role === 'admin') {
            next({ path: to });
            return;
        }

        if (isAdminRoute && store.state.user.user?.role !== 'admin') {
            next(false);
            return;
        }

        if (isUnauthorizedUser && authService.hasToken()) {
            next({ name: 'GuestPosting' });
            return;
        }

        next({ path: to});
    },
);

export default router;