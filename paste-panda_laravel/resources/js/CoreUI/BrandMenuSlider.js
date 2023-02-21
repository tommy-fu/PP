import ClickOutside from 'vue-click-outside';
import {mapGetters, mapMutations} from "vuex";

Vue.component('brand-menu-slider', {

    directives: {
        ClickOutside
    },
    data() {
        return {
            isActive: true
        }
    },
    methods: {
        hide() {
            // this.isActive = false;
            // if(this.getShowBrandsSidebar){
            //     this.setShowBrandsSidebar(false);
            // }
        },
        ...mapMutations(['setShowBrandsSidebar'])
    },
    computed: {
        ...mapGetters(['getShowBrandsSidebar']),
    },
});
