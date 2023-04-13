require('./bootstrap');

import Vue from 'vue';
import router from './router';
import App from './views/App.vue';

Vue.component('main-app', App);

const app = new Vue({
    el: '#app',
    router
});
