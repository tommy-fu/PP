<template>
	<div class="centered-v" style="text-align: center;">
		<div>
			<img src="/icons/checkmark.svg" loading="lazy" alt="" class="mb-24">
			<h3 class="h3 mb-16">Thank you for your submission.</h3>
			<div class="body-lg color-a3a3a3 centered-v">You’re helping us shape the Pastepanda library to become the
				last
				UI kit you ever used.
			</div>
		</div>
	</div>
</template>

<script>

    export default {
        name: "FeedbackSubmitted",
        props: ['value'],
        data() {
            return {
                selectedRating: null
            }
        },
        methods: {
            selectRating(rating) {
                this.$emit('')
            }
        },
        computed: {
            internalValue: {
                get() {
                    return this.value;
                },
                set(newValue) {
                    this.$emit('input', newValue);
                }
            },
        }
    }
</script>


<style scoped>
	a {
		text-decoration: underline;
	}
	
	.color-a3a3a3 {
		color: #a3a3a3;
	}
	
	.mb-24 {
		margin-bottom: 24px;
	}
	
	.centered-v {
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		text-align: center;
		height: 100%;
		display: flex;
	}
	
	.h3 {
		margin-top: 0px;
		margin-bottom: 0px;
		font-family: Inter, sans-serif;
		color: #fff;
		font-size: 20px;
		font-weight: 400;
		line-height: 30px;
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


</style>
