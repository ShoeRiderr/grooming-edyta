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
    },
    {
        path: '/admin/groomer-image/:groomingImageId/edit',
        name: 'admin.groomerImage.edit',
        component: require('./components/GroomerImage/Edit.vue').default
    },
    {
        path: '/admin/groomer-image',
        name: 'admin.groomerImage.index',
        component: require('./components/GroomerImage/Index.vue').default
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;