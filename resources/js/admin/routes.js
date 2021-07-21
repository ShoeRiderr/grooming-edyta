import VueRouter from 'vue-router';

const routes = [
    {
        path: '/admin',
        name: 'admin.index',
        component: require('./components/Index.vue').default
    },
    {
        path: '/admin/login',
        name: 'admin.login',
        component: require('./components/Login.vue').default
    },
    {
        path: '/admin/groomer-image/create',
        name: 'admin.groomerImage.create',
        component: require('./components/GroomerImage/Create.vue').default
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;