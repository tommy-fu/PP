/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Pusher = require('pusher-js');

import Echo from 'laravel-echo';

window.Echo = new Echo({
    'broadcaster': 'pusher',
    'key': 'e9503aeec3162f053e27',
    'cluster': 'eu',
    encrypted: true
})

// console.log(window.Echo);
// window.Echo.channel('sections')
//     .listen('SectionUpdated', e => {
//         console.log("Section has been updated");
//     });

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./section-builder/', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//support vuex
import Vuex, {mapGetters} from 'vuex'
Vue.use(Vuex)
import storeData from "./store/index"

import VueClipboard from 'vue-clipboard2';

Vue.use(VueClipboard);


// import Buefy from 'buefy'
// import 'buefy/dist/buefy.css'

// Vue.use(Buefy)

import VueHotkey from 'v-hotkey';

Vue.use(VueHotkey);

const store = new Vuex.Store(
    storeData
)

import Vue from 'vue'
import VueNestable from 'vue-nestable';

Vue.use(VueNestable)

import JsonEditor from 'vue-json-ui-editor';

Vue.use(JsonEditor);


const app = new Vue({
    el: '#section-builder',
    store,
});
