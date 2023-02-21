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
                    {{--                    <a href="/sections" class="categoriesitem w-inline-block">--}}
                    {{--                        <div class="categoriescategory">All sections</div>--}}
                    {{--                        <div class="categoriesnumberlabel">{{$all_sections_count}}</div>--}}
                    {{--                    </a>--}}

{{--                    @foreach($categories as $category)--}}
{{--                        <a href="{{route('sections', ['slug' => $category->slug])}}"--}}
{{--                           class="categoriesitem w-inline-block">--}}
{{--                            <div class="categoriescategory">{{$category->name}}</div>--}}
{{--                            <div class="categoriesnumberlabel">{{$category->sections_count}}</div>--}}
{{--                        </a>--}}
{{--                @endforeach--}}

                    <a target="_blank" href="{{route('projects.show', ['project' => $project->id])}}"
                       class="categoriesitem w-inline-block">
                        <div class="categoriescategory">{{$project->name}}</div>
                        {{--                        <div class="categoriesnumberlabel">{{$category->sections_count}}</div>--}}
                    </a>

                    <div style="height: 1px; width: 100%; background: #EAEAEA; margin-top: 24px;"></div>

                    @foreach($project->pages as $pg)

                        <a href="{{route('pages.edit', ['page' => $pg->id])}}"
                           class="categoriesitem w-inline-block">
                            <div class="categoriescategory">{{$pg->name}}</div>
                            <div class="categoriesnumberlabel">{{$pg->sections->count()}}</div>
                        </a>
                    @endforeach

                    <div style="height: 1px; width: 100%; background: #EAEAEA; margin-top: 24px;"></div>

                    <a target="_blank" href="{{route('projects.convert.wordpress', ['project' => $project->id])}}"
                       class="categoriesitem w-inline-block">
                        <div class="categoriescategory">Download Wordpress</div>
{{--                        <div class="categoriesnumberlabel">{{$category->sections_count}}</div>--}}
                    </a>

                <!--            <a href="#" class="categoriesitem w-inline-block">-->
                    <!--                <div class="categoriescategory">Hero</div>-->
                    <!--                <div class="categoriesnumberlabel">29</div>-->
                    <!--            </a>-->
                    <!--            <a href="#" class="categoriesitem w-inline-block">-->
                    <!--                <div class="categoriescategory">Features</div>-->
                    <!--                <div class="categoriesnumberlabel">24</div>-->
                    <!--            </a>-->
                    <!--            <a href="#" class="categoriesitem w-inline-block">-->
                    <!--                <div class="categoriescategory">Call To Action</div>-->
                    <!--                <div class="categoriesnumberlabel">26</div>-->
                    <!--            </a>-->
                    <!--            <a href="#" class="categoriesitem w-inline-block">-->
                    <!--                <div class="categoriescategory">Newsletter</div>-->
                    <!--                <div class="categoriesnumberlabel">19</div>-->
                    <!--            </a>-->
                </div>
            </div>


            <div class="container">
                <div class="columns is-multiline">

                    @foreach($project->pages as $page)
                        <div class="column is-4">
                            <a href="{{route('pages.edit', ['page' => $page->id])}}">
{{--                                <div style="height: 200px; background: #EAEAEA;"></div>--}}
                                <iframe style="width: 100%; height: 200px;" src="{{route('pages.show', ['page' => $page->id])}}" frameborder="0"></iframe>
                                {{$page->name}}
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        <toast :show="false"></toast>

    </div>
</div>

<script src="{{mix('js/app.js')}}"></script>
<script src="/js/iframeResizer.min.js"></script>

</body>
</html>
