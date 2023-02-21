<template>
	<div>
		
		
		
		<form @submit.prevent="register" method="POST">
			
			<h1 class="is-size-1 title" style="margin-bottom: 24px;">Invite user</h1>
			<div class="body-18 subtitle">Join a small number of beta users.</div>
			
			
			<div class="field">
				<div class="control">
					<input type="email"
					       class="input w-input"
					       placeholder="Email"
					       v-model="form.email"
					       name="email">
				</div>
			</div>
			
			<p class="help is-danger" style="margin: 0;" v-if="errors.email">{{errors.email}}</p>
			
			<input type="submit"
			       value="Send invite"
			       class="button is-primary is-fullwidth">
		</form>
		
		<div class="notification is-success mt-24" v-if="$page.props.flash.success" style="padding: 12px 16px;">
			<p class="is-size-6" style="margin: 0;">{{ $page.props.flash.success }}</p>
		</div>
	</div>
</template>

<script>
    export default {
        name: "Invite",
        data() {
            return {
                form: {
                    email: '',
                }
            }
        },
        props: {
            invite: Object,
            errors: {}
        },
        methods: {
            register() {
                this.$inertia.post('/invites/', this.form).then(response => {
                    console.log(response);
	            });
            }
        },
    }
</script>

<style scoped>

</style>
