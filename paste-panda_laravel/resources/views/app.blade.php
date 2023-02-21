<!DOCTYPE html>
<html>
<head>
<script>
var dataLayer = window.dataLayer = window.dataLayer || [];
dataLayer.push({
   'userID' : {{Auth::user()->id}}
});
</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-ML7FGWQ');</script>
<!-- End Google Tag Manager -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    {{--    <link href="/dashboard.css" rel="stylesheet" type="text/css">--}}
       <link href="{{ mix('/css/app.css') }}" rel="stylesheet"/>
    <link href="/css/normalize.css" rel="stylesheet" type="text/css">
    <link href="/css/icons.css" rel="stylesheet" type="text/css">

    <title>{{config('app.name')}}</title>
    <link href="favicon.png" rel="shortcut icon">

    <script src="{{ mix('/js/app.js') }}" defer></script>

<!--     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@voerro/vue-tagsinput@2.7.1/dist/style.css">
 --></head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-ML7FGWQ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
{{--<div style="height: 70px; background: green; color: #FFF; display: flex; align-items: center; padding: 0 32px;">--}}
{{--    <h4>Retrieve 20 sections by answering our survey!</h4>--}}
{{--</div>--}}
@inertia

<script type="text/javascript">window.$crisp = [];
    window.CRISP_WEBSITE_ID = "939c7b28-9b35-4bea-aad9-5a992fff32a6";
    (function () {
        d = document;
        s = d.createElement("script");
        s.src = "https://client.crisp.chat/l.js";
        s.async = 1;
        d.getElementsByTagName("head")[0].appendChild(s);
    })();

    $crisp.push(["set", "user:email", ["{{Auth::user()->email}}"]]);
    $crisp.push(["set", "user:nickname", ["{{Auth::user()->first_name . ' ' . Auth::user()->last_name }}"]]);
    $crisp.push(["safe", true]);
</script>

@if (config('app.env') === 'production')
    <!-- Hotjar Tracking Code for library.pastepanda.com -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:2222747,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
@endif


{{--<script src="/elastic-apm-rum.umd.min.js"></script>--}}
{{--<script>--}}
{{--    elasticApm.init({--}}
{{--        serviceName: 'Pastepanda',--}}
{{--        serverUrl: 'https://505002aef13640a294004b10e3c13503.apm.eu-west-1.aws.cloud.es.io'--}}
{{--    })--}}

{{--    const apm = elasticApm;--}}
{{--    const transaction = apm.startTransaction('Application start', 'custom');--}}

{{--</script>--}}
</body>
</html>

<style>

    @font-face {
        font-family: 'icons';
        /*src: url('./fonts/icons.eot?9243853');*/
        /*src: url('./font/icons.eot?9243853#iefix') format('embedded-opentype'),*/
        /*url('./font/icons.woff?9243853') format('woff'),*/
    url('./fonts/icons.ttf') format('truetype'),
        /*url('./font/icons.svg?9243853#icons') format('svg');*/
    font-weight: normal;
        font-style: normal;
    }


    .demo-icon {
        font-family: "icons";
        font-style: normal;
        font-weight: normal;
        speak: never;

        display: inline-block;
        text-decoration: inherit;
        width: 1em;
        margin-right: .2em;
        text-align: center;
        /* opacity: .8; */

        /* For safety - reset parent styles, that can break glyph codes*/
        font-variant: normal;
        text-transform: none;

        /* fix buttons height, for twitter bootstrap */
        line-height: 1em;

        /* Animation center compensation - margins should be symmetric */
        /* remove if not needed */
        margin-left: .2em;

        /* You can be more comfortable with increased icons size */
        /* font-size: 120%; */

        /* Font smoothing. That was taken from TWBS */
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;

        /* Uncomment for 3D effect */
        /* text-shadow: 1px 1px 1px rgba(127, 127, 127, 0.3); */
    }

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

    /*.tabs-component {*/
    /*    margin: 4em 0;*/
    /*}*/

    /*.tabs-component-tabs {*/
    /*    border: solid 1px #ddd;*/
    /*    border-radius: 6px;*/
    /*    margin-bottom: 5px;*/
    /*}*/

    /*@media (min-width: 700px) {*/
    .tabs-component-tabs {
        border: 0;
        align-items: stretch;
        display: flex;
        justify-content: flex-start;
        padding: 0;
        /*margin-bottom: -1px;*/
    }

    /*}*/

    .tabs-component-tab {
        font-size: 14px;
        font-weight: 600;
        margin-right: 0;
        list-style: none;
        padding: 8px;
    }

    /*.tabs-component-tab:not(:last-child) {*/
    /*    border-bottom: dotted 1px #ddd;*/
    /*}*/

    /*.tabs-component-tab:hover {*/
    /*    color: #666;*/
    /*}*/

    .tabs-component-tab a {
        color: #262626;

        /*opacity: 0.6;*/
    }

    .tabs-component-tab.is-active {
        font-size: 14px;
        font-weight: 600;
        margin-right: 0;
        list-style: none;
        background: dodgerblue;
        color: #FFF !important;
        padding: 8px;
        border-radius: 4px;
    }

    .tabs-component-tab.is-active a {
        color: #FFF;
        font-weight: 400;
        font-family: Inter;
    }

    .tabs-component-tab.is-disabled * {
        color: #cdcdcd;
        cursor: not-allowed !important;
    }

    /*@media (min-width: 700px) {*/
    /*    .tabs-component-tab {*/
    /*        background-color: #fff;*/
    /*        border: solid 1px #ddd;*/
    /*        border-radius: 3px 3px 0 0;*/
    /*        margin-right: .5em;*/
    /*        transform: translateY(2px);*/
    /*        transition: transform .3s ease;*/
    /*    }*/

    /*    .tabs-component-tab.is-active {*/
    /*        border-bottom: solid 1px #fff;*/
    /*        z-index: 2;*/
    /*        transform: translateY(0);*/
    /*    }*/
    /*}*/

    /*.tabs-component-tab-a {*/
    /*    align-items: center;*/
    /*    color: inherit;*/
    /*    display: flex;*/
    /*    padding: .75em 1em;*/
    /*    text-decoration: none;*/
    /*}*/

    /*.tabs-component-panels {*/
    /*    padding: 4em 0;*/
    /*}*/

    /*@media (min-width: 700px) {*/
    /*    .tabs-component-panels {*/
    /*        border-top-left-radius: 0;*/
    /*        background-color: #fff;*/
    /*        border: solid 1px #ddd;*/
    /*        border-radius: 0 6px 6px 6px;*/
    /*        box-shadow: 0 0 10px rgba(0, 0, 0, .05);*/
    /*        padding: 4em 2em;*/
    /*    }*/
    /*}*/

</style>
