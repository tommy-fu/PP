<template>
	<!--	<div style="position: fixed;">-->
	<!--	<div style="padding-top: 64px; height: 100vh; overflow: hidden;">-->
	<div>
		<div class="main" style="height: 100vh; overflow: hidden;">
			
			<OnboardingModal ref="onboarding"></OnboardingModal>
			<FeedbackModal ref="feedback"></FeedbackModal>
			<FeedbackToast @show-survey="showFeedbackModal"></FeedbackToast>
			<top-bar></top-bar>
			<div class="sidebar" style="">
				<!--		<LeftBar></LeftBar>-->
				<sidebar-tabs></sidebar-tabs>
				<div style="width: 100%; background: rgb(38, 38, 38); padding-bottom: 80px;">
					<SectionsLibrary ref="library"></SectionsLibrary>
				</div>
			</div>
		</div>
		<div class="responsive-warning">
			<ResponsiveWarning></ResponsiveWarning>
		</div>
	</div>
</template>

<style lang="scss">
	
	* {
		box-sizing: border-box;
	}
	
	.has-no-scroll {
		&::-webkit-scrollbar {
			width: 0px; /* Remove scrollbar space */
			background: transparent; /* Optional: just make scrollbar invisible */
		}
		
		/* Optional: show position indicator in red */
		&::-webkit-scrollbar-thumb {
			/*background: #FF0000;*/
		}
	}
	
	@media screen and (min-width: 992px) {
		
		
		.responsive-warning {
			display: none;
		}
	}
	
	.responsive-warning {
		display: none;
	}
	
	@media screen and (max-width: 992px) {
		
		.main {
			display: none !important;
		}
		
		.responsive-warning {
			display: block;
		}
	}
	
	
	body {
		background: #262626;
	}
	
	.h4 {
		margin-top: 0px;
		font-family: Inter, sans-serif;
		font-size: 15px;
		font-weight: 400;
	}
	
	.body-sm {
		font-size: 14px;
		font-weight: 400;
		font-family: Inter UI, sans-serif;
		line-height: 20px;
		letter-spacing: 0px;
	}
	
	.body-xs {
		font-size: 13px;
		font-weight: 400;
		font-family: Inter UI, sans-serif;
		line-height: 20px;
		letter-spacing: -0.02em;
	}
	
	.bg-temp-color-divider-dark {
		background-color: #2e2e2e;
	}
	
	.bg-temp-color-1 {
		background-color: #fff;
	}
	
	.bg-temp-color-2 {
		background-color: #201a12;
	}
	
	.bg-temp-color-3 {
		background-color: #cdcecc;
	}
	
	.bg-temp-color-4 {
		background-color: #2f1e17;
	}
	
	.btn-text {
		color: #a3a3a3;
	}
	
	.color-d1d1d1 {
		color: #d1d1d1 !important;
	}
	
	.color-fff {
		color: #fff;
	}
	
	.color-a3a3a3 {
		color: #a3a3a3;
	}
	
	.color-8c8c8c {
		color: #8C8C8C;
	}
	
	.color-636363 {
		color: #636363;
	}
	
	.color-1592FF {
		color: #1592FF;
	}
	
	.color-1B2E3E {
		background: #1B2E3E;
	}
	
	.mt-16 {
		margin-top: 16px;
	}
	
	.mb-24 {
		margin-bottom: 24px;
	}
	
	.mb-16 {
		margin-bottom: 16px;
	}
	
	.mb-12 {
		margin-bottom: 12px;
	}
	
	.mb-8 {
		margin-bottom: 8px;
	}
	
	.noselect {
		-webkit-touch-callout: none; /* iOS Safari */
		-webkit-user-select: none; /* Safari */
		-khtml-user-select: none; /* Konqueror HTML */
		-moz-user-select: none; /* Old versions of Firefox */
		-ms-user-select: none; /* Internet Explorer/Edge */
		user-select: none;
		/* Non-prefixed version, currently
											   supported by Chrome, Edge, Opera and Firefox */
	}
	
	
	.menu {
		width: 224px;
		border: 1px solid #2c2c2c;
		background-color: #262626;
		padding-top: 8px;
		padding-bottom: 8px;
		border-radius: 8px;
		box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.25);
		// Animation specific
		transition: all .1s ease-in;
		opacity: 0;
		transform: scale(0.97);
	}
	
	.menu-active {
		// Animation specific
		transition: all .1s ease-in;
		opacity: 1;
		transform: scale(1);
	}
	
	.menu-inactive {
		z-index: -100;
		pointer-events: none;
	}
	
	.menu-item {
		padding: 8px 16px;
		transition: background-color 50ms ease-in;
		cursor: pointer;
	}
	
	.menu-item:hover {
		background-color: #2d2d2d;
	}
	
	.menu-item-text:hover {
		color: #fff;
	}
	
	.menu-divider {
		height: 1px;
	}
	
	.sidebar {
		display: flex;
		flex-direction: row;
		height: 100vh;
		
		.rightbar {
			height: 100%;
			width: 320px;
			min-width: 320px;
			background: #1C1C1C;
			border-right: 1px solid #2D2D2D;
			
			overflow-y: scroll;
			
			&::-webkit-scrollbar {
				width: 0px; /* Remove scrollbar space */
				background: transparent; /* Optional: just make scrollbar invisible */
			}
			
			/* Optional: show position indicator in red */
			&::-webkit-scrollbar-thumb {
				/*background: #FF0000;*/
			}
			
			.tab-container {
				display: flex;
				flex-direction: row;
				height: 80px;
				width: 100%;
				border-bottom: 1px solid #2D2D2D;
				
				.tab-item {
					display: flex;
					cursor: pointer;
					justify-content: center;
					align-items: center;
					height: 100%;
					width: 33.33%;
					transition: all .15s ease-in-out;
				}
				
				.tab-item:hover {
					path {
						fill: #d1d1d1;
						transition: all .15s ease-in-out;
					}
				}
				
				.tab-item--active {
					border-bottom: 2px solid #fff;
				}
			}
			
			.content-container {
				.scrollable-content {
					padding: 16px 24px;
					height: 100%;
				}
			}
		}
	}
</style>

<script>
    import IconBase from '../CoreUI/IconBase.vue';
    import LeftBar from '../components/LeftBar.vue';
    import SectionItem from '../components/SectionItem.vue';
    import CodePicker from '../components/CodePicker.vue';
    import StyleItem from '../components/StyleItem.vue';
    import ColorItem from '../components/ColorItem.vue';
    import {mapGetters, mapMutations} from "vuex";
    import Library from "./Library";
    import SectionsLibrary from "../CoreUI/SectionsLibrary";
    import OnboardingModal from "../CoreUI/Onboarding/OnboardingModal";
    import ResponsiveWarning from "../CoreUI/Components/ResponsiveWarning";
    import FeedbackModal from "../CoreUI/Feedback/FeedbackModal";
    import FeedbackToast from "../CoreUI/Feedback/FeedbackToast";
    import TopBar from "../CoreUI/Layout/TopBar";

    export default {
        components: {
            TopBar,
            FeedbackToast,
            FeedbackModal,
            ResponsiveWarning,
            OnboardingModal,
            SectionsLibrary,
            Library,
            IconBase,
            LeftBar,
            SectionItem,
            CodePicker,
            StyleItem,
            ColorItem
        },
        data() {
            return {
                active: false,
                alertActive: false,
                alertActive2: false,
                menuActive: false,
                tooltipActive: false,
            }
        },
        props: {
            user: Object,
            categories: Array,
            category: String,
            brands: Array,
            themes: Array,
            search: Array,
            // sections: Array
        },
        computed: {
            ...mapGetters(['getUser'])
        },
        watch: {
            user: {
                handler: function (newValue) {
                    this.setActiveBrandId(newValue.brandId);
                    this.setUser(this.user);
                    // this.$refs.iframe.contentWindow.location.reload();
                    // this.$refs.library.$forceUpdate();
                    this.$refs.library.reloadFile();

                    if (newValue.show_onboarding === true) {
                        this.$refs.onboarding.resetShow();
                    }

                },
                deep: true
            },
            // sections(newValue) {
            //     this.setSections(newValue);
            // }
        },
        methods: {
            ...mapMutations(['setCategories', 'setActiveCategory', 'setActiveSectionCollection', 'setBrands', 'setActiveBrandId', 'setColorThemes', 'setUser', 'setSections']),
            showFeedbackModal(bool) {
                console.log("show modal");
                this.$refs.feedback.setShowModal(bool);
            }
        },
        mounted() {
            this.setCategories(this.categories);
            this.setActiveCategory(this.category);
			this.setActiveSectionCollection(this.section_collection);
            this.setBrands(this.brands);
            this.setActiveBrandId(this.user.brandId);
            this.setColorThemes(this.themes);
            this.setUser(this.user);
			// this.setSections(this.sections);
        }
    }
</script>
