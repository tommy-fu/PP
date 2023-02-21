header {
height: {{$height}};
position: fixed;
top: 0;
left: 0;
right: 0;
z-index: 10000;
display: flex;
align-items: center;
justify-content: center;
width: 100%;

@if(!empty($background))
    background: {{$scheme['background']}} !important;
@endif
}

header .container {
width: 100%;
}


@if(!empty($background))
    body {
    padding-top: {{$height}};
    }
@endif



