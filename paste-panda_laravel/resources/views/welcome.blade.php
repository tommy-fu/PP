<!DOCTYPE html>
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
    <title>Pastepanda</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="/dashboard.css" rel="stylesheet" type="text/css">
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-ML7FGWQ"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="app">
    <div class="is-flex" style="height: 100vh;">
        @include('CoreUI.user-sidebar')
        <sections-page></sections-page>

        <iframe src="{{route('sections-library.show', ['category' => Request()->category, 'scheme' => Request()->scheme, 'brandId' => Request()->brandId])}}"
                style="width: 100%; height: 100%; border: none;"></iframe>

    </div>
    <image-preview :show="true" image="/images/Placeholder-Image---Dark-UI.png"></image-preview>
    {{--    <div class="sectionservice is-relative is-clipped">--}}
    {{--        <div class="containerservice">--}}

    {{--            <div class="is-overlay" style="z-index: 1;" v-if="getShowBrandsSidebar"--}}
    {{--                 @click="setShowBrandsSidebar(false)"></div>--}}
    {{--            <div class="is-flex">--}}
    {{--                <div class="is-flex" style="width: 350px;">--}}
    {{--                    @include('CoreUI.user-sidebar')--}}
    {{--                    <section-sidebar></section-sidebar>--}}
    {{--                    @include('CoreUI.section-sidebar')--}}
    {{--                </div>--}}
    {{--                <div class="is-relative" style="background: #262626; width: 100%; height: 100vh;">--}}

    {{--                    <div class="card is-absolute px-0" style="width: 340px; right: 32px; top: 32px; background: #101010;--}}
    {{--                    color: #FFF;--}}
    {{--box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);--}}
    {{--border-radius: 8px;">--}}
    {{--                        <div class="card-body px-16">--}}
    {{--                            <div class="is-flex align-items-center">--}}
    {{--                                <img src="/icons/check.svg" alt="">--}}
    {{--                                <p class="ml-12 mb-0" style="color: #FFF;">Markup copied to clipboard!</p>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}

    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}



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

    .sidebar-item {
        color: #707070;
        border-radius: 8px;
        font-size: 16px;
    }

    .sidebar-item.is-active {
        background: rgba(21, 146, 255, 0.15);
        color: #1592FF;
    }
</style>

{{--<script src="/elastic-apm-rum.umd.min.js" crossorigin></script>--}}
{{--<script>--}}
{{--    elasticApm.init({--}}
{{--        // serviceName: 'your-app-name',--}}
{{--        // serverUrl: 'http://localhost:8200',--}}
{{--        // Override service name from package.json--}}
{{--        // Allowed characters: a-z, A-Z, 0-9, -, _, and space--}}
{{--        serviceName: 'Pastepanda Test',--}}
{{--        // Use if APM Server requires a token--}}
{{--        secretToken: 'ukICIlo63OAvpRWmWo',--}}
{{--        // Set custom APM Server URL (default: http://localhost:8200)--}}
{{--        serverUrl: 'https://6ab758175c7044ca9840f3c892bcb70b.apm.eu-west-1.aws.cloud.es.io'--}}
{{--    })--}}
{{--</script>--}}
<script src="{{mix('js/app.js')}}"></script>
</body>
</html>
