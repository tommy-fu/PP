@extends('layouts.layout_small')

@section('content')
{{--	<div class="hero is-fullheight">--}}
{{--		<div class="hero-body">--}}
{{--			<div class="container">--}}
				<div class="has-text-centered">
					<h1 class="is-size-2 is-size-3-mobile title is-marginless">Forgot password</h1>
					<div class="subtitle is-size-5 is-size-6-mobile" style="margin-top: 12px;">If the entered email is connected to Pastepanda you’ll receive a reset link in your inbox.</div>
				</div>

				@if ($errors->has('email'))
					<div class="notification is-danger mt-24" style="padding: 12px 16px;">
						<p class="is-size-6" style="margin: 0;">{{$errors->first('email')}}</p>
					</div>
				@endif

				<form class="form" action="{{route('forgot-password.store')}}" method="POST">
					{{csrf_field()}}

					<div class="field mt-24">
						<div class="control">
							<input type="input"
							       class="input"
							       name="email"
							       autocomplete="off"
							       value="{{old('email')}}"
							       placeholder="Email">
						</div>
					</div>

					<input type="submit" value="Reset password" class="button is-primary is-fullwidth">

					<div class="has-text-centered" style="margin-top: 12px;">
						<div class="is-flex" style="align-items: center; justify-content: center;">
							<div class="has-text-white" style="margin-right: 8px;">Already have an account?</div>
							<a href="{{route('users.show_login')}}" class="inline-link">Login here</a></div>
					</div>
				</form>
{{--			</div>--}}
{{--		</div>--}}
{{--	</div>--}}
@endsection
