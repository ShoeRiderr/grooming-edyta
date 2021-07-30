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
        path: '/admin/groomer-image',
        name: 'admin.groomerImage.index',
        component: require('./components/GroomerImage/Index.vue').default
    },
    {
        path: '/admin/groomer-image/create',
        name: 'admin.groomerImage.create',
        component: require('./components/GroomerImage/Create.vue').default
    },
    {
        path: '/admin/physiotherapy',
        name: 'admin.physiotherapy.index',
        component: require('./components/Physiotherapy/Index.vue').default
    },
    {
        path: '/admin/physiotherapy/create',
        name: 'admin.physiotherapy.create',
        component: require('./components/Physiotherapy/Create.vue').default
    },
    {
        path: '/admin/physiotherapy/:physiotherapyId',
        name: 'admin.physiotherapy.edit',
        component: require('./components/Physiotherapy/Edit.vue').default
    },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;