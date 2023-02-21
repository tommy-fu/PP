<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
{{--    <link href="/dashboard.css" rel="stylesheet" type="text/css">--}}
<!--    <link rel="stylesheet" href="/css/hamburgers.css" />-->
    <link href="{{route('user-brands.index')}}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    {{--    <link href="{{ mix('/css/app.css') }}" rel="stylesheet"/>--}}
    <link rel="stylesheet" href="https://unpkg.com/image-compare-viewer/dist/image-compare-viewer.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.0.0/video-js.min.css">
    <link href="/css/{{Request()->section->id}}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

</head>
<body>
@inertia
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="/js/gsap/gsap.min.js"></script>
<script src="/js/gsap/ScrollTrigger.min.js"></script>
{{--<script src="/accordion.js"></script>--}}
<script src="/image-compare-viewer.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.0.0/video.min.js"></script>
<script src="/js/{{Request()->section->id}}"></script>

{{--<script src="/sections.js"></script>--}}
<script src="{{ mix('/js/app.js') }}" defer></script>

</body>
</html>

