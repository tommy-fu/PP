<!DOCTYPE html>
<!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Wed Jul 01 2020 15:38:21 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="5ef5cb889d9d13babc9ed3a5" data-wf-site="5ef5cb889d9d132a5f9ed3a4">
<head>
{{--    <!-- Google Tag Manager -->--}}
{{--    <script>(function (w, d, s, l, i) {--}}
{{--            w[l] = w[l] || [];--}}
{{--            w[l].push({--}}
{{--                'gtm.start':--}}
{{--                    new Date().getTime(), event: 'gtm.js'--}}
{{--            });--}}
{{--            var f = d.getElementsByTagName(s)[0],--}}
{{--                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';--}}
{{--            j.async = true;--}}
{{--            j.src =--}}
{{--                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;--}}
{{--            f.parentNode.insertBefore(j, f);--}}
{{--        })(window, document, 'script', 'dataLayer', 'GTM-ML7FGWQ');</script>--}}
{{--    <!-- End Google Tag Manager -->--}}
    <meta charset="utf-8">
    <title>Core UI</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="Webflow" name="generator">
    <link href="/dashboard/css/referral-overview.webflow.css" rel="stylesheet" type="text/css">
    <link href="/css/normalize.css" rel="stylesheet" type="text/css">
    <link href="/css/webflow.css" rel="stylesheet" type="text/css">
    <link href="/css/core-ui.webflow.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">WebFont.load({google: {families: ["Inter:300,regular,500,600,700"]}});</script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<!-- Google Tag Manager (noscript) -->
{{--<noscript>--}}
{{--    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-ML7FGWQ"--}}
{{--            height="0" width="0" style="display:none;visibility:hidden"></iframe>--}}
{{--</noscript>--}}
<!-- End Google Tag Manager (noscript) -->
<div id="app">


    <image-preview :show="true" image="/images/Placeholder-Image---Dark-UI.png"></image-preview>
    <div class="sectionservice">
        <div class="containerservice">


            <sidebar-user-menu></sidebar-user-menu>

            {{--            <sidebar-categories-menu></sidebar-categories-menu>--}}
            <div class="sidebarservice">
                <div class="categorieswrapperservice">
                    <a href="/sections" class="categoriesitem w-inline-block">
                        <div class="categoriescategory">All sections</div>
                        <div class="categoriesnumberlabel">{{$all_sections_count}}</div>
                    </a>

                    @foreach($categories as $category)
                        <a href="{{route('sections', ['slug' => $category->slug])}}" class="categoriesitem w-inline-block">
                            <div class="categoriescategory">{{$category->name}}</div>
                            <div class="categoriesnumberlabel">{{$category->sections_count}}</div>
                        </a>
                @endforeach
                </div>
            </div>


{{--            {{json_encode($sections)}}--}}
{{--            {{$iframeRoute}}--}}
            <iframe style="width: 100%;" src="{{$iframeRoute}}" frameborder="0"></iframe>
{{--            <section-container :sections="{{json_encode($sections)}}"></section-container>--}}

        </div>

        <toast :show="false"></toast>
        {{--		<div style="display:none;opacity:0" class="expandedcardcontainer">--}}
        {{--			<div class="expandedcardcontent"><img src="images/X-16.svg" data-w-id="01d9bb9c-b5bc-d925-5acf-c209f08d405c"--}}
        {{--			                                      alt="" class="exitbutton">--}}
        {{--				<div style="opacity:0" class="pulsecontainer">--}}
        {{--					<div class="cardextendeditemwrapper">--}}
        {{--						<div data-w-id="01d9bb9c-b5bc-d925-5acf-c209f08d405f" class="cardextendedcontainer">--}}
        {{--							<div class="cardproindicator cardproindicatorextended">--}}
        {{--								<div class="insideprocontainer"><img src="images/Star-White.svg" alt=""--}}
        {{--								                                     class="starimage"></div>--}}
        {{--								<div class="proindicatorlabel">Available on Pro Plan.</div>--}}
        {{--								<a href="#" class="proindicatorbutton w-inline-block">--}}
        {{--									<div class="goprotextbutton">Go Pro</div>--}}
        {{--									<img src="images/Arrow-Bare-White.svg" alt="" class="image-8"></a>--}}
        {{--							</div>--}}
        {{--							<div class="cardcopybuttonscontainer"><a data-w-id="01d9bb9c-b5bc-d925-5acf-c209f08d406a"--}}
        {{--							                                         href="#" class="copyhtmlbutton">Copy HTML</a><a--}}
        {{--										data-w-id="01d9bb9c-b5bc-d925-5acf-c209f08d406c" href="#" class="copycssbutton">Copy--}}
        {{--									CSS</a></div>--}}
        {{--						</div>--}}
        {{--						<div style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform-style:preserve-3d;opacity:0"--}}
        {{--						     class="cardpulseblock"></div>--}}
        {{--					</div>--}}
        {{--				</div>--}}
        {{--			</div>--}}
        {{--		</div>--}}
        {{--		@include('partials.pro_modal_container')--}}
        {{--		<image-preview></image-preview>--}}

    </div>
</div>

<script src="{{mix('js/app.js')}}"></script>
<script src="/js/iframeResizer.min.js"></script>

</body>
</html>
