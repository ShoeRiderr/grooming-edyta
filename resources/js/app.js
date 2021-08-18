import Vue from 'vue';
import VCalendar from 'v-calendar';

require('./bootstrap');

window.Vue = Vue;

Vue.use(VCalendar);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});

$("a.image").each(function(){$(this).attr('title',$(this).find("img").attr('title'))});
