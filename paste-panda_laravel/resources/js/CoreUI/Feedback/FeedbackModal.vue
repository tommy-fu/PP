<template>
	<div class="overlay" v-if="showModal">
		<div class="top mb-200 mt-24">
			<div class="feedback-modal">
				<div class="icon-exit"><img src="/icons/close-2.svg" loading="lazy" alt="" class="icon-20x20"
				                            @click="show = false"></div>
				<div class="main-content-container">
					<component :is="currentStep.component" v-model="currentStep"></component>
				</div>
				
				
				<div class="bottom-container" v-if="stepIndex !== steps.length -1">
					
					
					<div class="progress-container">
						<div class="progress-indicator" :style="progressStyle"></div>
					</div>
					
					<a href="#" class="btn-outlined btn-outlined--primary"
					   :class="{'btn-outlined--disabled': shouldDisableNextButton}"
					   style="padding-right: 24px; padding-left: 24px;" v-if="currentStep.shouldSubmit"
					   @click="submitSurvey">
						<div class="body-lg">Send</div>
					</a>
					<button href="#" class="btn-outlined"
					        v-else
					        :disabled="shouldDisableNextButton"
					        :class="{'btn-outlined--disabled': shouldDisableNextButton}"
					        style="padding-right: 24px; padding-left: 24px;" @click="incrementStepIndex"
					>
						<div class="body-lg">Next</div>
					</button>
					<a href="#" class="link-lg" v-if="stepIndex > 0" @click="decrementStepIndex">Previous</a>
					<!--					</div>-->
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    import {mapGetters} from "vuex";
    import FeedbackRating from "./FeedbackRating";
    import FeedbackRadio from "./FeedbackRadio";
    import FeedbackSubmitted from "./FeedbackSubmitted";
    import FeedbackCheckbox from "./FeedbackCheckbox";

    export default {
        name: "FeedbackModal",
        components: {FeedbackRating},
        data() {
            return {
                rating: null,
                stepIndex: 0,
                steps: [
                    {
                        id: 1,
                        title: "On a scale of 1-10, how likely are you to recommend our product to a friend or colleague?",
                        component: FeedbackRating,
                        answer: null,
                        shouldSubmit: false
                    },
                    {
                        id: 2,
                        title: "On a scale of 1-10, what would you currently rate our product?",
                        component: FeedbackRating,
                        answer: null,
                        shouldSubmit: false
                    },
                    {
                        id: 3,
                        title: "What is your reason for trying out Pastepanda?",
                        buttonText: "Find a style you like",
                        component: FeedbackRadio,
                        options: [
                            "Don't like to design", 'Want to spend less time coding', 'Curiosity', 'Other'
                        ],
                        answer: null,
                        comment: '',
                        shouldSubmit: false
                    },
                    {
                        id: 4,
                        title: "Which area would you say needs the most improvement?",
                        component: FeedbackCheckbox,
                        options: [
                            'App performance', 'App usability', 'User guides', 'Colors', 'Sections', 'Styles', 'Code output'
                        ],
                        answer: [],
                        comment: '',
                        shouldSubmit: true,
                    },
                    {
                        component: FeedbackSubmitted,
                    },


                ],
                show: false
            }
        },
        methods: {
            incrementStepIndex() {
                if (this.currentStep.answer) {
                    if (this.stepIndex < this.steps.length - 1) {
                        this.stepIndex = this.stepIndex + 1;
                    }
                    else {
                        //Turn off user onboarding
                        this.hide();
                    }
                }
            },
            hide() {
                this.show = false;
            },
            setShowModal(bool) {
                this.show = bool;
            },
            resetShow() {
                this.stepIndex = 0;
                this.show = true;
            },
            decrementStepIndex() {
                if (this.stepIndex > 0) this.stepIndex = this.stepIndex - 1;
            },
            submitSurvey() {
                //Todo: Post survey
                let answer = {}
                for (let i = 0; i < this.steps.length; i++) {


                    let step = this.steps[i];
                    let prefix = 'Q' + (i + 1) + '.';

                    if (step.id) {
                        if (step.id) answer[prefix + 'id'] = step.id;
                        if (step.title) answer[prefix + 'question'] = step.title;
                        if (step.answer) answer[prefix + 'answer'] = step.answer;
                        if (step.comment) answer[prefix + 'comment'] = step.comment;
                    }


                }

                this.incrementStepIndex();

                // console.log(answers);

                // console.log(JSON.stringify(answers));
                this.$inertia.post('/feedback/', {
                    answers: answer
                });

            }
        },
        computed: {
            shouldDisableNextButton() {
                if (this.currentStep.component === FeedbackCheckbox) {
                    return this.currentStep.answer.length === 0
                }

                return this.currentStep.answer == null;
            },
            currentStep() {
                return this.steps[this.stepIndex];
            },
            progressStyle() {
                var percentage = ((this.stepIndex + 1) / this.steps.length) * 100;

                return {
                    'width': percentage + '%'
                }
            },
            // ...mapGetters(['getUser']),
            showModal() {
                // return true;
                return this.show;
                // return this.getUser.show_onboarding && this.show;
            }
        },
    }
</script>

<style scoped>
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
		-webkit-justify-content: space-around;
		-ms-flex-pack: distribute;
		justify-content: space-around;
		background-color: #1c1c1c;
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
		/*padding-right: 24px;*/
		/*padding-left: 24px;*/
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
	
	.btn-outlined.btn-outlined--square {
		width: 64px;
		height: 64px;
		min-height: 64px;
		min-width: 64px;
		border-radius: 10px;
	}
	
	.btn-outlined.btn-outlined--square.btn-outlined--primary {
		border-style: none;
		background-color: #1592ff;
		color: #fff;
	}
	
	.btn-outlined.btn-outlined--primary {
		border-style: none;
		background-color: #1592ff;
		color: #fff;
	}
	
	.btn-outlined.btn-outlined--disabled {
		border-color: rgba(56, 56, 56, 0.5);
		background-color: rgba(33, 33, 33, 0.5);
		color: hsla(0, 0%, 63.9%, 0.5);
		cursor: not-allowed;
	}
	
	.feedback-modal {
		position: relative;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 374px;
		height: 600px;
		padding-top: 40px;
		padding-right: 40px;
		padding-left: 40px;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-webkit-flex-direction: column;
		-ms-flex-direction: column;
		flex-direction: column;
		-webkit-box-pack: justify;
		-webkit-justify-content: space-between;
		-ms-flex-pack: justify;
		justify-content: space-between;
		border-style: solid;
		border-width: 1px;
		border-color: #2c2c2c;
		border-radius: 12px;
		background-color: #1c1c1c;
		box-shadow: 0 56px 72px 0 rgba(0, 0, 0, 0.5);
	}
	
	.modal.centered-v {
		padding-top: 0px;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
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
	
	.main-content-container {
		/*display: -webkit-box;*/
		/*display: -webkit-flex;*/
		/*display: -ms-flexbox;*/
		/*display: flex;*/
		/*-webkit-box-orient: vertical;*/
		/*-webkit-box-direction: normal;*/
		/*-webkit-flex-direction: column;*/
		/*-ms-flex-direction: column;*/
		/*flex-direction: column;*/
		/*-webkit-box-pack: center;*/
		/*-webkit-justify-content: center;*/
		/*-ms-flex-pack: center;*/
		/*justify-content: center;*/
		/*-webkit-box-align: start;*/
		/*-webkit-align-items: flex-start;*/
		/*-ms-flex-align: start;*/
		/*align-items: flex-start;*/
		height: 100%;
	}
	
	.main-content-container.centered-v {
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		text-align: center;
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
		/*background-color: #262626;*/
		z-index: 1000;
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
	
	.body-lg.color-a3a3a3.centered-v {
		text-align: center;
	}
	
	.body-lg.color-fff {
		color: #fff;
	}
	
	.mb-16 {
		margin-bottom: 16px;
	}
	
	.link-lg {
		color: #a3a3a3;
		line-height: 22px;
		text-decoration: none;
	}
	
	.link-lg:hover {
		color: #fff;
	}
	
	.numbers-row-container {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
	}
	
	.mr-12 {
		margin-right: 12px;
	}
	
	.bottom-container {
		/*position: relative;*/
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		height: 96px;
		-webkit-box-orient: horizontal;
		-webkit-box-direction: reverse;
		-webkit-flex-direction: row-reverse;
		-ms-flex-direction: row-reverse;
		flex-direction: row-reverse;
		-webkit-box-pack: justify;
		-webkit-justify-content: space-between;
		-ms-flex-pack: justify;
		justify-content: space-between;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.progress-container {
		position: absolute;
		/*left: -40px;*/
		left: 0;
		/*top: 0px;*/
		right: 0;
		/*right: -40px;*/
		width: 100%;
		height: 4px;
		bottom: 96px;
		background-color: #2d2d2d;
	}
	
	.progress-indicator {
		width: 25%;
		height: 100%;
		background-color: #1592ff;
	}
	
	
	.mt-24 {
		margin-top: 24px;
	}
	
	.radio-button {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 16px;
		height: 16px;
		min-height: 16px;
		min-width: 16px;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border: 1px solid #404040;
		border-radius: 12px;
		background-color: #303030;
	}
	
	.top {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
	}
	
	.top.mb-200.mt-24 {
		padding-right: 64px;
		padding-left: 64px;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-flex-wrap: wrap;
		-ms-flex-wrap: wrap;
		flex-wrap: wrap;
	}
	
	.bot {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
	}
	
	.mb-200 {
		margin-bottom: 200px;
	}
	
	
	.icon-20x20 {
		width: 20px;
		height: 20px;
	}


</style>
