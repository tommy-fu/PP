import ClickOutside from 'vue-click-outside';

Vue.component('user-dropdown-test', {

    directives: {
        ClickOutside
    },
    data() {
        return {
            isActive: false
        }
    },
    methods: {
        hide() {
            this.isActive = false;
        },
    },
});
