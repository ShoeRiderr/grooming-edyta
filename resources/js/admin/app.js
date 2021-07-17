import VueRouter from 'vue-router';
import router from './routes';

require('./../bootstrap');

window.Vue = require('vue').default;

Vue.use(VueRouter);

const admin = new Vue({
    el: '#admin',
    router
});
