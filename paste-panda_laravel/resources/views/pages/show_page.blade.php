<head>
    <link href="{{route('user-brands.index')}}" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    @foreach($cssDependencies as $dependency)
        {!! $dependency !!}
    @endforeach
</head>

<body>
{!! $html !!}


@foreach($jsDependencies as $dependency)
    {!! $dependency !!}
@endforeach

<script src="/js/gsap/gsap.min.js"></script>
<script src="/js/gsap/ScrollTrigger.min.js"></script>

{{--<script>--}}
{{--    gsap.registerPlugin(ScrollTrigger);--}}
{{--</script>--}}

<script>
    @foreach($page->sections as $section)
        {!! html_entity_decode($section->js->code() , ENT_QUOTES, 'UTF-8') !!}
    @endforeach
</script>

</body>


<style>
    {{$css}}
{{--    @foreach($page->sections as $section)--}}
{{--        {!!  $section->css_codes->code()   !!}--}}
{{--    @endforeach--}}
</style>
