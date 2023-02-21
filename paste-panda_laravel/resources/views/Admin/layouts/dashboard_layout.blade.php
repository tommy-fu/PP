<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <link href="/dashboard.css" rel="stylesheet" type="text/css">
    {{--    <link href="{{ mix('/css/app.css') }}" rel="stylesheet"/>--}}
    <link href="/css/normalize.css" rel="stylesheet" type="text/css">

    <script src="{{ mix('/js/app.js') }}" defer></script>
</head>
<body style="background: #fff;">
@inertia
</body>
</html>

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
