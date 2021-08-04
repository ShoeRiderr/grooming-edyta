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
    {
        path: '/admin/grooming',
        name: 'admin.grooming.index',
        component: require('./components/Grooming/Index.vue').default
    },
    {
        path: '/admin/grooming/create',
        name: 'admin.grooming.create',
        component: require('./components/Grooming/Create.vue').default
    },
    {
        path: '/admin/grooming/:groomingId',
        name: 'admin.grooming.edit',
        component: require('./components/Grooming/Edit.vue').default
    },
    {
        path: '/admin/dog-hotel',
        name: 'admin.dog-hotel.index',
        component: require('./components/DogHotel/Index.vue').default
    },
    {
        path: '/admin/dog-hotel/create',
        name: 'admin.dog-hotel.create',
        component: require('./components/DogHotel/Create.vue').default
    },
    {
        path: '/admin/dog-hotel/:dogHotelId',
        name: 'admin.dog-hotel.edit',
        component: require('./components/DogHotel/Edit.vue').default
    },
    {
        path: '/admin/about-company/edit',
        name: 'admin.aboutCompany.edit',
        component: require('./components/AboutCompany/Edit.vue').default
    },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;