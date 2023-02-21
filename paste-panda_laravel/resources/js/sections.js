/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./CoreUI/', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// const coreUIFiles = require.context('./CoreUI/', true, /\.vue$/i)
// coreUIFiles.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//support vuex
import Vuex from 'vuex'
import storeData from "./store/index"

import VueClipboard from 'vue-clipboard2';
import VueHotkey from 'v-hotkey';
import Notifications from 'vue-notification';
import iframeResize from 'iframe-resizer/js/iframeResizer';
// import ES6 style
import {VueMasonryPlugin} from 'vue-masonry';
import {App, plugin} from '@inertiajs/inertia-vue'
import Vue from 'vue'

Vue.use(Vuex)

Vue.use(VueClipboard);

Vue.use(VueHotkey);

Vue.use(Notifications);


// let Turbolinks = require("turbolinks");
// Turbolinks.start();

Vue.use(require('./CoreUI/UserDropdown'));
Vue.use(require('./CoreUI/BrandMenuSlider'));
Vue.use(require('./CoreUI/SidebarMenuItem'));

Vue.directive('resize', {
    bind: function (el, {value = {}}) {
        el.addEventListener('load', () => iframeResize(value, el))
    }
})

// or using CJS
// const VueMasonryPlugin = require('vue-masonry').VueMasonryPlugin

Vue.use(VueMasonryPlugin);

const store = new Vuex.Store(
    storeData
)

//
// Vue.use(plugin)
//
// const el = document.getElementById('app')
//
// new Vue({
//     store,
//     render: h => h(App, {
//         props: {
//             initialPage: JSON.parse(el.dataset.page),
//             resolveComponent: name => require(`./Pages/${name}`).default,
//         },
//     }),
// }).$mount(el);


const app = new Vue({
    el: '#app',
    store,
    // computed: {
    //     ...mapGetters(['getShowBrandsSidebar', 'getShouldShowSectionLibrary']),
    // },
    // methods: {
    //     ...mapMutations(['setShowBrandsSidebar'])
    // },
    data() {
        return {
            blocks: ['1', '2', '3']
        }
    },
    // router,
});


// const app = new Vue({
//     el: '#app',
//     store,
//     computed: {
//         ...mapGetters(['getShowBrandsSidebar', 'getShouldShowSectionLibrary']),
//     },
//     methods: {
//         ...mapMutations(['setShowBrandsSidebar'])
//     },
//     data() {
//         return {
//             blocks: ['1', '2', '3']
//         }
//     },
//     // router,
// });


// const app = new Vue({
//     el: '#app',
//     store,
//     computed: {
//         ...mapGetters(['getShowBrandsSidebar', 'getShouldShowSectionLibrary']),
//     },
//     methods: {
//         ...mapMutations(['setShowBrandsSidebar'])
//     },
//     data() {
//         return {
//             blocks: ['1', '2', '3']
//         }
//     },
//     // router,
// });
