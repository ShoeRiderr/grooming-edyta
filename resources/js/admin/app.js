import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex'
import router from './routes';
import storeElement from './auth/store.js';
import Index from './Index';
import VCalendar from 'v-calendar';
import Notifications from 'vue-notification';
import Pagination from 'laravel-vue-pagination';

require('./bootstrap');

window.Vue = Vue;

Vue.use(VCalendar);
Vue.use(Notifications)
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.prototype.$siteUrl = '/';

const store = new Vuex.Store(storeElement);

window.axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response.status === 401) {
            store.dispatch('logout');
        }

        return Promise.reject(error);
    }
);

Vue.component('field-errors', require('./components/_partials/FieldErrors.vue').default);

const admin = new Vue({
    el: '#admin',
    router,
    store,
    components: {
        Index,
        Pagination,
    },
    async beforeCreate() {
        this.$store.dispatch('loadUser');
    }
});
