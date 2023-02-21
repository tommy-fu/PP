<!DOCTYPE html>
<html>
<head>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
					new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-ML7FGWQ');</script>
	<!-- End Google Tag Manager -->

	<meta charset="utf-8">
	<title>@yield('title')</title>
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<link href="{{ mix('css/dashboard.css') }}" rel="stylesheet">

</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-ML7FGWQ"
				  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div>
	@if(Session::has('notification'))
		<div class="notification is-success" style="padding: 12px 16px; border-radius: 0;">
			<p class="is-size-6" style="margin: 0;">{{Session::get('notification')}}</p>
		</div>
	@endif
	<div class="hero is-fullheight">
		@include('partials.header')
		<div class="hero-body">
			<div class="container" style="max-width: 360px;">
				@yield('content')
			</div>
		</div>
	</div>
</div>

</body>


