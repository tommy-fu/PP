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

// const files = require.context('./section-builder/', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const app = new Vue({
    el: '#app',
});
