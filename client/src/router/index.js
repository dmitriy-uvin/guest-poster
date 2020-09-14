import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
    {
        path: '/sign-in',
        name: 'SignIn',
        component: () => import('../views/SignIn')
    },
    {
        path: '/sign-up',
        name: 'SignUp',
        component: () => import('../views/SignUp')
    },
    {
        path: '/forgot-password',
        name: 'ForgotPassword',
        component: () => import('../views/ForgotPassword')
    },
];

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: routes
});

export default router;