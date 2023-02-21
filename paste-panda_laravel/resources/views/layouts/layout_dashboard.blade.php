<html data-wf-page="5f1d8c62a977f77daba70a8b" data-wf-site="5f1d8c62a977f7f82fa70a8a">
<head>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
					new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-ML7FGWQ');</script>
	<!-- End Google Tag Manager -->

	<meta charset="utf-8">
	<title>Referral - Overview</title>
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="Webflow" name="generator">

	<link href="{{ mix('css/dashboard.css') }}" rel="stylesheet">
	<link href="/dashboard/css/normalize.css" rel="stylesheet" type="text/css">
	<link href="/dashboard/css/webflow.css" rel="stylesheet" type="text/css">
	<link href="/dashboard/css/referral-overview.webflow.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>


	<script type="text/javascript">WebFont.load({google: {families: ["Inter:200,300,regular,500,600,700,800"]}});</script>
	<!-- [if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"
	        type="text/javascript"></script><![endif] -->
	<script type="text/javascript">!function (o, c) {
            var n = c.documentElement, t = " w-mod-";
            n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
        }(window, document);</script>
	<link href="/dashboard/images/favicon.ico" rel="shortcut icon" type="image/x-icon">
	<link href="/dashboard/images/webclip.png" rel="apple-touch-icon">
</head>
<body class="body-15">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-ML7FGWQ"
				  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="app">
	{{--	<div class="section">--}}
	<toast></toast>
	<div class="">
{{--		@include('dashboard.partials.dashboard_sidebar')--}}
		<div class="main-content" style="color: #FFF; ">
			<div class="container">
				@yield('content')
			</div>
		</div>
	</div>
</div>
<script src="{{mix('js/dashboard.js')}}"></script>
<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.4.1.min.220afd743d.js?site=5f1d8c62a977f7f82fa70a8a"
        type="text/javascript" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script src="/dashboard/js/webflow.js" type="text/javascript"></script>
<!-- [if lte IE 9]>
<script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>
