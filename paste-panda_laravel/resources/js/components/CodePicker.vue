<template>
	<div v-click-outside="hide">
<!--		<a href="#" class="settings-btn"><img src="/icons/code.svg" loading="lazy" alt="" class="code-icon"></a>-->
		
		<button href="#" class="settings-btn" @click="active = !active"><img src="/icons/code.svg" loading="lazy" alt="" class="code-icon" ></button>
		
		<div class="modal" style="position: absolute; left: 20px; top: 72px;"
		     :class="{'modal-active': active, 'modal-inactive' : !active}">
			<div class="icon-exit-2"><img src="/icons/close-2.svg" loading="lazy" alt="" @click="active = false"></div>
			<div class="modal-title-container mb-24 mt-12">
				<h4 class="h4 color-d1d1d1">Markup</h4>
				<div class="modal-divider bg-temp-color-divider-dark"></div>
			</div>
			<div class="code-item-container mb-24">
				<div class="body-sm color-a3a3a3">{{getUserProgrammingLanguage}}</div>
				<div class="html-btns-container">
					<code-button @click="selectProgrammingLanguage(0)" :active="getUser.programming_language_id === 0">
						<i class="pp-html5" style="font-size: 24px;"></i>
					</code-button>
					
					<code-button @click="selectProgrammingLanguage(1)" :active="getUser.programming_language_id === 1">
						<i class="pp-react" style="font-size: 24px;"></i>
					</code-button>
					<code-button img="/icons/Vue--white.svg" disabled>
						<i class="pp-vue" style="font-size: 24px;"></i>
					</code-button>
				</div>
			</div>
			<div class="modal-title-container mb-24">
				<h4 class="h4 color-d1d1d1">Stylesheet</h4>
				<div class="icon-exit"></div>
				<div class="modal-divider bg-temp-color-divider-dark"></div>
			</div>
			<div class="code-item-container mb-24">
				<div class="body-sm color-a3a3a3">CSS</div>
				<div class="html-btns-container">
					<code-button active>
						<i class="pp-css3" style="font-size: 24px;"></i>
					</code-button>
					<code-button disabled>
						<i class="pp-sass" style="font-size: 24px;"></i>
					</code-button>
				</div>
			</div>
			<button class="btn-outlined w-inline-block">
				<div class="body-sm" @click="copyCss">Copy stylesheet</div>
			</button>
		</div>
	</div>
</template>
<style lang="scss">
	.modal-divider {
		position: absolute;
		left: -24px;
		right: -24px;
		bottom: 0px;
		height: 1px;
	}
	
	.icon-exit {
		width: 24px;
		height: 24px;
		border-radius: 16px;
		transition: background-color 50ms ease-in;
	}
	
	.html-btns-container {
		display: flex;
		height: 40px;
	}
	
	.modal {
		display: flex;
		flex-direction: column;
		width: 320px;
		padding-right: 24px;
		padding-bottom: 24px;
		padding-left: 24px;
		border: 1px solid #2c2c2c;
		border-radius: 8px;
		background-color: #262626;
		box-shadow: 0 56px 72px 0 rgba(0, 0, 0, 0.5);
		// Animation specific
		transition: all .1s ease-in;
		opacity: 0;
		transform: scale(0.97);
		/*pointer-events: none;*/
	}
	
	.modal-active {
		// Animation specific
		transition: all .1s ease-in;
		opacity: 1;
		transform: scale(1);
		z-index: 1000;
	}
	
	.modal-inactive {
		z-index: -2;
	}
	
	.modal-title-container {
		position: relative;
		display: flex;
		width: 100%;
		height: 56px;
		justify-content: space-between;
		align-items: center;
	}
	

	.code-item-container {
		display: flex;
		width: 100%;
		padding: 8px 0px;
		justify-content: space-between;
		align-items: center;
		border-radius: 8px;
	}
	
	.modal-title-container {
		position: relative;
		display: flex;
		width: 100%;
		height: 56px;
		justify-content: space-between;
		align-items: center;
	}
</style>
<script>
    import CodeButton from "../CoreUI/Components/CodeButton";
    import ReactIcon from "../CoreUI/Icons/ReactIcon";
    import VueIcon from "../CoreUI/Icons/VueIcon";
    import HtmlIcon from "../CoreUI/Icons/HtmlIcon";
    import CssIcon from "../CoreUI/Icons/CssIcon";
    import {mapGetters} from "vuex";
    import vClickOutside from 'v-click-outside';
    
    export default {
        components: {CssIcon, HtmlIcon, VueIcon, ReactIcon, CodeButton},
        data() {
            return {
                active: false,
                alertActive: false
            }
        },
        directives: {
            clickOutside: vClickOutside.directive
        },
        methods: {
            hide(){
                if(this.active){
                    this.active = false;
                }
            },
            copyCss() {
                axios.get('/user-brands/', {
                    params: {
                        // 'html': this.codeOutputValue
                    }
                })
                    .then(response => {
                        // console.log("Copied..?");
                        // console.log(response.data);
                        this.$copyText(response.data).then(() => {
                            this.$notify({
                                group: "foo",
                                title: "Important message",
                                text: "CSS was copied to the clipboard!",
                            });
                            // this.show = true;
                        });
                    })
                    .catch(function (error) {
                        alert("Well..?");
                        console.log(error);
                    });
            },
            selectProgrammingLanguage(id){
                this.$inertia.put('/user-programming-languages/' + id);
                // this.$inertia.reload();
            }
        },
        computed: {
            ...mapGetters(['getUser', 'getUserProgrammingLanguage'])
        },
    }
</script>

<style scoped>
	.section {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		height: 100vh;
		-webkit-justify-content: space-around;
		-ms-flex-pack: distribute;
		justify-content: space-around;
		background-color: #1c1c1c;
	}
	
	.sidebar {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 272px;
		height: 100vh;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-webkit-flex-direction: column;
		-ms-flex-direction: column;
		flex-direction: column;
		-webkit-box-align: start;
		-webkit-align-items: flex-start;
		-ms-flex-align: start;
		align-items: flex-start;
		background-color: #1c1c1c;
	}
	
	.h4 {
		margin-top: 0px;
		margin-bottom: 0px;
		font-family: Inter, sans-serif;
		font-size: 15px;
		font-weight: 400;
	}
	
	.body-sm {
		font-family: Inter, sans-serif;
		font-size: 13px;
	}
	
	.btn-outlined {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		height: 40px;
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
		outline: none;
	}
	
	.btn-outlined:hover {
		background-color: #2d2d2d;
		color: #fff;
	}
	
	.color-d1d1d1 {
		color: #d1d1d1;
	}
	
	.color-a3a3a3 {
		color: #a3a3a3;
	}
	
	.modal {
		position: relative;
		width: 280px;
		padding-right: 24px;
		padding-bottom: 24px;
		padding-left: 24px;
		border-style: solid;
		border-width: 1px;
		border-color: #2c2c2c;
		border-radius: 8px;
		background-color: #262626;
		box-shadow: 0 56px 72px 0 rgba(0, 0, 0, 0.5);
	}
	
	.modal-title-container {
		position: relative;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		height: 48px;
		-webkit-box-pack: justify;
		-webkit-justify-content: space-between;
		-ms-flex-pack: justify;
		justify-content: space-between;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.code-item-container {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		-webkit-box-pack: justify;
		-webkit-justify-content: space-between;
		-ms-flex-pack: justify;
		justify-content: space-between;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border-radius: 8px;
	}
	
	.html-btns-container {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		height: 40px;
	}
	
	.code-btn {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 40px;
		height: 40px;
		margin-left: 12px;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border: 1px solid #535353;
		border-radius: 8px;
		background-color: #404040;
		-webkit-transition: background-color 50ms ease-in;
		transition: background-color 50ms ease-in;
	}
	
	.code-btn:hover {
		border-color: #fff;
	}
	
	.code-btn.code-btn--active {
		border-color: #1592ff;
		background-color: #2c3d4c;
		cursor: default;
	}
	
	.code-btn.code-btn--disabled {
		border-color: #383838;
		background-color: #2d2d2d;
		cursor: default;
	}
	
	.modal-divider {
		position: absolute;
		left: -24px;
		right: -24px;
		bottom: 0px;
		height: 1px;
	}
	
	.icon-exit {
		position: absolute;
		top: 16px;
		right: 16px;
		z-index: 2;
		width: 24px;
		height: 24px;
		border-radius: 16px;
		-webkit-transition: background-color 50ms ease-in;
		transition: background-color 50ms ease-in;
	}
	
	.icon-exit:hover {
		background-color: #2d2d2d;
	}
	
	.bg-temp-color-divider-dark {
		background-color: #2e2e2e;
	}
	
	.mb-24 {
		margin-bottom: 24px;
	}
	
	.sidebar-top {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 312px;
		height: 72px;
		margin-right: 20px;
		margin-left: 20px;
		-webkit-box-pack: justify;
		-webkit-justify-content: space-between;
		-ms-flex-pack: justify;
		justify-content: space-between;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border-bottom: 1px solid #262626;
	}
	
	.settings-btn {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 40px;
		height: 40px;
		margin-right: 12px;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border: 1px solid #383838;
		border-radius: 8px;
		background-color: #212121;
		-webkit-transition: background-color 50ms ease-in;
		transition: background-color 50ms ease-in;
		outline: none;
	}
	
	.settings-btn:hover {
		background-color: #2d2d2d;
	}
	
	.nav-btn {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 40px;
		height: 40px;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border-radius: 20px;
		-webkit-transition: opacity 200ms ease-in-out;
		transition: opacity 200ms ease-in-out;
		cursor: pointer;
	}
	
	.nav-btn:hover {
		background-color: #282828;
	}
	
	.settings-wrapper {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.nav-stripes-wrapper {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 16px;
		height: 16px;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-webkit-flex-direction: column;
		-ms-flex-direction: column;
		flex-direction: column;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.nav-stripe {
		width: 16px;
		height: 2px;
		margin-bottom: 4px;
		background-color: #5f5f5f;
	}
	
	.nav-stripe.nav-stripe--last {
		margin-bottom: 0px;
	}
	
	.code-icon {
		width: 20px;
		height: 20px;
	}
	
	.mt-12 {
		margin-top: 12px;
	}
	
	.copy-icon {
		height: 9px;
		margin-left: 12px;
	}
	
	.icon-exit-2 {
		position: absolute;
		/*top: 12px;*/
		top: 18px;
		right: 12px;
		z-index: 2;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 32px;
		height: 32px;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border-radius: 20px;
		-webkit-transition: background-color 50ms ease-in;
		transition: background-color 50ms ease-in;
		cursor: pointer;
	}
	
	.icon-exit-2:hover {
		background-color: #2d2d2d;
	}


</style>
