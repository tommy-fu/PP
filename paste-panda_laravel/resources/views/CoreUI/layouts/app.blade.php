<!DOCTYPE html>
<!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Wed Jul 01 2020 15:38:21 GMT+0000 (Coordinated Universal Time)  -->
<html>
<head>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-ML7FGWQ');</script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8">
    <title>Core UI</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    {{--    <meta content="Webflow" name="generator">--}}
    {{--    <link href="/dashboard/css/referral-overview.webflow.css" rel="stylesheet" type="text/css">--}}
    {{--    <link href="/css/normalize.css" rel="stylesheet" type="text/css">--}}
    {{--    <link href="/css/webflow.css" rel="stylesheet" type="text/css">--}}
    {{--    <link href="/css/core-ui.webflow.css" rel="stylesheet" type="text/css">--}}
    <link href="/api/brands/1" rel="stylesheet" type="text/css">
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>--}}
    {{--    <script type="text/javascript">WebFont.load({google: {families: ["Inter:300,regular,500,600,700"]}});</script>--}}
    {{--    <link href="{{ mix('css/app.css') }}" rel="stylesheet">--}}
</head>
<body>
@yield('content')
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-ML7FGWQ"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="app">
    <image-preview :show="true" image="/images/Placeholder-Image---Dark-UI.png"></image-preview>
    <div class="sectionservice is-relative is-clipped">
        <div class="containerservice">

            <div class="is-overlay" style="z-index: 1;" v-if="getShowBrandsSidebar"
                 @click="setShowBrandsSidebar(false)"></div>
            <div class="is-flex">
                <div class="is-flex" style="width: 350px;">
                    @include('CoreUI.user-sidebar')
                    @include('CoreUI.section-sidebar')
                </div>
                <div class="is-relative py-32" style="background: #1E1E1E; width: 100%; height: 100vh;">

                    <div class="card is-absolute px-0" style="width: 340px; right: 32px; top: 32px; background: #101010;
                    color: #FFF;
box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
border-radius: 8px;">
                        <div class="card-body px-16">
                            <div class="is-flex align-items-center">
                                <img src="/icons/check.svg" alt="">
                                <p class="ml-12 mb-0" style="color: #FFF;">Markup copied to clipboard!</p>
                            </div>
                        </div>
                    </div>
                    <iframe src="{{route('sections-library.show', ['category' => Request()->category, 'scheme' => Request()->scheme, 'brandId' => Request()->brandId])}}"
                            style="width: 100%; height: 100%; border: none;"></iframe>
                </div>
            </div>
        </div>

        {{--        <toast :show="false"></toast>--}}
    </div>
</div>


<style>
    .brandsMenu {
        right: -1400px;
        transition: .5s ease;
    }

    .brandsMenu.brandSlide {
        right: 0 !important;
        /*transition: .5s ease;*/
    }
</style>


<script src="{{mix('js/app.js')}}"></script>

</body>
</html>
