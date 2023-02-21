{{--@extends('layouts.layout_dashboard')--}}

<head>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-ML7FGWQ');</script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8">
    <title>Core UI</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    {{--    <meta content="Webflow" name="generator">--}}
    {{--    <link href="/dashboard/css/referral-overview.webflow.css" rel="stylesheet" type="text/css">--}}
    {{--    <link href="/css/normalize.css" rel="stylesheet" type="text/css">--}}
    {{--    <link href="/css/webflow.css" rel="stylesheet" type="text/css">--}}
    {{--    <link href="/css/core-ui.webflow.css" rel="stylesheet" type="text/css">--}}
    <link href="/api/brands/1" rel="stylesheet" type="text/css">
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>--}}
    {{--    <script type="text/javascript">WebFont.load({google: {families: ["Inter:300,regular,500,600,700"]}});</script>--}}
    {{--    <link href="{{ mix('css/app.css') }}" rel="stylesheet">--}}
</head>
{{--@section('content')--}}
<div class="section py-48 py-64-tablet py-96-desktop">
    <div class="container">
        <div class="">

            <h1 class="title">Account Settings</h1>

            @if (Session::has('account_updated'))
                <div class="notification is-success mt-24" style="padding: 12px 16px;">
                    <p class="is-size-6" style="margin: 0;">{{Session::get('account_updated')}}</p>
                </div>
            @endif

            <div class="card">
                <div class="card-content">
                    <div class="title is-5">Personal details</div>
                    <form action="{{route('account.update')}}" method="POST">
                        {{csrf_field()}}

                        <div class="field">
                            <div class="control">
                                <input type="input"
                                       class="input"
                                       name="first_name"
                                       autocomplete="off"
                                       value="{{$user->first_name}}"
                                       placeholder="First name">
                            </div>

                            @if($errors->first('first_name'))
                                <p class="help is-danger is-marginless">{{$errors->first('first_name')}}</p>
                            @endif
                        </div>
                        <div class="field">
                            <div class="control">
                                <input type="input"
                                       class="input"
                                       name="last_name"
                                       autocomplete="off"
                                       value="{{$user->last_name}}"
                                       placeholder="Last name">
                            </div>

                            @if($errors->first('last_name'))
                                <p class="help is-danger is-marginless">{{$errors->first('last_name')}}</p>
                            @endif
                        </div>

                        <input type="submit" value="Update" class="button is-primary is-fullwidth">
                    </form>
                </div>
            </div>

            {{--			<h1 class="title">Update password</h1>--}}

            @if (Session::has('password_updated'))
                <div class="notification is-success mt-24" style="padding: 12px 12px;">
                    <p class="is-size-6" style="margin: 0;">{{Session::get('password_updated')}}</p>
                </div>
            @endif

            @if ($errors->has('password'))
                <div class="notification is-danger mt-24" style="padding: 12px 16px;">
                    <p class="is-size-6" style="margin: 0;">{{$errors->first('password')}}</p>
                </div>
            @endif

            <div class="card mt-24">
                <div class="card-content">
                    <div class="title is-5">Password details</div>

                    <form action="{{route('account.update_password')}}" method="POST">
                        {{csrf_field()}}

                        <div class="field">
                            <div class="control">
                                <input type="password"
                                       class="input"
                                       name="current_password"
                                       autocomplete="off"
                                       placeholder="Current password">
                            </div>

                            @if($errors->first('current_password'))
                                <p class="help is-danger is-marginless">{{$errors->first('current_password')}}</p>
                            @endif
                        </div>

                        <div class="field">
                            <div class="control">
                                <input type="password"
                                       class="input"
                                       name="password"
                                       autocomplete="off"
                                       placeholder="Password">
                            </div>

                            @if($errors->first('current_password'))
                                <p class="help is-danger is-marginless">{{$errors->first('password')}}</p>
                            @endif
                        </div>

                        <div class="field">
                            <div class="control">
                                <input type="password"
                                       class="input"
                                       name="password_confirmation"
                                       autocomplete="off"
                                       placeholder="Reset password">
                            </div>
                        </div>

                        {{--						<div class="field">--}}
                        {{--							<div class="control">--}}
                        {{--								<input type="password"--}}
                        {{--								       class="input"--}}
                        {{--								       name="password"--}}
                        {{--								       autocomplete="off"--}}
                        {{--								       placeholder="Current password">--}}
                        {{--							</div>--}}
                        {{--						</div>--}}

                        <input type="submit" value="Update password" class="button is-primary is-fullwidth">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{--@endsection--}}
