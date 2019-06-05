/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import BootstrapVue from 'bootstrap-vue';
import VueSimplemde from 'vue-simplemde';

window.Vue = require('vue');

Vue.use(BootstrapVue);
Vue.use(VueSimplemde);

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'simplemde/dist/simplemde.min.css';

import BookForm from './components/books/form';

const app = new Vue({
    el: '#app',
    components: {
        BookForm,
    }
});
