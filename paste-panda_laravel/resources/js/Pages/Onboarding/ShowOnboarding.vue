<template>
	<div>
		<h1 class="h1 title is-size-2">One last thing...</h1>
		<div class="body-18 subtitle">In order to build a product you'll love, we need to know just a bit about you.
		</div>
		
		<form @submit.prevent="submit" method="POST">
			<div>
				<div class="field">
					<div class="control">
						<div class="is-fullwidth is-primary">
							<select @change="removeValidationError('title_id')" id="titleId" name="title_id" v-model="form.title_id" style="">
								<option value="">What&#x27;s your title?</option>
								<option v-for="title in titles" :key="title.id" :value="title.id">{{title.name}}
								</option>
							</select>
						</div>
					</div>
					<p class="help is-danger" style="margin: 0;" v-if="errors.title_id">{{errors.title_id}}</p>
				</div>
				
				<div class="field" v-if="form.title_id === 0">
					<div class="control">
						<input class="input w-input"
						       @change="removeValidationError('custom_title')"
						       v-model="form.custom_title"
						       v-if="form.title_id === 0"
						       placeholder="Please enter your title" style="margin-top: 8px;">
					</div>
					<p class="help is-danger" style="margin: 0;" v-if="errors.custom_title">{{errors.custom_title}}</p>
				</div>
				
				<div class="field">
					<div class="control">
						<div class="is-fullwidth is-primary">
							<select  @change="removeValidationError('website_type_id')" id="website_type_id" name="title_id" v-model="form.website_type_id">
								<option value="">What websites do you build most frequently?</option>
								<option v-for="title in website_types" :key="title.id" :value="title.id">{{title.name}}
								</option>
							</select>
						</div>
					</div>
					
					<p class="help is-danger" style="margin: 0;" v-if="errors.website_type_id">
						{{errors.website_type_id}}</p>
				
				</div>
				
				<div class="field" v-if="form.website_type_id === 0">
					<div class="control">
						<input  @change="removeValidationError('custom_website_type')" id="custom-website-type-input" class="input w-input" name="custom_website_type"
						       v-model="form.custom_website_type"
						       placeholder="Please enter the type of website" style="margin-top: 8px;">
					</div>
					<p class="help is-danger" style="margin: 0;" v-if="errors.custom_website_type">
						{{errors.custom_website_type}}</p>
				</div>
				
				<div class="form-block w-form">
					<input type="submit"
					       value="Continue to Pastepanda"
					       class="button is-primary is-fullwidth">
				</div>
			</div>
		</form>
	</div>
</template>

<script>
    export default {
        name: "ShowOnboarding",
        data() {
            return {
                form: {
                    title_id: '',
                    website_type_id: '',
                    custom_title: null,
                    custom_website_type: null
                }
            }
        },
        methods: {
            submit() {
                this.$inertia.post('/onboarding', this.form)
            },
            removeValidationError(field){
                if(this.errors[field] !== undefined){
                    delete this.errors[field];
                }
            },
        },
        props: {
            titles: Array,
            website_types: Array,
            errors: Object
        }
    }
</script>

<style scoped>
	select {
		box-shadow: inset 0 0.0625em 0.125em rgba(10, 10, 10, 0.05);
		max-width: 100%;
		width: 100%;
		background-color: #333333;
		border: none;
		border-radius: 4px;
		color: #fff;
		padding: 12px 12px;
		outline: none;
		font-family: Inter, sans-serif;
		font-size: 14px;
	}
</style>
