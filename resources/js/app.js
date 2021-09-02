import Vue from 'vue';
import VCalendar from 'v-calendar';

require('./bootstrap');

window.Vue = Vue;

Vue.use(VCalendar);

Vue.component('ImageGallery', require('./components/ImageGallery.vue').default);

const app = new Vue({
    el: '#app',
});
