<head>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;1,300;1,400&family=Roboto:ital@0;1&display=swap" rel="stylesheet">
    {{--	<link href="{{ mix('css/app.css') }}" rel="stylesheet">--}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<div id="section-builder">
    {{--	<html-builder></html-builder>--}}

    {{--	<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>--}}
    {{--	<lottie-player src="https://assets5.lottiefiles.com/datafiles/zc3XRzudyWE36ZBJr7PIkkqq0PFIrIBgp4ojqShI/newAnimation.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>--}}

    <panda-editor id="{{Request()->id}}"></panda-editor>
</div>



<script src="{{mix('js/section-builder.js')}}"></script>
