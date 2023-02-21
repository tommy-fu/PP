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
                <div class="column mt-16" :class="{'is-6': getGridType === 6, 'is-12': getGridType === 12}"
                     v-for="section in sections">
                    <card-item :css="css" :section="section"></card-item>
                </div>
            </div>
            <infinite-loading @infinite="infiniteHandler" ref="infiniteLoading">
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
    </div>
</template>

<script>
import Layout from "../../../CoreUI/Shared/Layout";
import CardItem from "../../../CoreUI/CardItem";
import {mapGetters} from "vuex";

export default {
    name: "FragmentIndex",
    layout: Layout,
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
        getGridType() {
            return 12;
        },
        // ...mapGetters(['getSections', 'getGridType']),
        sectionsToShow() {
            if (this.page * 3 >= this.getSections.length) {
                return this.getSections;
            }
            return this.getSections.slice(0, this.page * 3);
        }
    },
    methods: {
        loadCssFile() {
            this.show = false;
            
            axios.get('/user-brands')
                .then(response => {
                    this.css = response.data;
                    this.show = true;
                });
        },
        getSections() {
            let params = {
                page: this.page,
            };
            
            if (this.$page.props.category) {
                params.category = this.$page.props.category;
            }
            
            return axios.get('/api/fragments', {
                params: params,
            });
        },
        infiniteHandler($state) {
            this.getSections()
                .then(response => {
                    if (response.data.data.length) {
                        this.page += 1;
                        this.sections.push(...response.data.data);
                        $state.loaded();
                    }
                    else {
                        $state.complete();
                    }
                });
        },
        resetSections(){
            this.page = 1;
            this.sections = [];
            this.$refs.infiniteLoading.stateChanger.reset();
            // this.getSections();
            this.loadCssFile();
        }
    },
    watch: {
        "$page.props.auth.user.brand_id": {
            handler: function (newValue) {
                this.resetSections();
            },
            deep: false
        },
        "$page.props.auth.user.color_scheme_id": {
            handler: function (newValue) {
                this.resetSections();
            },
            deep: false
        }
    },
    mounted() {
        this.loadCssFile();
    },
}
</script>

<style scoped>

</style>
