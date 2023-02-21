<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/home.css">
</head>

<body class="has-min-height-100vh">
@include('Guest.layout.navbar')

<div class="is-flex is-justify-content-space-between is-flex-direction-column is-fullheight">
    @yield('content')
    @include('Guest.layout.footer')
</div>
<script src="/gsap/minified/gsap.min.js"></script>
<script src="/gsap/minified/ScrollTrigger.min.js"></script>
@yield('scripts')
</body>
