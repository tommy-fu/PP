<template>
    <div class="library" style="width: 100%; height: 100%; border: none; overflow-y: scroll; position: relative;">
        <notifications group="foo"
                       position="top right">
            <template slot="body" slot-scope="props">
                <div class="alert alert-active" style="position: absolute; top: 0; right: 32px;">
                    <div class="alert-text-container">
                        <img style="cursor: pointer; margin-right: 12px;" src="/icons/checkmark-rounded.svg" alt="">
                        
                        <div class="body-sm color-d1d1d1 noselect"
                             style="font-family: Inter UI, sans-serif, font-size: 14px; font-weight: 400;">
                            {{ props.item.text }}
                        </div>
                    </div>
                    <img style="cursor: pointer" src="/icons/close-2.svg" alt="" @click="props.close">
                </div>
            </template>
        </notifications>
        <!--		<div class="px-32 py-32" v-if="show">-->
        <div class="px-20" v-if="show">
            <div class="columns is-flex is-multiline">
                <div class="column mt-16" :class="{'is-6': getGridType == 6, 'is-12': getGridType == 12}"
                     v-for="section in sections">
                    <card-item :css="css" :section="section"></card-item>
                </div>
            </div>
            <infinite-loading @infinite="infiniteHandler">
                <div slot="spinner">
                    <div class="skeleton-grid" style="border: none; overflow: hidden; inset: 20px;">
                        <div class="skeleton-item-reveal" style="height: 400px"></div>
<!--                        <div class="skeleton-item" style="height: 400px"></div>-->
<!--                        <div class="skeleton-item" style="height: 800px"></div>-->
<!--                        <div class="skeleton-item" style="height: 600px"></div>-->
                    </div>
                </div>
                <div slot="no-more"></div>
                <div slot="no-results"></div>
            </infinite-loading>
        </div>
        
<!--        <div class="skeleton-grid" style="border: none; overflow: hidden; position: absolute; inset: 20px;" v-else>-->
<!--            <div class="skeleton-item-reveal" style="height: 400px"></div>-->
<!--            <div class="skeleton-item" style="height: 400px"></div>-->
<!--            <div class="skeleton-item" style="height: 800px"></div>-->
<!--            <div class="skeleton-item" style="height: 600px"></div>-->
<!--        </div>-->
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import CardItem from "./CardItem";

export default {
    name: "SectionsLibrary",
    components: {CardItem},
    data() {
        return {
            show: false,
            css: '',
            page: 1,
            sections: []
        }
    },
    computed: {
        ...mapGetters(['getGridType']),
        // sectionsToShow() {
        //     if (this.page * 3 >= this.getSections.length) {
        //         return this.getSections;
        //     }
        //     return this.getSections.slice(0, this.page * 3);
        // }
    },
    methods: {
        reloadFile() {
            this.show = false;
            
            axios.get('/user-brands')
                .then(response => {
                    this.css = response.data;
                    this.show = true;
                });
        },
        infiniteHandler($state) {
            
            let params = {
                page: this.page,
            };
            
            if(this.$page.props.category){
                params.category = this.$page.props.category;
            }
            
            
            axios.get('/my-sections', {
                params: params,
            }).then( response => {
                
                if (response.data.data.length) {
                    
                    this.page += 1;
                    this.sections.push(...response.data.data);
                    $state.loaded();
                }
                else {
                    $state.complete();
                }
            });
        }
    },
    mounted() {
        this.reloadFile();
    },
}
</script>


<style lang="scss">

.ml-12 {
    margin-left: 12px;
}

.px-20 {
    padding: 0 20px;
}

.library {
    &::-webkit-scrollbar {
        width: 0px; /* Remove scrollbar space */
        background: transparent; /* Optional: just make scrollbar invisible */
    }
    
    /* Optional: show position indicator in red */
    &::-webkit-scrollbar-thumb {
        /*background: #FF0000;*/
    }
}

.grid-layout {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    grid-gap: 10px;
    grid-auto-rows: minmax(180px, auto);
    grid-auto-flow: dense;
    padding: 10px;
}

.grid-item {
    padding: 1rem;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    color: #929796;
    /*background-color: #333;*/
    border-radius: 5px;
    background-color: #424242;
}

/*.grid-item :nth-child(odd) {*/
/*    background-color: #424242;*/
/*}*/


.span-2 {
    grid-column-end: span 2;
    grid-row-end: span 2;
}

.span-3 {
    grid-column-end: span 3;
    grid-row-end: span 4;
}


.cardcopybuttonscontainer {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    height: 40px;
    -webkit-box-pack: end;
    -webkit-justify-content: flex-end;
    -ms-flex-pack: end;
    justify-content: flex-end;
    -webkit-box-align: end;
    -webkit-align-items: flex-end;
    -ms-flex-align: end;
    align-items: flex-end;
}


.copyhtmlbutton {
    opacity: 0;
    display: flex;
    height: 40px;
    margin-right: 8px;
    padding-right: 12px;
    padding-left: 12px;
    justify-content: center;
    align-items: center;
    border-radius: 4px;
    background-color: rgba(30, 30, 30, 0.8);
    background-color: #2D2D2D;
    transition: background-color 150ms ease-in-out;
    font-family: Inter, sans-serif;
    color: #fff;
    font-size: 16px;
    line-height: 24px;
    font-weight: 400;
    letter-spacing: 0px;
    text-decoration: none;
}

.copycssbutton {
    display: flex;
    height: 40px;
    padding-right: 16px;
    padding-left: 16px;
    justify-content: center;
    align-items: center;
    border-radius: 4px;
    background-color: rgba(30, 30, 30, 0.8);
    opacity: 0;
    transition: background-color 150ms ease-in-out;
    font-family: Inter, sans-serif;
    color: #fff;
    font-size: 16px;
    line-height: 24px;
    font-weight: 400;
    letter-spacing: 0px;
    text-decoration: none;
    opacity: 0;
}

.copycssbutton:hover {
    background-color: #1e1e1e;
}

.copyhtmlbutton:hover {
    background-color: #1e1e1e;
}

.skeleton-grid {
    /*padding: 32px;*/
    background: #262626;
}

// Section Reveal Transition When Loaded
.skeleton-item-reveal {
    border-radius: 2px;
    background-color: #1c1c1c;
    width: 100%;
    margin-bottom: 24px;
    animation: 450ms reveal ease-in;
}

// Sections Skeleton Load
.skeleton-item {
    border-radius: 2px;
    background-color: #1c1c1c;
    width: 100%;
    margin-bottom: 24px;
    animation: 2250ms skeleton ease-in-out infinite;
}

@keyframes skeleton {
    0%, 15%, 85%, 100% {
        opacity: 1;
    }
    60% {
        opacity: .2;
    }
}

@keyframes reveal {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
</style>
