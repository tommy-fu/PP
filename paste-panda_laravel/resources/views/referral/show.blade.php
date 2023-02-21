<!DOCTYPE html>
<!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Tue Jul 28 2020 15:10:44 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="5f1f10fa1c172ee160acba59" data-wf-site="5f1f10fa1c172e9027acba58">
<head>
	<meta charset="utf-8">
	<title>Signup Page</title>
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="Webflow" name="generator">
	<link href="/login/css/normalize.css" rel="stylesheet" type="text/css">
	<link href="/login/css/webflow.css" rel="stylesheet" type="text/css">
	<link href="/login/css/signup-page-3f7438.webflow.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
	<script type="text/javascript">WebFont.load({google: {families: ["Inter:300,regular,500,600,700,800"]}});</script>
	<!-- [if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"
	        type="text/javascript"></script><![endif] -->
	<script type="text/javascript">!function (o, c) {
            var n = c.documentElement, t = " w-mod-";
            n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
        }(window, document);</script>
	<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">
	<link href="images/webclip.png" rel="apple-touch-icon">
</head>
<body class="body-19">
<div class="section">
	<div class="header"><a href="#" class="brand w-nav-brand">
			<img src="images/logo-new-test.svg" alt=""
			     class="logosymbol"><img src="images/logo-text.png"
			                             width="957.5" alt=""
			                             class="logotext">
			<div class="betasign">
				<div class="betalabel">BETA</div>
			</div>
		</a>
		<a href="#" class="button button--download w-inline-block">
			<div class="cta-text cta-text--download">Go to Pastepanda.com</div>
			<img src="images/Arrow-1.svg" width="12" alt="" class="image"></a>
	</div>
	<div class="canvas">
		<div class="form-container">
			<h1 class="h1">Early Access </h1>
			<div class="body-18">Join a small number of beta users.</div>
			<form action="{{route('referral.store')}}" method="POST">
				{{csrf_field()}}

				<input type="hidden" name="affiliate_id" value="{{$affiliate_id}}">

				<div class="form-block w-form">
					<div class="form form--horizontal">
						<input type="text" class="input w-input" name="first_name"
						       placeholder="First name">
						<input type="text"
						       class="input input--horizontal w-input"
						       name="last_name"
						       placeholder="Last name">

					</div>
					<div class="form-block w-form">
						<input type="email"
						       class="input w-input"
						       placeholder="Email"
						       name="email">
					</div>
					<div class="form-block w-form">
						<input type="password"
						       class="input w-input"
						       name="Password"
						       data-name="Password"
						       placeholder="Password">
					</div>

					<div class="form-block w-form">
						<input type="password"
						       class="input w-input"
						       name="password_repeat"
						       placeholder="Repeat password">
					</div>


					<div class="form-block w-form">
						<label class="w-checkbox checkbox-field">
							<div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
							<input type="checkbox" id="checkbox" name="checkbox" data-name="Checkbox"
							       style="opacity:0;position:absolute;z-index:-1">
							<span class="checkbox-label w-form-label">By creating an account you agree to the <a
										target="_blank"
										href="/terms"
										class="inline-link">Terms of Use</a> and our <a
										href="/privacy"
										class="inline-link">Privacy Policy</a>.</span></label>
					</div>
					<div class="form-block w-form">

						<input type="submit"
						       value="Create account"
						       class="cta w-button">
						<div class="got-account-container">
							<div class="got-account-text">Got an account?</div>
							<a href="{{route('users.sign_in')}}" class="inline-link">Log in here</a></div>

					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.4.1.min.220afd743d.js?site=5f1f10fa1c172e9027acba58"
        type="text/javascript" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script src="js/webflow.js" type="text/javascript"></script>
<!-- [if lte IE 9]>
<script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>
