import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex'
import router from './routes';
import storeElement from './auth/store.js';
import Index from './Index';
import VCalendar from 'v-calendar';
import Notifications from 'vue-notification';
import Pagination from 'laravel-vue-pagination';
import { isLoggedIn } from '#/admin/auth/auth.js';
import Vue2Editor from 'vue2-editor';

require('./bootstrap');

window.Vue = Vue;

Vue.use(VCalendar);
Vue.use(Notifications)
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(Vue2Editor);
Vue.prototype.$siteUrl = '/';

const store = new Vuex.Store(storeElement);

window.axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (error.response.status === 401) {
            store.dispatch("logout");
            if (router.currentRoute.name != "admin.login") {
                window.location.href = '/';
            }
        }

        return Promise.reject(error);
    }
);

Vue.component('field-errors', require('./components/_partials/FieldErrors.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

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

        if (!isLoggedIn() && this.$router.currentRoute.name != "admin.login") {
            window.location.href = '/';
        }

        if (isLoggedIn() && this.$router.currentRoute.name == "admin.login") {
            this.$router.push({
                name: "admin.index"
            });
        }

        if (!isLoggedIn() && this.$router.currentRoute.name.startsWith('admin') && this.$router.currentRoute.name !== 'admin.login') {
            window.location.replace(this.$siteUrl);
        }
    }
});
