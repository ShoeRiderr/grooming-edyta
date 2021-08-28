import Vue from 'vue';
import VCalendar from 'v-calendar';

require('./bootstrap');

window.Vue = Vue;

Vue.use(VCalendar);

Vue.component('example-component', require('./components/ImageModal.vue').default);

const app = new Vue({
    el: '#app',
});
