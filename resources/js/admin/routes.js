import VueRouter from 'vue-router';

const routes = [
    {
        path: '/admin',
        name: 'admin.index',
        component: require('./../components/ExampleComponent.vue').default
    },
    {
        path: '/admin/login',
        name: 'admin.login',
        component: require('./components/Login.vue').default
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;