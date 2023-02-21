require('./bootstrap');

import Vue from 'vue'
import Home from './components/home.vue'


const app = new Vue({
    el: '#home',
    components: {
        "home": Home
    }
});