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
    @inertia
</div>

<script src="{{mix('js/app.js')}}"></script>
</body>
</html>
