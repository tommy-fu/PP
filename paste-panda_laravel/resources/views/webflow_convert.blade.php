{{--{{$animations->getSelectors()}}--}}
@foreach($animations as $animation)
    <h1>{{$animation['title']}}</h1>
    {{--    {!! nl2br($animation->getAnimations()) !!}--}}
    @foreach($animation['items'] as $item)
{{--        <h3>{!! nl2br($item->getSelector()) !!}</h3>--}}
{{--        <br>--}}
        {{--        --------------------------------------------------}}
{{--        <br>--}}
        <p>
{{--            new TimelineLite()--}}

            @foreach($item->getAnimations() as $anim)
{{--                {{$anim}}--}}
                {{--            <p>{!! nl2br($anim->getResult()) !!}</p>--}}
                {!! nl2br($anim->asGsap()) !!}
            @endforeach
        </p>
{{--        --------------------------------------------------}}
    @endforeach
    <br>
    ------------------------------------------------
    <br>
    <br>
@endforeach

{{--<html>--}}
{{--<body>--}}
{{--@foreach($animation->getActionGroups() as $actionGroup)--}}
{{--    {{$actionGroup->getTitle()}}--}}
{{--    <br>--}}
{{--@endforeach--}}
{{--</body>--}}
{{--</html>--}}
