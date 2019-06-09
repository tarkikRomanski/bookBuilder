require('./bootstrap');
import BootstrapVue from 'bootstrap-vue';
import VueSimplemde from 'vue-simplemde';
import Vuex from 'vuex';

window.Vue = require('vue');

Vue.use(BootstrapVue);
Vue.use(VueSimplemde);
Vue.use(Vuex);

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'simplemde/dist/simplemde.min.css';

import IndexApp from './components/Main';

const app = new Vue({
    el: '#app',
    components: {
        IndexApp,
    }
});
