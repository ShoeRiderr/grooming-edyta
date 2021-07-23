import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex'
import router from './routes';
import storeElement from './auth/store.js';
import Index from './Index';
import Notifications from 'vue-notification';
import VCalendar from 'v-calendar';

require('./bootstrap');

window.Vue = Vue;

Vue.use(VCalendar);
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
