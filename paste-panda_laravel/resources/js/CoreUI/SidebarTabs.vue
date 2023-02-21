<template>
	<div>
		<div class="tab-container" style="position: sticky; background: #1C1C1C;">
			<div class="tab-underline tab-underline--active" :style="tabUnderlinePosition"></div>
			<div class="tab-item" @click="tabIndex = 0" :class="{'tab-item--active' : tabIndex === 0}">
				<svg-icon :icon="'code'" :fill="tabIndex === 0 ? '#ffffff' : '#808080'" :size="26"></svg-icon>
			</div>
			<div class="tab-item" @click="tabIndex = 1" :class="{'tab-item--active' : tabIndex === 1}">
				<svg-icon :icon="'style'" :fill="tabIndex === 1 ? '#ffffff' : '#808080'" :size="26"></svg-icon>
			</div>
			<div class="tab-item" @click="tabIndex = 2" :class="{'tab-item--active' : tabIndex === 2}">
				<svg-icon :icon="'color-gray'" :fill="tabIndex === 2 ? '#ffffff' : '#808080'" :size="26"></svg-icon>
			</div>
		</div>
		<div class="left-bar has-no-scroll" style="position: sticky; padding-bottom: 240px; overflow-y: scroll; background: #1C1C1C;">
			
		
			<CodeTabItem v-if="tabIndex === 0"></CodeTabItem>
			
<!--			&lt;!&ndash; SECTIONS &ndash;&gt;-->
<!--			<SectionItem v-if="tabIndex === 0"></SectionItem>-->
			<!-- STYLES -->
			<StyleItem v-if="tabIndex === 1">></StyleItem>
			<!-- COLORS -->
			<ColorItem v-if="tabIndex === 2">></ColorItem>
		</div>

		
	</div>
</template>

<script>
    // import ApplyStyleCard from "./ApplyStyleCard";
    import {mapGetters} from "vuex";
    import BrandsTab from "./BrandsTab";
    import SidebarTab from "./SidebarTab";
    import SectionItem from "../components/SectionItem";
    import StyleItem from "../components/StyleItem";
    import ColorItem from "../components/ColorItem";
    import CodePicker from "../components/CodePicker";
    import vClickOutside from "v-click-outside";
    import CodeTabItem from "./Components/CodeTabItem";
    import SvgIcon from "./Components/SvgIcon";

    export default {
        name: "SectionSidebar",
        components: {SvgIcon, CodeTabItem, CodePicker, ColorItem, StyleItem, SectionItem, SidebarTab, BrandsTab},
        data() {
            return {
                tabIndex: 0,
                menuActive: false
            }
        },
        directives: {
            clickOutside: vClickOutside.directive
        },
        methods: {
            hideMenu() {
                if (this.menuActive) {
                    this.menuActive = false;
                }
            },
            getSectionsUrl(slug) {
                if (slug) return '/sections?category=' + slug;
                else return '/sections';
            },
            resetOnboarding() {
                this.$inertia.patch('/user-onboarding/', {
                    'show_onboarding': 1
                });

                this.menuActive = false;
            },
            logout() {
                this.$inertia.visit('/logout');

                this.menuActive = false;
            }
        },
        watch: {
            tabIndex(newValue, oldValue) {
                localStorage.setItem('section_tab_index', newValue);
            }
        },
        computed: {
            // ...mapGetters(['getCategories', 'getActiveCategory', 'getUserProgrammingLanguage']),
            tabUnderlinePosition(){
                if(this.tabIndex === 0) return {
                    'right': '66.66%'
                }

                if(this.tabIndex === 1) return {
                    'right': '33.33%'
                }

                if(this.tabIndex === 2) return {
                    'right': '0'
                }
            }
        },
        mounted() {
            this.tabIndex = localStorage.getItem('section_tab_index') ? parseInt(localStorage.getItem('section_tab_index')) : 0;
        }
    }
</script>

<!--<style scoped>-->
<!--	-->
<!--	.section {-->
<!--		display: -webkit-box;-->
<!--		display: -webkit-flex;-->
<!--		display: -ms-flexbox;-->
<!--		display: flex;-->
<!--		width: 100%;-->
<!--		height: 100vh;-->
<!--		-webkit-justify-content: space-around;-->
<!--		-ms-flex-pack: distribute;-->
<!--		justify-content: space-around;-->
<!--		background-color: #1c1c1c;-->
<!--	}-->
<!--	-->
<!--	.sidebar {-->
<!--		display: -webkit-box;-->
<!--		display: -webkit-flex;-->
<!--		display: -ms-flexbox;-->
<!--		display: flex;-->
<!--		width: 272px;-->
<!--		height: 100vh;-->
<!--		-webkit-box-orient: vertical;-->
<!--		-webkit-box-direction: normal;-->
<!--		-webkit-flex-direction: column;-->
<!--		-ms-flex-direction: column;-->
<!--		flex-direction: column;-->
<!--		-webkit-box-align: start;-->
<!--		-webkit-align-items: flex-start;-->
<!--		-ms-flex-align: start;-->
<!--		align-items: flex-start;-->
<!--		background-color: #1c1c1c;-->
<!--	}-->
<!--	-->
<!--	.h4 {-->
<!--		margin-top: 0px;-->
<!--		margin-bottom: 0px;-->
<!--		font-family: Inter, sans-serif;-->
<!--		font-size: 15px;-->
<!--		font-weight: 400;-->
<!--	}-->
<!--	-->
<!--	.body-sm {-->
<!--		font-family: Inter, sans-serif;-->
<!--		font-size: 13px;-->
<!--	}-->
<!--	-->
<!--	.btn-outlined {-->
<!--		display: -webkit-box;-->
<!--		display: -webkit-flex;-->
<!--		display: -ms-flexbox;-->
<!--		display: flex;-->
<!--		width: 100%;-->
<!--		height: 40px;-->
<!--		-webkit-box-pack: center;-->
<!--		-webkit-justify-content: center;-->
<!--		-ms-flex-pack: center;-->
<!--		justify-content: center;-->
<!--		-webkit-box-align: center;-->
<!--		-webkit-align-items: center;-->
<!--		-ms-flex-align: center;-->
<!--		align-items: center;-->
<!--		border: 1px solid #383838;-->
<!--		border-radius: 6px;-->
<!--		background-color: #212121;-->
<!--		-webkit-transition: color 100ms ease-in, border-color 100ms ease-in;-->
<!--		transition: color 100ms ease-in, border-color 100ms ease-in;-->
<!--		font-family: Inter, sans-serif;-->
<!--		color: #a3a3a3;-->
<!--		text-decoration: none;-->
<!--	}-->
<!--	-->
<!--	.btn-outlined:hover {-->
<!--		background-color: #2d2d2d;-->
<!--		color: #fff;-->
<!--	}-->
<!--	-->
<!--	.color-d1d1d1 {-->
<!--		color: #d1d1d1;-->
<!--	}-->
<!--	-->
<!--	.color-a3a3a3 {-->
<!--		color: #a3a3a3;-->
<!--	}-->
<!--	-->
<!--	.modal {-->
<!--		position: relative;-->
<!--		width: 352px;-->
<!--		padding-right: 24px;-->
<!--		padding-bottom: 24px;-->
<!--		padding-left: 24px;-->
<!--		border-style: solid;-->
<!--		border-width: 1px;-->
<!--		border-color: #2c2c2c;-->
<!--		border-radius: 8px;-->
<!--		background-color: #262626;-->
<!--		box-shadow: 0 56px 72px 0 rgba(0, 0, 0, 0.5);-->
<!--	}-->
<!--	-->
<!--	.modal-title-container {-->
<!--		position: relative;-->
<!--		display: -webkit-box;-->
<!--		display: -webkit-flex;-->
<!--		display: -ms-flexbox;-->
<!--		display: flex;-->
<!--		width: 100%;-->
<!--		height: 48px;-->
<!--		-webkit-box-pack: justify;-->
<!--		-webkit-justify-content: space-between;-->
<!--		-ms-flex-pack: justify;-->
<!--		justify-content: space-between;-->
<!--		-webkit-box-align: center;-->
<!--		-webkit-align-items: center;-->
<!--		-ms-flex-align: center;-->
<!--		align-items: center;-->
<!--	}-->
<!--	-->
<!--	.code-item-container {-->
<!--		display: -webkit-box;-->
<!--		display: -webkit-flex;-->
<!--		display: -ms-flexbox;-->
<!--		display: flex;-->
<!--		width: 100%;-->
<!--		-webkit-box-pack: justify;-->
<!--		-webkit-justify-content: space-between;-->
<!--		-ms-flex-pack: justify;-->
<!--		justify-content: space-between;-->
<!--		-webkit-box-align: center;-->
<!--		-webkit-align-items: center;-->
<!--		-ms-flex-align: center;-->
<!--		align-items: center;-->
<!--		border-radius: 8px;-->
<!--	}-->
<!--	-->
<!--	.html-btns-container {-->
<!--		display: -webkit-box;-->
<!--		display: -webkit-flex;-->
<!--		display: -ms-flexbox;-->
<!--		display: flex;-->
<!--		height: 40px;-->
<!--	}-->
<!--	-->
<!--	.code-btn {-->
<!--		display: -webkit-box;-->
<!--		display: -webkit-flex;-->
<!--		display: -ms-flexbox;-->
<!--		display: flex;-->
<!--		width: 40px;-->
<!--		height: 40px;-->
<!--		margin-left: 12px;-->
<!--		-webkit-box-pack: center;-->
<!--		-webkit-justify-content: center;-->
<!--		-ms-flex-pack: center;-->
<!--		justify-content: center;-->
<!--		-webkit-box-align: center;-->
<!--		-webkit-align-items: center;-->
<!--		-ms-flex-align: center;-->
<!--		align-items: center;-->
<!--		border: 1px solid #535353;-->
<!--		border-radius: 8px;-->
<!--		background-color: #404040;-->
<!--		-webkit-transition: background-color 50ms ease-in;-->
<!--		transition: background-color 50ms ease-in;-->
<!--	}-->
<!--	-->
<!--	.code-btn:hover {-->
<!--		border-color: #fff;-->
<!--	}-->
<!--	-->
<!--	.code-btn.code-btn&#45;&#45;active {-->
<!--		border-color: #1592ff;-->
<!--		background-color: #2c3d4c;-->
<!--		cursor: default;-->
<!--	}-->
<!--	-->
<!--	.code-btn.code-btn&#45;&#45;disabled {-->
<!--		border-color: #383838;-->
<!--		background-color: #2d2d2d;-->
<!--		cursor: default;-->
<!--	}-->
<!--	-->
<!--	.modal-divider {-->
<!--		position: absolute;-->
<!--		left: -24px;-->
<!--		right: -24px;-->
<!--		bottom: 0px;-->
<!--		height: 1px;-->
<!--	}-->
<!--	-->
<!--	.icon-exit {-->
<!--		position: absolute;-->
<!--		top: 16px;-->
<!--		right: 16px;-->
<!--		z-index: 2;-->
<!--		width: 24px;-->
<!--		height: 24px;-->
<!--		border-radius: 16px;-->
<!--		-webkit-transition: background-color 50ms ease-in;-->
<!--		transition: background-color 50ms ease-in;-->
<!--	}-->
<!--	-->
<!--	.icon-exit:hover {-->
<!--		background-color: #2d2d2d;-->
<!--	}-->
<!--	-->
<!--	.bg-temp-color-divider-dark {-->
<!--		background-color: #2e2e2e;-->
<!--	}-->
<!--	-->
<!--	.mb-24 {-->
<!--		margin-bottom: 24px;-->
<!--	}-->
<!--	-->
<!--	.sidebar-top {-->
<!--		display: -webkit-box;-->
<!--		display: -webkit-flex;-->
<!--		display: -ms-flexbox;-->
<!--		display: flex;-->
<!--		/*width: 312px;*/-->
<!--		height: 80px;-->
<!--		margin-right: 20px;-->
<!--		margin-left: 20px;-->
<!--		-webkit-box-pack: justify;-->
<!--		-webkit-justify-content: space-between;-->
<!--		-ms-flex-pack: justify;-->
<!--		justify-content: space-between;-->
<!--		-webkit-box-align: center;-->
<!--		-webkit-align-items: center;-->
<!--		-ms-flex-align: center;-->
<!--		align-items: center;-->
<!--		border-bottom: 1px solid #262626;-->
<!--	}-->
<!--	-->
<!--	.nav-btn {-->
<!--		display: -webkit-box;-->
<!--		display: -webkit-flex;-->
<!--		display: -ms-flexbox;-->
<!--		display: flex;-->
<!--		width: 40px;-->
<!--		height: 40px;-->
<!--		-webkit-box-pack: center;-->
<!--		-webkit-justify-content: center;-->
<!--		-ms-flex-pack: center;-->
<!--		justify-content: center;-->
<!--		-webkit-box-align: center;-->
<!--		-webkit-align-items: center;-->
<!--		-ms-flex-align: center;-->
<!--		align-items: center;-->
<!--		border-radius: 20px;-->
<!--		-webkit-transition: opacity 200ms ease-in-out;-->
<!--		transition: opacity 200ms ease-in-out;-->
<!--		cursor: pointer;-->
<!--	}-->
<!--	-->
<!--	.nav-btn:hover {-->
<!--		background-color: #282828;-->
<!--	}-->
<!--	-->
<!--	.settings-wrapper {-->
<!--		display: -webkit-box;-->
<!--		display: -webkit-flex;-->
<!--		display: -ms-flexbox;-->
<!--		display: flex;-->
<!--		-webkit-box-align: center;-->
<!--		-webkit-align-items: center;-->
<!--		-ms-flex-align: center;-->
<!--		align-items: center;-->
<!--	}-->
<!--	-->
<!--	.nav-stripes-wrapper {-->
<!--		display: -webkit-box;-->
<!--		display: -webkit-flex;-->
<!--		display: -ms-flexbox;-->
<!--		display: flex;-->
<!--		width: 16px;-->
<!--		height: 16px;-->
<!--		-webkit-box-orient: vertical;-->
<!--		-webkit-box-direction: normal;-->
<!--		-webkit-flex-direction: column;-->
<!--		-ms-flex-direction: column;-->
<!--		flex-direction: column;-->
<!--		-webkit-box-align: center;-->
<!--		-webkit-align-items: center;-->
<!--		-ms-flex-align: center;-->
<!--		align-items: center;-->
<!--	}-->
<!--	-->
<!--	.nav-stripe {-->
<!--		width: 16px;-->
<!--		height: 2px;-->
<!--		margin-bottom: 4px;-->
<!--		background-color: #5f5f5f;-->
<!--	}-->
<!--	-->
<!--	.nav-stripe.nav-stripe&#45;&#45;last {-->
<!--		margin-bottom: 0px;-->
<!--	}-->
<!--	-->
<!--	.code-icon {-->
<!--		width: 20px;-->
<!--		height: 20px;-->
<!--	}-->
<!--	-->
<!--	.mt-12 {-->
<!--		margin-top: 12px;-->
<!--	}-->
<!--	-->
<!--	.copy-icon {-->
<!--		height: 9px;-->
<!--		margin-left: 12px;-->
<!--	}-->
<!--	-->
<!--	.icon-exit-2 {-->
<!--		position: absolute;-->
<!--		top: 12px;-->
<!--		right: 12px;-->
<!--		z-index: 2;-->
<!--		display: -webkit-box;-->
<!--		display: -webkit-flex;-->
<!--		display: -ms-flexbox;-->
<!--		display: flex;-->
<!--		width: 32px;-->
<!--		height: 32px;-->
<!--		-webkit-box-pack: center;-->
<!--		-webkit-justify-content: center;-->
<!--		-ms-flex-pack: center;-->
<!--		justify-content: center;-->
<!--		-webkit-box-align: center;-->
<!--		-webkit-align-items: center;-->
<!--		-ms-flex-align: center;-->
<!--		align-items: center;-->
<!--		border-radius: 20px;-->
<!--		-webkit-transition: background-color 50ms ease-in;-->
<!--		transition: background-color 50ms ease-in;-->
<!--		cursor: pointer;-->
<!--	}-->
<!--	-->
<!--	.icon-exit-2:hover {-->
<!--		background-color: #2d2d2d;-->
<!--	}-->


<!--</style>-->

<style scoped lang="scss">
	/*.section-item {*/
	/*   display: flex;*/
	/*   justify-content: space-between;*/
	/*   align-items: center;*/
	/*   flex-direction: row;*/
	/*   height: 24px;*/
	/*   padding: 4px 12px;*/
	/*   margin: 4px 0px;*/
	/*   border-radius: 6px;*/
	/*   cursor: pointer;*/
	/*   text-decoration: none;*/
	/*   */
	/*   .section-item-category {*/
	/*      color: #8C8C8C;*/
	/*   }*/
	/*   .section-item-number {*/
	/*      color: #636363;*/
	/*   }*/
	/*   &:hover {*/
	/*      background: #2B2B2B;*/
	/*      .section-item-category {*/
	/*         color: #fff;*/
	/*      }*/
	/*      .section-item-number {*/
	/*         color: #d1d1d1;*/
	/*      }*/
	/*   }*/
	/*}*/
	/*.section-item--active {*/
	/*   background: #1B2E3E;*/
	/*   .section-item-category {*/
	/*      color: #1592FF;*/
	/*   }*/
	/*   .section-item-number {*/
	/*      color: #1592FF;*/
	/*   }*/
	/*   &:hover {*/
	/*      .section-item-category {*/
	/*         color: #1592FF;*/
	/*      }*/
	/*      .section-item-number {*/
	/*         color: #1592FF;*/
	/*      }*/
	/*   }*/
	/*}*/
	/*.section-item--active:hover {*/
	/*     background: #1B2E3E !important;*/
	/*     cursor: default;*/
	/*}*/
	
	body {
		background-color: #262626;
		font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
		color: #333;
		font-size: 14px;
		line-height: 20px;
	}
	
	a {
		text-decoration: underline;
	}
	
	.section {
		position: relative;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		height: 100vh;
		padding-top: 0px;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-webkit-flex-direction: column;
		-ms-flex-direction: column;
		flex-direction: column;
		background-color: #262626;
	}
	
	.body-sm {
		font-family: Inter, sans-serif;
		font-size: 12px;
		text-align: left;
		text-decoration: none;
	}
	
	.body-sm.color-fff {
		color: #fff;
	}
	
	.btn-outlined {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: auto;
		height: 40px;
		padding-right: 16px;
		padding-left: 16px;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border: 1px solid #383838;
		border-radius: 6px;
		background-color: #212121;
		-webkit-transition: color 100ms ease-in, border-color 100ms ease-in;
		transition: color 100ms ease-in, border-color 100ms ease-in;
		font-family: Inter, sans-serif;
		color: #a3a3a3;
		text-decoration: none;
	}
	
	.btn-outlined:hover {
		background-color: #2d2d2d;
		color: #fff;
	}
	
	.color-a3a3a3 {
		color: #a3a3a3;
	}
	
	.color-636363 {
		color: #636363;
	}
	
	.body-lg {
		font-family: Inter, sans-serif;
		font-size: 14px;
		line-height: 22px;
		text-align: left;
		text-decoration: none;
	}
	
	.body-lg.color-a3a3a3 {
		text-decoration: none;
	}
	
	.body-lg.color-fff {
		color: #fff;
	}
	
	.body-lg.no-wrap {
		white-space: nowrap;
	}
	
	.mr-12 {
		margin-right: 12px;
	}
	
	.mt-24 {
		margin-top: 24px;
	}
	
	.color-d1d1d1 {
		color: #d1d1d1;
	}
	
	.color-555555 {
		color: #555;
	}
	
	.top-bar {
		position: fixed;
		left: 0px;
		top: 0px;
		right: 0px;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		height: 64px;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		background-color: #1c1c1c;
	}
	
	.top-bar-menu {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 284px;
		height: 100%;
		min-width: 284px;
		padding-right: 20px;
		padding-left: 20px;
		-webkit-box-pack: justify;
		-webkit-justify-content: space-between;
		-ms-flex-pack: justify;
		justify-content: space-between;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.avatar-container {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100px;
		height: 100%;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.menu-btn {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.avatar-circle {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 32px;
		height: 32px;
		min-height: 32px;
		min-width: 32px;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border-radius: 16px;
		background-color: #1592ff;
	}
	
	.avatar-circle.mr-12 {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
	}
	
	.vertical-divider {
		width: 1px;
		height: 24px;
		background-color: #262626;
	}
	
	.vertical-divider.full-height {
		height: 100%;
	}
	
	.icon-menu {
		width: 16px;
		height: 16px;
	}
	
	.top-bar-settings {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		height: 100%;
		-webkit-box-pack: justify;
		-webkit-justify-content: space-between;
		-ms-flex-pack: justify;
		justify-content: space-between;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.top-bar-settings--left {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: auto;
		height: 100%;
		padding-left: 20px;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.top-bar-settings--right {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 300px;
		height: 100%;
		padding-right: 20px;
		-webkit-box-pack: end;
		-webkit-justify-content: flex-end;
		-ms-flex-pack: end;
		justify-content: flex-end;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.outlined-btn {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: auto;
		height: 40px;
		padding-right: 16px;
		padding-left: 16px;
		-webkit-box-pack: justify;
		-webkit-justify-content: space-between;
		-ms-flex-pack: justify;
		justify-content: space-between;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border: 1px solid #2e2e2e;
		border-radius: 6px;
		-webkit-transition: border-color 100ms ease-in-out;
		transition: border-color 100ms ease-in-out;
		text-decoration: none;
	}
	
	.outlined-btn:hover {
		border-color: #4d4d4d;
	}
	
	.outlined-btn:focus {
		background-color: #262626;
	}
	
	.outlined-btn.mr-12:hover {
		border-color: #4d4d4d;
	}
	
	.search-input {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 180px;
		height: 40px;
		padding-right: 16px;
		padding-left: 16px;
		-webkit-box-pack: start;
		-webkit-justify-content: flex-start;
		-ms-flex-pack: start;
		justify-content: flex-start;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border: 1px solid #242424;
		border-radius: 6px;
		background-color: #242424;
	}
	
	.search-input:active {
		border: 1px solid #383838;
	}
	
	.filters-btn {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: auto;
		height: 40px;
		padding-right: 16px;
		padding-left: 16px;
		-webkit-box-pack: justify;
		-webkit-justify-content: space-between;
		-ms-flex-pack: justify;
		justify-content: space-between;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border: 1px solid #2e2e2e;
		border-radius: 6px;
		-webkit-transition: border-color 100ms ease-in-out;
		transition: border-color 100ms ease-in-out;
		text-decoration: none;
	}
	
	.filters-btn:hover {
		border-color: #4d4d4d;
	}
	
	.number-container {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 18px;
		height: 18px;
		padding-right: 1px;
		padding-bottom: 1.5px;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border: 1px solid #1592ff;
		border-radius: 4px;
	}
	
	.body-xs {
		font-family: Inter, sans-serif;
		font-size: 10px;
	}
	
	.body-xs.color-1592ff {
		color: #1592ff;
	}
	
	.square-icon-btn {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 40px;
		height: 40px;
		min-height: 40px;
		min-width: 40px;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border: 1px solid #2e2e2e;
		border-radius: 6px;
		-webkit-transition: color 100ms ease-in, border-color 100ms ease-in;
		transition: color 100ms ease-in, border-color 100ms ease-in;
		font-family: Inter, sans-serif;
		color: #a3a3a3;
		text-decoration: none;
	}
	
	.square-icon-btn:hover {
		border-color: #4d4d4d;
		color: #fff;
	}
	
	.square-icon-btn.square-icon-btn--active {
		background-color: #2e2e2e;
	}
	
	.square-icon-btn.square-icon-btn--active:hover {
		border-color: #383838;
	}
	
	.square-icon-btn._48x48 {
		width: 48px;
		height: 48px;
	}
	
	.square-icon-btn.square-icon-btn--active-blue {
		border-color: #1592ff;
	}
	
	.square-icon-btn.square-icon-btn--disabled {
		opacity: 0.25;
		cursor: not-allowed;
	}
	
	.square-icon-btn.square-icon-btn--disabled._48x48:hover {
		border-color: #2e2e2e;
	}
	
	.mr-20 {
		margin-right: 20px;
	}
	
	.ml-20 {
		margin-left: 20px;
	}
	
	.icon-desktop {
		width: 26px;
		height: 18px;
	}
	
	.icon-tablet {
		height: 18px;
	}
	
	.icon-mobile {
		height: 14px;
	}
	
	.icon-stacked {
		height: 16px;
	}
	
	.icon-grid {
		height: 14px;
	}
	
	.left-bar {
		position: fixed;
		top: 64px;
		width: 284px;
		height: 100%;
		min-width: 284px;
		border-top: 1px solid #262626;
		background-color: #1c1c1c;
	}
	
	.tab-container {
		position: relative;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		height: 80px;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		border-bottom: 1px solid #262626;
	}
	
	.tab-item {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 33.33%;
		height: 100%;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		cursor: pointer;
		font-size: 22px;
	}
	
	.icon-code {
		width: 22px;
	}
	
	.tab-underline {
		position: absolute;
		bottom: 0px;
		width: 100%;
		height: 1px;
		background-color: #262626;
	}
	
	.tab-underline.tab-underline--active {
		right: 66.66%;
		z-index: 2;
		width: 33.33%;
		background-color: #fff;
	}
	
	.accordion-view-item {
		position: relative;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		height: 64px;
		padding-right: 20px;
		padding-bottom: 12px;
		padding-left: 20px;
		-webkit-box-pack: justify;
		-webkit-justify-content: space-between;
		-ms-flex-pack: justify;
		justify-content: space-between;
		-webkit-box-align: end;
		-webkit-align-items: flex-end;
		-ms-flex-align: end;
		align-items: flex-end;
		border-bottom: 1px solid #262626;
		text-decoration: none;
	}
	
	.icon-arrow-right {
		margin-bottom: 4px;
	}
	
	.icon-arrow-down-active {
		margin-bottom: 4px;
	}
	
	.label-container {
		padding: 0px 6px;
		border-radius: 3px;
		background-color: #1f2d45;
	}
	
	.title-label-wrapper {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.body-uppercase {
		font-family: Inter, sans-serif;
		font-size: 8px;
		letter-spacing: 1px;
		text-transform: uppercase;
	}
	
	.body-uppercase.color-1592ff {
		color: #1592ff;
		font-size: 9px;
		font-weight: 500;
	}
	
	.accordion-view-item-wrapper {
		width: 100%;
	}
	
	.primary-input {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		height: 40px;
		padding-right: 12px;
		padding-left: 12px;
		-webkit-box-pack: start;
		-webkit-justify-content: flex-start;
		-ms-flex-pack: start;
		justify-content: flex-start;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border: 1px solid #242424;
		border-radius: 6px;
		background-color: #242424;
	}
	
	.primary-input:active {
		border: 1px solid #4d4d4d;
	}
	
	.primary-input.min-width-160 {
		min-width: 160px;
	}
	
	.primary-input.min-width-160.mr-12:focus {
		border-color: #4d4d4d;
	}
	
	.accordion-items {
		width: 100%;
		padding-top: 16px;
		padding-right: 20px;
		padding-left: 20px;
	}
	
	.mb-8 {
		margin-bottom: 8px;
	}
	
	.color {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		overflow: hidden;
		width: 28px;
		height: 28px;
		-webkit-flex-wrap: wrap;
		-ms-flex-wrap: wrap;
		flex-wrap: wrap;
		border-radius: 3px;
		background-color: #2f2f2f;
	}
	
	.palette-wrapper {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 52px;
		height: 52px;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border: 1px solid #383838;
		border-radius: 6px;
		-webkit-transition: border-color 50ms ease-in;
		transition: border-color 50ms ease-in;
	}
	
	.palette-wrapper:hover {
		border-color: #4d4d4d;
	}
	
	.palette-wrapper.palette-wrapper--active {
		border-color: #1592ff;
	}
	
	.colortheme-bottom {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: justify;
		-webkit-justify-content: space-between;
		-ms-flex-pack: justify;
		justify-content: space-between;
		-webkit-flex-wrap: wrap;
		-ms-flex-wrap: wrap;
		flex-wrap: wrap;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.colortheme-item {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-webkit-flex-direction: column;
		-ms-flex-direction: column;
		flex-direction: column;
		-webkit-justify-content: space-around;
		-ms-flex-pack: distribute;
		justify-content: space-around;
	}
	
	.mt-12 {
		margin-top: 12px;
	}
	
	.sections-container {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		height: 100%;
		margin-top: 64px;
		margin-left: 284px;
		padding-right: 20px;
	}
	
	.section-item {
		width: 50%;
		height: 50%;
		min-height: 600px;
		margin-top: 20px;
		margin-left: 20px;
		border: 1px solid #2f2f2f;
		border-radius: 6px;
		background-color: #202020;
	}
	
	.section-item-top {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		height: 64px;
		-webkit-box-pack: justify;
		-webkit-justify-content: space-between;
		-ms-flex-pack: justify;
		justify-content: space-between;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		grid-auto-columns: 1fr;
		-ms-grid-columns: 1fr 1fr;
		grid-template-columns: 1fr 1fr;
		-ms-grid-rows: auto auto;
		grid-template-rows: auto auto;
		border-bottom: 1px solid #2f2f2f;
		border-top-left-radius: 6px;
		border-top-right-radius: 6px;
		background-color: #1c1c1c;
	}
	
	.section-item-content {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		height: 536px;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.section-top-left {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 50%;
		height: 100%;
		padding-right: 16px;
		-webkit-box-pack: end;
		-webkit-justify-content: flex-end;
		-ms-flex-pack: end;
		justify-content: flex-end;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.section-top-right {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 50%;
		height: 100%;
		padding-left: 16px;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.body-lg-2 {
		font-family: Inter, sans-serif;
		font-size: 14px;
		line-height: 22px;
		text-align: center;
		text-decoration: none;
	}
	
	.icon-code-small {
		width: 16px;
	}
	
	.icon-sections {
		width: 16px;
	}
	
	.icon-expand {
		width: 16px;
	}
	
	.section-content-inner-container {
		width: 100%;
		border-top: 1px solid #2f2f2f;
		border-bottom: 1px solid #2f2f2f;
		background-color: #1e1e1e;
	}
	
	.img-section {
		width: 100%;
		height: auto;
		min-height: 340px;
		/*background-image: url('../images/section-img.png');*/
		background-position: 50% 0%;
		background-size: cover;
	}
	
	.body-md.color-fff {
		color: #fff;
	}
	
	.code-items {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		padding-top: 16px;
		padding-right: 20px;
		padding-left: 20px;
	}
	
	.code-title-item {
		position: relative;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		height: 64px;
		margin-left: 20px;
		padding-right: 20px;
		padding-bottom: 12px;
		-webkit-box-pack: justify;
		-webkit-justify-content: space-between;
		-ms-flex-pack: justify;
		justify-content: space-between;
		-webkit-box-align: end;
		-webkit-align-items: flex-end;
		-ms-flex-align: end;
		align-items: flex-end;
		border-bottom: 1px solid #262626;
		text-decoration: none;
	}
	
	.link-md {
		font-family: Inter, sans-serif;
		text-decoration: none;
	}
	
	.link-md.color-1592ff {
		color: #1592ff;
	}
	
	.icon-html {
		width: 22px;
	}
	
	.icon-react {
		width: 26px;
	}
	
	.icon-vue {
		width: 24px;
	}
	
	.icon-css {
		width: 22px;
	}
	
	.icon-sass {
		width: 28px;
	}
	
	.menu {
		position: absolute;
		left: 500px;
		width: 224px;
		height: auto;
		padding-top: 8px;
		padding-bottom: 8px;
		border-radius: 8px;
		background-color: #262626;
		box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.25), 0 8px 16px 0 rgba(0, 0, 0, 0.25);
	}
	
	.menu-item {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		padding: 8px 12px;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border-radius: 4px;
		-webkit-transition: background-color 50ms ease-in;
		transition: background-color 50ms ease-in;
		cursor: pointer;
	}
	
	.menu-item:hover {
		background-color: #2d2d2d;
	}
	
	.count-container {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 32px;
	}
	
	.mr-16 {
		margin-right: 16px;
	}
	
	.menu-2 {
		position: absolute;
		left: 814px;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 730px;
		height: auto;
		padding: 8px;
		border-radius: 8px;
		background-color: #262626;
		box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.25), 0 8px 16px 0 rgba(0, 0, 0, 0.25);
	}
	
	.section-alternatives-container {
		width: 30%;
	}
	
	.section-alternatives-container.mr-8 {
		margin-right: 8px;
	}
	
	.preview-container {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 70%;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border-radius: 4px;
		background-color: #242424;
	}
	
	.menu-3 {
		position: absolute;
		left: 497px;
		top: 60px;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 232px;
		height: auto;
		padding: 8px;
		border-style: solid;
		border-width: 1px;
		border-color: #2d2d2d;
		border-radius: 8px;
		background-color: #262626;
		box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.25), 0 8px 16px 0 rgba(0, 0, 0, 0.25);
	}
	
	.sections-alternatives {
		width: 100%;
	}
	
	.menu-4 {
		position: absolute;
		left: 241px;
		top: 48px;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 232px;
		height: auto;
		padding: 8px;
		border: 1px solid #2d2d2d;
		border-radius: 8px;
		background-color: #262626;
		box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.25), 0 8px 16px 0 rgba(0, 0, 0, 0.25);
	}
	
	.icon-info.mr-8 {
		margin-right: 8px;
		margin-bottom: 2px;
	}


</style>
