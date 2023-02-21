<div id="section-208" class="is-fixed scheme-1268" style="background: #171717;">
    <!--<div class="is-relative">-->
    <div id="navbar" class="section is-flex is-justify-content-space-between is-align-items-center is-fullwidth"
         style="height: 128px; background: inherit;">
        <div class="container is-flex is-justify-content-space-between is-fullwidth">
            <div class="is-flex is-align-items-center mr-48-desktop">
                <!-- <img src="/kitspring_text.svg" style="height: 32px;"> -->
                <div class="has-background-gradient is-flex is-align-items-center is-justify-content-center"
                     style="height: 40px; width: 40px; border-radius: 2px;">
                    <img style="height: 20px;"
                         src="https://res.cloudinary.com/dyfkrtheb/image/upload/v1622525215/dark_logo_rlpatc.svg"/>
                </div>
                <img class="ml-16" style="height: 24px;" src="/logo.svg" id="nav-text"/>
            </div>
            <a href="/" class="nav_button_outlined mr-12 is-hidden is-block-desktop" style="text-decoration: none">Back to home</a>
            <a href="/" class="nav_button_outlined mr-12 is-hidden-desktop" style="text-decoration: none">Home</a>
        </div>
    </div>
</div>

<style>
    #navbar {
        height: 128px;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 10000;
    }

    body {
        background: #171717;
        padding-top: 128px;
    }

    #hamburger {

    }

    .hamburger {
        background: #2e2e2e;
        height: 40px;
        width: 40px;
        border-radius: 1000px;
        padding: 10px;
    }

    .hamburger:hover {
        opacity: 0.65;
        transition: 0.1s ease-in-out;
    }

    .hamburger-box {
        height: 20px;
        width: 20px;
    }

    /*.hamburger-inner, .hamburger-inner::before, .hamburger-inner::after {*/
    /*    width: 20px;*/
    /*    height: 2px;*/
    /*    background: #FFF;*/
    /*}*/

    .hamburger-inner {
        top: 54% !important;
    }

    .hamburger-inner, .hamburger-inner::before, .hamburger-inner::after, .hamburger.is-active .hamburger-inner, .hamburger.is-active .hamburger-inner::after, .hamburger.is-active .hamburger-inner::before {
        background: #a9a9a9;
        width: 20px;
        height: 2px;
    }

    .hamburger-inner::before {
        top: -6px;
    }

    .hamburger-inner::after {
        bottom: -6px;
    }
</style>

@section('scripts')
    @parent
    <!-- The rest of your scripts -->
    <script>
        gsap.to('#navbar', {
            "duration": 0.15,
            "delay": 0,
            "css": {
                "border-bottom": "1px solid #212121",
                'height': '80px',
            },
            scrollTrigger: {
                trigger: "body",
                start: "top",
                toggleActions: "play pause resume reverse",
            },
        })

        gsap.to('#nav-text', {
            "duration": 0.15,
            "x": -4,
            "opacity": 0,
            scrollTrigger: {
                trigger: "body",
                start: "top",
                toggleActions: "play pause resume reverse",
            },
        })

    </script>
@endsection
