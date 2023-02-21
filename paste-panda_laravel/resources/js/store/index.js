import {PreviewImageStore} from "./modules/preview_image_store";
import {PageStore} from "./modules/page_store";
import {CssStore} from "./modules/css_store";
import {SectionStore} from "./modules/sections";

export default {

    modules: {
        // PreviewImageStore,
        // PageStore,
        CssStore,
        SectionStore
    },
    state: {
        gridType: 12,
        viewportMode: localStorage.getItem('viewportMode') ? localStorage.getItem('viewportMode') : 'desktop',
    },

    getters: {
        getGridType(state){
            return state.gridType;
        },
        getViewportMode(state){
            return state.viewportMode;
        },
    },

    actions: {
        // getSections(data){
        //     // console.log(this._vm.$inertia);
        //     return this._vm.$inertia.visit("/sections", {
        //         data: data,
        //         only: ["sections", "search", "category", "section_collection", "prod", "draft", "model"],
        //     })
        // },
    },

    mutations: {
        setGridType(state, gridType){
            localStorage.setItem('gridType', gridType);
            state.gridType = gridType;
        },
        setViewportMode(state, viewportMode){
            localStorage.setItem('viewportMode', viewportMode);
            state.viewportMode = viewportMode;
        }
    }
}
