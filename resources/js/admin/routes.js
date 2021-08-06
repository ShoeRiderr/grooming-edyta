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
        path: '/admin/physiotherapy/edit',
        name: 'admin.physiotherapy.edit',
        component: require('./components/Physiotherapy/Edit.vue').default
    },

    {
        path: '/admin/grooming',
        name: 'admin.grooming.index',
        component: require('./components/Grooming/Index.vue').default
    },
    {
        path: '/admin/grooming/edit',
        name: 'admin.grooming.edit',
        component: require('./components/Grooming/Edit.vue').default
    },

    {
        path: '/admin/dog-hotel',
        name: 'admin.dogHotel.index',
        component: require('./components/DogHotel/Index.vue').default
    },
    {
        path: '/admin/dog-hotel/edit',
        name: 'admin.dogHotel.edit',
        component: require('./components/DogHotel/Edit.vue').default
    },

    {
        path: '/admin/about-company/edit',
        name: 'admin.aboutCompany.edit',
        component: require('./components/AboutCompany/Edit.vue').default
    },

    {
        path: '/admin/contact/edit',
        name: 'admin.contact.edit',
        component: require('./components/Contact/Edit.vue').default
    },

    // Post
    {
        path: '/admin/physiotherapy/post/create',
        name: 'admin.physiotherapy.post.create',
        component: require('./components/Physiotherapy/Post/Create.vue').default
    },
    {
        path: '/admin/physiotherapy/post/:id',
        name: 'admin.physiotherapy.post.edit',
        component: require('./components/Physiotherapy/Post/Edit.vue').default
    },

    {
        path: '/admin/grooming/post/create',
        name: 'admin.grooming.post.create',
        component: require('./components/Grooming/Post/Create.vue').default
    },
    {
        path: '/admin/grooming/post/:id',
        name: 'admin.grooming.post.edit',
        component: require('./components/Grooming/Post/Edit.vue').default
    },

    {
        path: '/admin/dog-hotel/post/create',
        name: 'admin.dogHotel.post.create',
        component: require('./components/DogHotel/Post/Create.vue').default
    },
    {
        path: '/admin/dog-hotel/post/:id',
        name: 'admin.dogHotel.post.edit',
        component: require('./components/DogHotel/Post/Edit.vue').default
    },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;