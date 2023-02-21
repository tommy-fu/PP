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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <meta content="Webflow" name="generator">
    {{--    <link href="/dashboard/css/referral-overview.webflow.css" rel="stylesheet" type="text/css">--}}
    <link href="/css/normalize.css" rel="stylesheet" type="text/css">
    <link href="/css/webflow.css" rel="stylesheet" type="text/css">
    <link href="/css/core-ui.webflow.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">WebFont.load({google: {families: ["Inter:300,regular,500,600,700"]}});</script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="/api/css/2/brands/11">
</head>
<body style="background: #F8F8F8;">
<!-- Google Tag Manager (noscript) -->
{{--<noscript>--}}
{{--    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-ML7FGWQ"--}}
{{--            height="0" width="0" style="display:none;visibility:hidden"></iframe>--}}
{{--</noscript>--}}
<!-- End Google Tag Manager (noscript) -->
<div id="app">


    <add-section-library page-id="{{$page->id}}" v-if="getShouldShowSectionLibrary"></add-section-library>
    {{--    <div style="width: 100%; background: #fff; position: absolute; top: 0; left: 0; bottom: 0; right: 0; z-index: 100;">--}}

    {{--        <div style="width: 300px; height: 100vh; border-right: 1px solid #EAEAEA; padding: 30px;">--}}
    {{--            <ul>--}}
    {{--                <li>--}}
    {{--                    <div style="display: flex; justify-content: space-between;">--}}
    {{--                        <span>All categories</span>--}}
    {{--                        <span>5</span>--}}
    {{--                    </div>--}}
    {{--                </li>--}}
    {{--                <li>Hero</li>--}}
    {{--                <li>Newsletter</li>--}}
    {{--                <li>Test</li>--}}
    {{--            </ul>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <image-preview :show="true" image="/images/Placeholder-Image---Dark-UI.png"></image-preview>
    <div class="sectionservice" v-if="!getShouldShowSectionLibrary">
        <div class="containerservice">
            <div class="sidebarservice"
                 style="width: 360px; background: #F8F8F8; border-right: 1px solid #E6E6E5; padding: 0;">
                <page-sections-sidebar page-id="{{$page->id}}"
                                       :sections="{{json_encode($code_sections)}}"></page-sections-sidebar>
            </div>

            <div style="width: 100%; height: 100%; height: 100vh;">
                <edit-page page-id="{{$page->id}}" :sections="{{json_encode($code_sections)}}"
                           :ids="{{json_encode($sections)}}"
                           route="{{route('html.preview')}}"></edit-page>
            </div>
            {{--            <section-container :sections="{{json_encode($sections)}}"></section-container>--}}

        </div>

        <toast :show="false"></toast>
    </div>
</div>

<script src="{{mix('js/app.js')}}"></script>
<script src="/js/iframeResizer.min.js"></script>

@if($page->id == 2)
    <script src="/js/simple-scrollspy.min.js"></script>
    <script>
        window.onload = function () {
            scrollSpy('#navbar', {
                sectionClass: '.scrollspy',
                activeClass: 'is-active',
                menuActiveTarget: '.nav_link',
                offset: 100,
                // scrollContainer: '.scroll-container'
            })
        }
    </script>
@endif

</body>
</html>
