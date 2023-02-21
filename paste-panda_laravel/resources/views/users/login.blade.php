@extends('layouts.layout_small')

@section('content')
	<div class="has-text-centered mb-32">
		<h1 class="is-size-2 title is-spaced">Log in to Pastepanda</h1>
		<h2 class="subtitle">If you have no account you can <a
					href="{{route('users.sign_up')}}" class="has-text-link">register here.</a></h2>
	</div>

	@if ($errors->has('incorrect_credentials'))
		<div class="notification is-danger mt-24" style="padding: 12px 16px;">
			<p class="is-size-6" style="margin: 0;">{{$errors->first('incorrect_credentials')}}</p>
		</div>
	@endif

	<form class="form" action="{{route('users.sign_in')}}" method="POST">
		{{csrf_field()}}

		<div class="field">
			<div class="control">
				<input type="input"
				       class="input"
				       name="email"
				       autocomplete="off"
				       value="{{old('email')}}"
				       placeholder="Email">
			</div>
			<p class="help is-danger" style="margin: 0;">{{$errors->first('email')}}</p>
		</div>

		<div class="field">
			<div class="control">
				<input type="password"
				       class="input"
				       name="password"
				       autocomplete="off"
				       placeholder="Password">
			</div>
			<p class="help is-danger" style="margin: 0;">{{$errors->first('password')}}</p>
		</div>

		<input type="submit" value="Sign in" class="button is-primary is-fullwidth">

		<div class="has-text-centered mt-16">
			<a href="{{route('forgot-password.index')}}" class="inline-link">Forgot your password?</a>
			{{--						<div class="is-flex" style="align-items: center; justify-content: center;">--}}
			{{--							<div class="has-text-white" style="margin-right: 8px;">Don't have an account?</div>--}}
			{{--							<a href="{{route('users.register')}}" class="inline-link">Sign up here</a>--}}
			{{--						</div>--}}
		</div>
	</form>
@endsection
