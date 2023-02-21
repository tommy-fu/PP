@extends('home_master')

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/home.css">
    <link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet"/>
    {{--    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>--}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <script src="/gsap/minified/gsap.min.js"></script>
    <script src="/gsap/minified/ScrollTrigger.min.js"></script>
    {{--    <link rel="stylesheet" href="https://cdn.knightlab.com/libs/juxtapose/latest/css/juxtapose.css">--}}
    {{--    <link type="text/css" href="/image-compare-viewer.min.css">--}}
    <link rel="stylesheet" href="https://unpkg.com/image-compare-viewer/dist/image-compare-viewer.min.css">
</head>

<body>

@include('home.partials.navbar')

@include('home.partials.hero')

@include('home.partials.browse_copy_paste')

@include('home.partials.clean_code')

@include('home.partials.design_companion')

@include('home.partials.style_packs')

@include('home.partials.enter_hex')

@include('home.partials.beautiful_palettes')

@include('home.partials.javascript')

@include('home.partials.showcase')

{{--@include('home.partials.7_minute_website')--}}

@include('home.partials.cta')

{{--@include('home.partials.modal')--}}

@include('home.partials.footer')

</body>


<style>
    .card {
        background: rgb(31, 31, 31);
    }

    .section {
        padding-left: 32px;
        padding-right: 32px;
    }

    .has-bg-default {
        background: #171717;
    }
</style>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
