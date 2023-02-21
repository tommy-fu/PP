<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <link rel="stylesheet" href="/user-brands">

    {{--    @foreach($section->js->dependencies() as $dependencies)--}}
    {{--        <link href="{{$dependencies->url}}" rel="stylesheet" type="text/css">--}}
    {{--    @endforeach--}}

    @foreach($cssDependencies as $dependency)
        {!! $dependency !!}
    @endforeach

</head>
<body>
<div id="app">
    {!! $section->html_code->getPreviewHtml() !!}
</div>

<script src="{{ mix('/js/edit-section.js') }}"></script>

@foreach($jsDependencies as $dependency)
    {!! $dependency !!}
@endforeach


<script>
    {!! html_entity_decode($section->js->code() , ENT_QUOTES, 'UTF-8') !!}
</script>

<script>
    window.Echo.private('sections.' + {{$section->id}})
        .listen('\\App\\Domain\\Sections\\Events\\SectionUpdated', e => {
            window.location.reload();
        });


</script>
{{--<script type='text/javascript'--}}
{{--        src='https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/3.5.3/iframeResizer.contentWindow.js'></script>--}}

{{--</body>--}}

<style>
    {!!  $section->css   !!}
</style>
