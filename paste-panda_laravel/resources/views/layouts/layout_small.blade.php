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
	<title>{{config('app.name')}}</title>
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

<script type="text/javascript">window.$crisp = [];
	window.CRISP_WEBSITE_ID = "939c7b28-9b35-4bea-aad9-5a992fff32a6";
	(function () {
		d = document;
		s = d.createElement("script");
		s.src = "https://client.crisp.chat/l.js";
		s.async = 1;
		d.getElementsByTagName("head")[0].appendChild(s);
	})();</script>

@if (config('app.env') === 'production')
	<!-- Hotjar Tracking Code for library.pastepanda.com -->
	<script>
		(function(h,o,t,j,a,r){
			h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
			h._hjSettings={hjid:2222747,hjsv:6};
			a=o.getElementsByTagName('head')[0];
			r=o.createElement('script');r.async=1;
			r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
			a.appendChild(r);
		})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
	</script>
@endif

</body>


