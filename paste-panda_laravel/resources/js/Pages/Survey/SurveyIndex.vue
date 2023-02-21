<template>
	<div class="container">
		<h4>What would you rate our product between 1-10?</h4>
		<select v-model="questions[0]['answer']">
			<option :value="index" v-for="index in 10" :key="index">{{index}}</option>
		</select>
		<h4>Would you consider recommending it to a friend or colleague?(yes no)</h4>
		<select v-model="questions[1]['answer']">
			<option value="Yes">Yes</option>
			<option value="No">No</option>
		</select>
		<h4>For what purpose are you using our product?(multiple choice) <br> Don’t like to design, improving my workflow,
			Which
			product are you currently using for this purpose?</h4>
		
		<input type="radio" value="Don’t like to design"/> <label for="">Don’t like to design</label>
		<input type="radio" value="Don’t like to design"/> <label for="">Don’t like to design</label>
		<input type="radio" value="Don’t like to design"/> <label for="">Don’t like to design</label>
		<input type="radio" value="Don’t like to design"/> <label for="">Don’t like to design</label>
		
		<h4>Which area would you say need the most improvement at the moment?Design, performance, help guides, usability and
			customer service</h4>
		
		<h4>Would you be willing to pay 50$ a month for this product?</h4>
	
		<button class="button" @click="sendSurvey">Send</button>
	</div>
</template>

<script>
    export default {
        name: "SurveyIndex",
        data() {
            return {
               questions: [
	               {
	                   question: 'What would you rate our product between 1-10?',
	                   'answer': ''
	               },
                   {
                       'answer': ''
                   },
                   {
                       'answer': ''
                   },
                   {
                       'answer': ''
                   },
                   {
                       'answer': ''
                   },
                   {
                       'answer': ''
                   }
               ]
            }
        },

        methods: {
            sendSurvey() {
	            this.$inertia.post('/survey', {
	                'answers': this.questions
	            });
            }
        },
    }
</script>

<style scoped>

</style>
