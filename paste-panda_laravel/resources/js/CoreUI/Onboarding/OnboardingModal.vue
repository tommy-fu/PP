<template>
	<div class="overlay" v-if="showModal">
		<div class="onboarding-modal">
			<div class="icon-exit" @click="hide"><img src="/icons/close-2.svg" loading="lazy" alt=""></div>
			<div class="modal-left">
				<img :src="currentStep.imgSrc" alt="" style="height: 100%; width: 100%; object-fit: cover;">
				<!--				<div data-poster-url="https://uploads-ssl.webflow.com/6018fa96445bc11049be4775/60198f419f02eb5929f3de3a_test 2 pp-poster-00001.jpg"-->
				<!--				     data-video-urls="https://uploads-ssl.webflow.com/6018fa96445bc11049be4775/60198f419f02eb5929f3de3a_test 2 pp-transcode.mp4,https://uploads-ssl.webflow.com/6018fa96445bc11049be4775/60198f419f02eb5929f3de3a_test 2 pp-transcode.webm"-->
				<!--				     data-autoplay="true" data-loop="true" data-wf-ignore="true"-->
				<!--				     class="bg-video w-background-video w-background-video-atom">-->
				<!--&lt;!&ndash;					<video autoplay="" loop=""&ndash;&gt;-->
				<!--&lt;!&ndash;					       style="background-image:url(&quot;https://uploads-ssl.webflow.com/6018fa96445bc11049be4775/60198f419f02eb5929f3de3a_test 2 pp-poster-00001.jpg&quot;)"&ndash;&gt;-->
				<!--&lt;!&ndash;					       muted="" playsinline="" data-wf-ignore="true" data-object-fit="cover">&ndash;&gt;-->
				<!--&lt;!&ndash;						<source src="https://uploads-ssl.webflow.com/6018fa96445bc11049be4775/60198f419f02eb5929f3de3a_test 2 pp-transcode.mp4">&ndash;&gt;-->
				<!--&lt;!&ndash;						<source src="https://uploads-ssl.webflow.com/6018fa96445bc11049be4775/60198f419f02eb5929f3de3a_test 2 pp-transcode.webm">&ndash;&gt;-->
				<!--&lt;!&ndash;					</video>&ndash;&gt;-->
				<!--				</div>-->
			</div>
			<div class="modal-right">
				<div class="body-sm color-636363">Step {{stepIndex + 1}} of {{steps.length}}</div>
				<h3 class="onboarding-modal--title">{{currentStep.title}}</h3>
				<p class="body-lg color-a3a3a3 mt-12 mb-24">{{currentStep.description}}</p>
				<button class="btn-outlined mb-12" @click="incrementStepIndex">
					<div class="body-lg">{{currentStep.buttonText}}</div>
				</button>
				<a @click="decrementStepIndex" class="link-lg" v-if="stepIndex > 0"
				   style="cursor: pointer;">Previous</a>
			</div>
		</div>
	</div>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "OnboardingModal",
        data() {
            return {
                stepIndex: 0,
                steps: [
                    {
                        title: "Your dynamic UI library",
                        description: "This 45 second walkthrough will show you how to use Pastepanda for creating beautiful websites.",
                        buttonText: "Find a style you like",
                        imgSrc: '/images/onboarding/onboarding-1.png'
                    },
                    {
                        title: "Find a style you like",
                        description: "Browse among professionally curated styles and find the one that looks just right for the website you’re looking to build.",
                        buttonText: "Pick a color theme",
                        imgSrc: '/images/onboarding/onboarding-2.png'
                    },
                    {
                        title: "Color themes",
                        description: "Generate your own color theme by entering a hex value, or simply choose a pre-defined color palette from the Pastepanda library.",
                        buttonText: "Copy your stylesheet",
                        imgSrc: '/images/onboarding/onboarding-3.png'
                    },
                    {
                        title: "Copy your stylesheet",
                        description: "After you’ve picked your style and your color theme, you’re ready to copy your stylesheet into your project.",
                        buttonText: "Choose your markup language",
                        imgSrc: '/images/onboarding/onboarding-4.png'
                    },
                    {
                        title: "Choose your markup language",
                        description: "Select a markup language based on your project. The  copied markup will be converted to the selected language.",
                        buttonText: "Copy the markup",
                        imgSrc: '/images/onboarding/onboarding-5.png'
                    },
                    {
                        title: "Copy the markup",
                        description: "Browse the library and copy the markup by clicking the button in the top right corner of a section.",
                        buttonText: "Browse Pastepanda",
                        imgSrc: '/images/onboarding/onboarding-6.png'
                    },
                ],
                show: true
            }
        },
        methods: {
            incrementStepIndex() {
                if (this.stepIndex < this.steps.length - 1) {
                    this.stepIndex = this.stepIndex + 1;
                }
                else {
                    //Turn off user onboarding
                    this.hide();
                }
            },
            hide() {
                this.show = false;

                this.$inertia.patch('/user-onboarding/', {
                    'show_onboarding': 0
                }, {
                    preserveState: true,
                    // 'only': ['auth.user.show_onboarding']
                });
            },
            resetShow() {
                this.stepIndex = 0;
                this.show = true;
            },
            decrementStepIndex() {
                if (this.stepIndex > 0) this.stepIndex = this.stepIndex - 1;
            }
        },
        computed: {
            currentStep() {
                return this.steps[this.stepIndex];
            },
            showModal() {
                return this.$page.props.auth.user.show_onboarding && this.show;
            }
        },
    }
</script>

<style scoped>
	
	* {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}
	
	.section {
		position: relative;
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
		/*background-image: url('../images/Core-UI.png');*/
		background-position: 0px 0px;
		background-size: cover;
	}
	
	.body-sm {
		font-family: Inter, sans-serif;
		font-size: 12px;
		text-align: center;
	}
	
	.btn-outlined {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: auto;
		height: 48px;
		padding-right: 24px;
		padding-left: 24px;
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
	
	.color-a3a3a3 {
		color: #a3a3a3;
	}
	
	.mb-12 {
		margin-bottom: 12px;
	}
	
	.onboarding-modal {
		position: relative;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 864px;
		height: 380px;
		padding: 40px;
		border-style: solid;
		border-width: 1px;
		border-color: #2c2c2c;
		border-radius: 12px;
		background-color: #1c1c1c;
		box-shadow: 0 56px 72px 0 rgba(0, 0, 0, 0.5);
	}
	
	.icon-exit {
		position: absolute;
		top: 16px;
		right: 16px;
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
	
	.icon-exit:hover {
		background-color: #2d2d2d;
	}
	
	.mb-24 {
		margin-bottom: 24px;
	}
	
	.color-636363 {
		color: #636363;
	}
	
	.modal-right {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 50%;
		padding-left: 48px;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-webkit-flex-direction: column;
		-ms-flex-direction: column;
		flex-direction: column;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.modal-left {
		overflow: hidden;
		width: 55%;
		margin-top: -40px;
		margin-bottom: -40px;
		margin-left: -40px;
		border-radius: 12px 0px 0px 12px;
		background-image: linear-gradient(117deg, #703eff, #7ae7ff);
	}
	
	.modal-img {
		width: 100%;
		-o-object-fit: cover;
		object-fit: cover;
	}
	
	.onboarding-modal--title {
		margin-top: 0px;
		font-family: Inter, sans-serif;
		color: #fff;
		font-size: 20px;
		font-weight: 400;
		line-height: 30px;
		margin-bottom: 0;
	}
	
	.mt-12 {
		margin-top: 12px;
	}
	
	.overlay {
		position: absolute;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		height: 100%;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		background-color: rgba(16, 16, 16, 0.9);
		z-index: 1000;
		
	}
	
	.body-lg {
		font-family: Inter, sans-serif;
		font-size: 14px;
		line-height: 22px;
		text-align: center;
	}
	
	.bg-video {
		z-index: 2;
		height: 100%;
	}
	
	.link-lg {
		color: #a3a3a3;
		line-height: 22px;
		text-decoration: none;
		font-size: 14px;
	}
	
	.link-lg:hover {
		color: #fff;
	}


</style>
