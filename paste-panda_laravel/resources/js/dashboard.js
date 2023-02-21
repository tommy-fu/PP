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

const files = require.context('./admin/', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('toast', require('./components/Toast.vue').default);
Vue.component('image-preview', require('./components/ImagePreview.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//support vuex
import Vuex from 'vuex'
Vue.use(Vuex)
import storeData from "./store/index"

import VueClipboard from 'vue-clipboard2';

Vue.use(VueClipboard);

import VueHotkey from 'v-hotkey';

Vue.use(VueHotkey);

const store = new Vuex.Store(
    storeData
)

import Vue from 'vue'
import VueNestable from 'vue-nestable';

Vue.use(VueNestable)


import VueAwesomeSwiper from 'vue-awesome-swiper'

// import style
// import 'swiper/css/swiper.css'
// If you use Swiper 6.0.0 or higher
import 'swiper/swiper-bundle.css'

Vue.use(VueAwesomeSwiper, /* { default options with global component } */)

import Notifications from 'vue-notification';

Vue.use(Notifications);

const app = new Vue({
    el: '#app',
    store,
    data() {
        return {
            swiperOptions: {
                pagination: {
                    el: '.swiper-pagination'
                },
                slidesPerView: 2.7,
                spaceBetween: 10,
                // Some Swiper option/callback...
            },
            showPreviewImage: false,
            previewImageUrl: '',
            recipient: '',
        }
    },
    methods: {
        setPreviewImage(imageUrl){
            this.previewImageUrl = imageUrl;
            this.showPreviewImage = true;
        },
        copyLink(link) {
            this.$copyText(link).then(() => {
                // this.show = true;
                this.$notify({
                    group: 'toast',
                    title: 'Important message',
                    text: 'You have copied a link!'
                });
            }, function (e) {
                alert('Can not copy');
                console.log(e)
            })
        },
    },
    computed: {
        mailto() {
            console.log(this.recipient);
            console.log(this.$refs.mailbody);
            if(!this.$refs.mailbody) return "mailto:";
            console.log(this.$refs.mailbody.value);
            return 'mailto:' + this.recipient + '?subject=Pastepanda&body=' + this.$refs.mailbody.value;
        }
    },
});
