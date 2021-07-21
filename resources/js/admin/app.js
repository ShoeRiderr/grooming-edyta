import VueRouter from 'vue-router';
import Vuex from 'vuex'
import router from './routes';
import storeElement from './auth/store.js';
import Index from './Index';
import Notifications from 'vue-notification';

require('./bootstrap');

window.Vue = require('vue').default;

Vue.use(Notifications)
Vue.use(VueRouter);
Vue.use(Vuex);

const store = new Vuex.Store(storeElement);

const admin = new Vue({
    el: '#admin',
    router,
    store,
    components: {
        Index
    },
    async beforeCreate() {
        this.$store.dispatch('loadUser');
    }
});
