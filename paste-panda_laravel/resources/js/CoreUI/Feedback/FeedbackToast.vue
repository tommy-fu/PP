<template>
	<div class="toast toast--survey mr-12" style="position: absolute; top: 12px; right: 12px; z-index: 1000;"
	     v-if="show">
		<div class="alert-text-container" @click="showFeedbackModal"><img src="/icons/survey-icon.svg" loading="lazy"
		                                                                  alt="" class="icon-32x32 mr-12">
			<div class="toast-text-container">
				<div class="body-lg color-d1d1d1">Share your thoughts</div>
				<div class="body-sm color-636363">Take the 1-minute survey -&gt;</div>
			</div>
		</div>
		<div class="icon-exit-container"><img src="/icons/close-2.svg" loading="lazy" alt="" class="icon-20x20"
		                                      @click="hide"></div>
	</div>
</template>

<script>
    import FeedbackRating from "./FeedbackRating";
    import moment from 'moment';
    import {mapGetters} from "vuex";

    export default {
        name: "FeedbackToast",
        components: {FeedbackRating},
        data() {
            return {
                // show: true
	            showToast: true
            }
        },
        methods: {
            hide() {
                this.showToast = false;

                var object = {timestamp: new Date().getTime()}

                localStorage.setItem("hide-survey", JSON.stringify(object));
            },
            showFeedbackModal() {
                this.$emit('show-survey', true);
                this.showToast = false;
            }
        },
        computed: {
            // ...mapGetters(['getUser']),
            show() {
                var object = JSON.parse(localStorage.getItem('hide-survey'));
                
                if (object) {
                    var diff = moment.duration(new moment().diff(object.timestamp));
                    
                    if(diff.asDays() < 3) return false;
                }
                

                return !this.$page.props.auth.user.survey_answered && this.showToast;
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
	
	.color-a3a3a3 {
		color: #a3a3a3;
	}
	
	.mb-12 {
		margin-bottom: 12px;
	}
	
	.modal {
		position: relative;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 454px;
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
	
	.mb-24 {
		margin-bottom: 24px;
	}
	
	.color-636363 {
		color: #636363;
	}
	
	.main-content-container {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-webkit-flex-direction: column;
		-ms-flex-direction: column;
		flex-direction: column;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: start;
		-webkit-align-items: flex-start;
		-ms-flex-align: start;
		align-items: flex-start;
	}
	
	.main-content-container.centered-v {
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		text-align: center;
	}
	
	.h3 {
		margin-top: 0px;
		margin-bottom: 0px;
		font-family: Inter, sans-serif;
		color: #fff;
		font-size: 20px;
		font-weight: 400;
	}
	
	.overlay {
		position: absolute;
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
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		background-color: #262626;
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
		position: relative;
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
		left: -40px;
		top: 0px;
		right: -40px;
		width: 452px;
		height: 4px;
		background-color: #2d2d2d;
	}
	
	.progress-indicator {
		width: 25%;
		height: 100%;
		background-color: #1592ff;
	}
	
	.progress-indicator.progress-50 {
		width: 50%;
	}
	
	.progress-indicator.progress-75 {
		width: 75%;
	}
	
	.progress-indicator.progress-100 {
		width: 100%;
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
	
	.radio-button.radio-button--active {
		border-style: none;
		background-color: #1592ff;
	}
	
	.radio-dot {
		width: 8px;
		height: 8px;
		border-radius: 8px;
		background-color: #fff;
	}
	
	.radio-dot.display-none {
		display: none;
	}
	
	.radio-container {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: start;
		-webkit-align-items: flex-start;
		-ms-flex-align: start;
		align-items: flex-start;
	}
	
	.left-container {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 50%;
		padding-right: 16px;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-webkit-flex-direction: column;
		-ms-flex-direction: column;
		flex-direction: column;
	}
	
	.right-container {
		width: 50%;
		padding-right: 16px;
	}
	
	.radio-parent-wrapper {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
	}
	
	.mt-2 {
		margin-top: 2px;
	}
	
	.input {
		width: 100%;
		height: 112px;
		padding-top: 16px;
		padding-right: 16px;
		padding-left: 16px;
		border: 1px solid #2e2e2e;
		border-radius: 4px;
	}
	
	.input-container {
		width: 100%;
	}
	
	.mb-32 {
		margin-bottom: 32px;
	}
	
	.alert-text-container {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.icon-exit-container {
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
		border-radius: 16px;
		-webkit-transition: background-color 50ms ease-in;
		transition: background-color 50ms ease-in;
		cursor: pointer;
	}
	
	.icon-exit-container:hover {
		background-color: #2d2d2d;
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
	
	.toast-text-container {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-webkit-flex-direction: column;
		-ms-flex-direction: column;
		flex-direction: column;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: start;
		-webkit-align-items: flex-start;
		-ms-flex-align: start;
		align-items: flex-start;
	}
	
	.toast {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 344px;
		padding: 16px 24px;
		-webkit-box-pack: justify;
		-webkit-justify-content: space-between;
		-ms-flex-pack: justify;
		justify-content: space-between;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border: 1px solid #262626;
		border-radius: 8px;
		background-color: #1c1c1c;
		box-shadow: 0 4px 12px 0 rgba(0, 0, 0, 0.1);
	}
	
	.toast.toast--survey {
		cursor: pointer;
	}
	
	.color-d1d1d1 {
		color: #d1d1d1;
	}
	
	.icon-32x32 {
		width: 32px;
		height: 32px;
		min-height: 32px;
		min-width: 32px;
	}
	
	.icon-24x24 {
		width: 24px;
		height: 24px;
		min-height: 24px;
		min-width: 24px;
	}
	
	.icon-20x20 {
		width: 20px;
		height: 20px;
	}
	
	.checkbox {
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
		border-radius: 4px;
		background-color: #303030;
	}
	
	.checkbox.checkbox--active {
		border-color: #1592ff;
		background-color: #1592ff;
	}
	
	.checkbox-container {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: start;
		-webkit-align-items: flex-start;
		-ms-flex-align: start;
		align-items: flex-start;
	}
	
	.icon-10x10 {
		width: 10px;
		height: 10px;
	}
	
	.color-555555 {
		color: #555;
	}


</style>
