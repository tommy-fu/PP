@extends('layouts.layout_small')

@section('content')
	<div class="hero is-fullheight">
		<div class="hero-body">
			<div class="container" style="max-width: 320px;">

				@if($data != null)
				<div class="has-text-centered">
					<h1 class="is-size-2 title is-marginless">Reset password</h1>
					<div class="subtitle" style="margin-top: 12px;">Fill the fields to change your password.</div>
				</div>

				@if ($errors->has('email'))
					<div class="notification is-danger mt-24" style="padding: 12px 16px;">
						<p class="is-size-6" style="margin: 0;">{{$errors->first('email')}}</p>
					</div>
				@endif

				<form class="form" action="{{route('reset-password.store')}}" method="POST">
					{{csrf_field()}}

					<div class="field mt-24">
						<div class="control">
							<input type="input"
							       class="input"
							       name="email"
							       autocomplete="off"
							       readonly
							       value="{{$data->email}}"
							       placeholder="Email">
						</div>
					</div>

					<input type="hidden" name="token" value="{{$data->token}}">

					<div class="field">
						<div class="control">
							<input type="password"
							       class="input"
							       name="password"
							       autocomplete="off"
							       placeholder="Password">
						</div>
					</div>

					<div class="field">
						<div class="control">
							<input type="password"
							       class="input"
							       name="password_confirmation"
							       autocomplete="off"
							       placeholder="Repeat password">
						</div>
					</div>

					<input type="submit" value="Reset password" class="button is-primary is-fullwidth">

					<div class="has-text-centered" style="margin-top: 12px;">
						<div class="is-flex" style="align-items: center; justify-content: center;">
							<div class="has-text-white" style="margin-right: 8px;">Don't have an account?</div>
							<a href="{{route('users.register')}}" class="inline-link">Sign up here</a></div>
					</div>
				</form>
			</div>

			@else
				<div class="has-text-centered">
					<h1 class="is-size-3 title is-marginless">The token is invalid.</h1>
{{--					<div class="subtitle" style="margin-top: 12px;">Request a new password <a href="{{route('users.show_forgot_password')}}">here</a></div>--}}

					<button class="button is-primary is-fullwidth mt-24">Request a new password</button>
				</div>
			@endif
		</div>
	</div>
@endsection
