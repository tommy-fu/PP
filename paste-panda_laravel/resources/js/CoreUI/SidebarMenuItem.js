import ClickOutside from 'vue-click-outside';
import {mapGetters, mapMutations} from "vuex";

Vue.component('sidebar-menu-item', {

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
        show(){
            this.isActive = true;
        },
        toggle(){
            this.isActive = !this.isActive;
        }
    },
});
