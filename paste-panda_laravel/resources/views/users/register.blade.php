@extends('layouts.layout_small')

@section('content')
    @if(env('ENABLE_REGISTRATION'))
        <div class="has-text-centered mb-24">
            <h1 class="is-size-1 title">Early Access </h1>
            <div class="body-18 subtitle">Join a small number of beta users.</div>
        </div>

        <form action="{{route('users.register')}}" method="POST">
            {{csrf_field()}}

            <div class="field is-horizontal">
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input type="text" class="input w-input" name="first_name"
                                   value="{{old('first_name')}}"
                                   placeholder="First name">
                        </div>
                        <p class="help is-danger" style="margin: 0;">{{$errors->first('first_name')}}</p>
                    </div>


                    <div class="field">
                        <div class="control">
                            <input type="text"
                                   class="input w-input"
                                   name="last_name"
                                   value="{{old('last_name')}}"
                                   placeholder="Last name">
                        </div>
                        <p class="help is-danger" style="margin: 0;">{{$errors->first('last_name')}}</p>
                    </div>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <input type="email"
                           class="input w-input"
                           placeholder="Email"
                           value="{{old('email')}}"
                           name="email">
                </div>
                <p class="help is-danger" style="margin: 0;">{{$errors->first('email')}}</p>
            </div>

            <div class="field">
                <div class="control">
                    <input type="password"
                           class="input w-input"
                           name="password"
                           data-name="Password"
                           placeholder="Password">
                </div>
                <p class="help is-danger" style="margin: 0;">{{$errors->first('password')}}</p>
            </div>

            <div class="field">
                <div class="control">
                    <input type="password"
                           class="input w-input"
                           name="password_confirmation"
                           placeholder="Repeat password">
                </div>
                <p class="help is-danger" style="margin: 0;">{{$errors->first('password_confirmation')}}</p>
            </div>


            <div class="field">
                <div class="control">
                    <label class="checkbox" style="line-height: 24px;">
                        <input type="checkbox" name="terms">
                        By creating an account you agree to the <a href="{{route('terms')}}" target="_blank"
                                                                   class="has-text-link">Terms of
                            Use</a>
                        and our <a href="/privacy" target="_blank" class="has-text-link">Privacy
                            Policy</a>.
                    </label>
                </div>
            </div>


            @if ($errors->has('terms'))
                <div class="notification is-danger" style="padding: 12px 16px;">
                    <p class="is-size-6" style="margin: 0;">{{$errors->first('terms')}}</p>
                </div>
            @endif

            <input type="submit"
                   value="Create account"
                   class="button is-primary is-fullwidth">

            <div class="has-text-centered" style="margin-top: 12px;">
                <div class="is-flex" style="align-items: center; justify-content: center;">
                    <div class="has-text-white" style="margin-right: 8px;">Got an account?</div>
                    <a href="{{route('users.show_login')}}" class="inline-link">Log in here</a></div>
            </div>
        </form>

        </div>

    @else
        <div class="has-text-centered mb-24">
            <h1 class="is-size-1 title" style="margin-bottom: 32px;">The registration is now closed.</h1>
            <div class="body-18 subtitle">We will open the registration soon. If you want us to notify you, you can sign
                up to our newsletter.
            </div>
        </div>


{{--        <div class="field">--}}
{{--            <div class="control">--}}
{{--                <input type="email"--}}
{{--                       class="input w-input"--}}
{{--                       placeholder="Email"--}}
{{--                       value="{{old('email')}}"--}}
{{--                       name="email">--}}
{{--            </div>--}}
{{--            <p class="help is-danger" style="margin: 0;">{{$errors->first('email')}}</p>--}}
{{--        </div>--}}


{{--        <input type="submit"--}}
{{--               value="Sign up"--}}
{{--               class="button is-primary is-fullwidth">--}}
    @endif
@endsection
