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
        <div class="px-20" v-if="show">
            <div class="columns is-flex is-multiline">
                <div class="column mt-16" :class="{'is-6': getGridType === 6, 'is-12': getGridType === 12}"
                     v-bind:key="section.id"
                     v-for="section in getSections">
                    <card-item :section="section"></card-item>
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
import SectionQueryBuilder from "./SectionQueryBuilder";
import {mapActions, mapGetters, mapMutations, mapState} from "vuex";

export default {
    name: "SectionsIndex",
    layout: Layout,
    components: {CardItem},
    data() {
        return {
            page: 1,
        }
    },
    computed: {
        getGridType() {
            return 12;
        },
        show() {
            return this.getUserCss.length > 0;
        },
        shouldReset() {
            console.log(this.getShouldResetSections);
            return this.getShouldResetSections;
        },
        ...mapState(['shouldResetSections']),
        ...mapGetters(['getUserCss', 'getSections', 'getShouldResetSections'])
    },
    methods: {
        ...mapActions(['fetchUserCss', 'fetchSections', 'emptySections', 'setShouldResetSections']),
        ...mapMutations(['SET_CSS']),
        infiniteHandler($state) {
            const queryBuilder = new SectionQueryBuilder(this.$page.props);
            
            const params = queryBuilder.getParameters(this.page);
            
            this.fetchSections(params)
                .then(() => {
                    this.page += 1;
                    $state.loaded();
                })
                .catch(() => {
                    $state.complete();
                });
        },
        resetSections() {
            this.page = 1;
            this.emptySections();
            this.SET_CSS('');
            this.$refs.infiniteLoading.stateChanger.reset();
            // this.getSections();
            this.fetchUserCss();
            this.setShouldResetSections(false);
        }
    },
    watch: {
        getShouldResetSections: function (bool) {
            if(bool === true) {
                this.resetSections();
            }
        },
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
        this.fetchUserCss();
    },
}
</script>
