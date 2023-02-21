<template>
	<div>
		
		<form @submit.prevent="register" method="POST">
			<div class="has-text-centered mb-24">
				<h1 class="is-size-1 title" style="margin-bottom: 24px;">It's great to see you!</h1>
				<div class="body-18 subtitle">Join a small number of beta users.</div>
				
				<div class="field is-horizontal">
					<div class="field-body">
						<div class="field">
							<div class="control">
								<input type="text" class="input w-input" name="first_name"
								       v-model="form.first_name"
								       placeholder="First name">
							</div>
							<p class="help is-danger" style="margin: 0;" v-if="errors.first_name">{{errors.first_name}}</p>
						</div>
						
						
						<div class="field">
							<div class="control">
								<input type="text"
								       class="input w-input"
								       name="last_name"
								       v-model="form.last_name"
								       placeholder="Last name">
							</div>
							<p class="help is-danger" style="margin: 0;" v-if="errors.last_name">{{errors.last_name}}</p>
						</div>
					
					</div>
				</div>
				
				<div class="field">
					<div class="control">
						<input type="email"
						       class="input w-input"
						       placeholder="Email"
						       disabled
						       v-model="form.email"
						       name="email">
					</div>
					<p class="help is-danger" style="margin: 0;" v-if="errors.email">{{errors.email}}</p>
				</div>
				
				<div class="field">
					<div class="control">
						<input type="password"
						       class="input w-input"
						       name="password"
						       v-model="form.password"
						       placeholder="Password">
					</div>
					<p class="help is-danger" style="margin: 0;" v-if="errors.password">{{errors.password}}</p>
				</div>
				
				<div class="field">
					<div class="control">
						<input type="password"
						       class="input w-input"
						       name="password_confirmation"
						       v-model="form.password_confirmation"
						       placeholder="Repeat password">
					</div>
					<p class="help is-danger" style="margin: 0;" v-if="errors.password_confirmation">{{errors.password_confirmation}}</p>
				</div>
				
				<div class="field">
					<div class="control">
						<label class="checkbox" style="line-height: 24px;">
							<input type="checkbox" name="terms" v-model="form.terms">
							By creating an account you agree to the <a href="/terms" target="_blank"
							                                           class="has-text-link">Terms of
							Use</a>
							and our <a href="/privacy" target="_blank"
							           class="has-textan-link">Privacy
							Policy</a>.
						</label>
					</div>
				</div>
				
				<div class="notification is-danger" style="padding: 12px 16px;" v-if="errors.terms">
					<p class="is-size-6" style="margin: 0;">{{errors.terms}}</p>
				</div>
				
				
				<input type="submit"
				       value="Create account"
				       class="button is-primary is-fullwidth">
			
			</div>
		</form>
	</div>
</template>

<script>
    export default {
        name: "Invite",
        data() {
            return {
                form: {
                    first_name: '',
                    last_name: '',
                    password: '',
                    password_confirmation: '',
                    email: '',
	                terms: false,
	                code: ''
                }
            }
        },
        props: {
            invite: Object,
            errors: {}
        },
        methods: {
            register() {
	           this.$inertia.post('/invites/accept/', this.form);
            }
        },
	    created() {
            this.form.email = this.invite.email;
            this.form.code = this.invite.code;
        }
    }
</script>

<style scoped>

</style>
