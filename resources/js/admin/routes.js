import VueRouter from 'vue-router';

const routes = [
    {
        path: '/admin',
        name: 'admin.home',
        component: require('./../components/ExampleComponent.vue').default
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;