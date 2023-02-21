<!DOCTYPE html>
<!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Tue Jul 28 2020 15:10:44 GMT+0000 (Coordinated Universal Time)  -->
<html>
<head>
	<meta charset="utf-8">
	<title>Pastepanda</title>
	<link href="{{ mix('css/dashboard.css') }}" rel="stylesheet">
</head>

@include('partials.header')

<section class="hero is-fullheight">
	<div class="hero-body">
		<div class="container has-text-centered" style="max-width: 400px;">
			<h1 class="title has-text-white is-size-1" style="margin-bottom: 12px;">@yield('title')</h1>
			<p class="subtitle" style="margin-top: 0; margin-bottom: 24px;">@yield('description')</p>
			
			<a href="/" class="button is-primary">Back to home</a>
		</div>
	</div>
</section>
