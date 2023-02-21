<div id="section-208" class="is-fixed scheme-1268">
    <!--<div class="is-relative">-->
    <div id="navbar" class="section has-bg-default is-flex is-justify-content-space-between is-align-items-center is-fullwidth" style="height: 128px;">
        <div class="container is-flex is-justify-content-space-between is-fullwidth">
            <div class="is-flex is-align-items-center mr-48">
                <img style="height: 32px;" src="/kitspring_text.svg" /> <img class="ml-24" style="height: 24px;" src="/logo.svg" id="nav-text" />
            </div>
            <div id="link-container" class="is-flex is-8 is-align-items-center is-hidden is-flex-desktop">
                <a class="nav_link mb-0 mr-24">Copy & paste</a> <a class="nav_link mb-0 mr-24">Styles</a> <a class="nav_link mb-0 mr-24">Colors</a> <a class="nav_link mb-0 mr-24">Interactivity</a>
                <a class="nav_link mb-0 mr-24">Showcase</a> <a class="nav_link mb-0">Guide</a>
            </div>
            <div class="is-flex is-align-items-center">
                <button class="nav_button_outlined is-hidden is-flex-desktop mr-12">Sign in</button> <button id="nav-cta" class="nav_button mr-12 mr-0-desktop">Join Beta</button>
                <div id="hamburger" class="burger burger-arrow burger-right is-hidden-desktop">
                    <div class="burger-lines"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="fragment-1" class="section has-bg-default is-flex is-hidden-tablet is-hidden-desktop" style="display: flex; flex: 1; width: 100%; display: none;">
        <!--    <div class="container is-relative" style="height: calc(100vh - 128px); width: 100%;"> <!– Full height minus navbar's height –>-->
        <div class="container is-relative" style="width: 100%;">
            <!-- Full height minus navbar's height -->
            <!--        <div class="column is-12 is-flex is-flex-direction-column is-align-items-center is-justify-content-center" style="overflow-y: scroll; height: calc(100% - 128px);"> <!– Full height minus CTA bar's height –>-->
            <div class="is-flex is-flex-direction-column is-justify-content-space-between is-fullheight is-relative is-flex-grow-1 is-align-items-center" style="overflow: hidden;">
                <!--                    <div style="overflow: auto;">-->
                <div style="flex:1 1 auto; overflow-y: scroll; height: 0; min-height: 100px; width: 100%;">
                    <div class="is-flex is-flex-direction-column is-align-items-center is-fullwidth is-fullheight">
                        <a href="#" class="h3 mb-24 mobile-link" style="text-decoration: none;">Copy & paste</a> <a href="#" class="h3 mb-24 mobile-link" style="text-decoration: none;">Styles</a> <a href="#"
                                                                                                                                                                                                       class="h3 mb-24 mobile-link" style="text-decoration: none;">Colors</a> <a href="#" class="h3 mb-24 mobile-link" style="text-decoration: none;">Interactivity</a> <a href="#" class=
                        "h3 mb-24 mobile-link" style="text-decoration: none;">Showcase</a> <a href="#" class="h3 mb-24 mobile-link" style="text-decoration: none;">Guide</a> <!--                    </div>-->
                    </div><!--                    </div>-->
                </div>
                <div class="is-flex is-flex-direction-column has-text-centered is-align-items-center pb-24 is-fullwidth">
                    <hr class="mb-24" />
                    <div class="is-12 is-flex">
                        <a class="button_outlined is-fullwidth mr-12 mobile-link">Sign in</a> <button class="button_md is-fullwidth mb-0 mobile-link">Get access</button>
                    </div>
                </div>
            </div><!--                            <div class="column is-12 is-flex is-flex-direction-column has-text-centered is-align-items-center pb-24 is-absolute"-->
            <!--                                 style="bottom: 0; right: 0; left: 0; background: transparent;">-->
            <!--                                    <hr class="mb-24">-->
            <!--                                    <div class="is-12 is-flex">-->
            <!--                                            <a class="button_outlined is-fullwidth mr-12 mobile-link">Sign in</a>-->
            <!--                                            <button class="button_md is-fullwidth mb-0 mobile-link">Get access</button>-->
            <!--                                    </div>-->
            <!--                            </div>-->
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <!-- The rest of your scripts -->
    <script src="/js/simple-scrollspy.min.js"></script>
    <script>
        gsap.to('#navbar', {
            "duration": 0.15,
            "delay": 0,
            "css": {
                "border-bottom": "1px solid #1C1E1F",
                'height': '80px',
            },
            scrollTrigger: {
                trigger: "body",
                markers: true,
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
                markers: true,
                start: "top",
                toggleActions: "play pause resume reverse",
            },
        })

        gsap.to('#link-container', {
            "duration": 0.15,
            "x": -96,
            scrollTrigger: {
                trigger: "body",
                markers: true,
                start: "top",
                toggleActions: "play pause resume reverse",
            },
        })

        document.getElementById("hamburger").addEventListener("click", function(){
            var x = document.getElementById("fragment-1");

            if (x.style.display === "none") {
                x.style.display = "flex";


                gsap.to('#hamburger', {
                    "duration": 0.15, "css": {
                        "background": "#2B3033"
                    }
                });

                gsap.to('body', {
                    "duration": 0, "css": {
                        "overflow": "hidden"
                    }
                });


                gsap.to('#section-208', {
                    "duration": 0, "css": {
                        "display": "flex",
                        "flexDirection": "column",
                        "alignItems": "center",
                        "height": "100%",
                        "justifyContent": "space-between",
                        "top": "0",
                        // "left": "0",
                        // "right": "0",
                        // "bottom": "0",
                        "width": "100%",
                        "position": "fixed",
                        "zIndex": "10000",
                        "inset": "auto"
                    }
                });

                gsap.to('#navbar', {
                    "duration": 0, "css": {
                        "position": "static"
                    }
                });

                gsap.to("#nav-cta", {
                    y: -8,
                    opacity: 0,
                    duration: 0.15,
                    delay: 0.15,
                });

                gsap.from(".mobile-link", {
                    y: -8,
                    opacity: 0,
                    duration: 0.15,
                    stagger: 0.1 // 0.1 seconds between when each ".box" element starts animating
                });

            }
            else {
                x.style.display = "none";

                gsap.to('#hamburger', {
                    "duration": 0.15, "css": {
                        "background": "transparent"
                    }
                });

                gsap.to('body', {
                    "duration": 0, "css": {
                        "overflow": "auto"
                    }
                });

                gsap.to('body', {
                    "duration": 0, "css": {
                        "overflow": "scroll"
                    }
                });

                gsap.to("#nav-cta", {
                    y: 0,
                    opacity: 1,
                    duration: 0.15,
                    delay: 0.15,
                });

                gsap.to('#navbar', {
                    "duration": 0, "css": {
                        "position": "fixed"
                    }
                });

                gsap.to('#section-208', {
                    "duration": 0, "css": {
                        "display": "block",
                        "top": "auto",
                        "left": "auto",
                        "right": "auto",
                        "bottom": "auto",
                        "height": "auto",
                        // "position": "fixed"
                    }
                });
            }

// document.getElementById('hamburger').click();

//
// document.getElementById("fragment-1-close").addEventListener("click", function () {
//     var x = document.getElementById("fragment-1");
//     x.style.display = "none";
// });

        });

    </script>
@endsection

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
        background: rgb(19, 19, 19);
        padding-top: 128px;
    }

    #hamburger {

    }

    .burger {
        /*background: #2B3033;*/
        position: relative;
        font-size: 8px;
        cursor: pointer;
        transition: .2s all;
        -webkit-tap-highlight-color: transparent;
        height: 40px;
        width: 40px;
    }

    .burger:after {
        content: '';
        display: block;
        position: absolute;
        height: 150%;
        /*width: 150%;*/
        width: 100%;
        top: -25%;
        /*left: -25%;*/
    }

    .burger .burger-lines {
        top: 50%;
        background: #fff;
        height: 2px
    }

    .burger .burger-lines, .burger .burger-lines:after, .burger .burger-lines:before {
        pointer-events: none;
        display: block;
        content: '';
        width: 100%;
        border-radius: 0.25em;
        /*background-color: white;*/
        /*height: 0.25em;*/
        position: absolute;
        transform: rotate(0);
        height: 2px;
        background: #fff;
    }

    .burger .burger-lines:after {
        /*left: 0;*/
        top: -1em;
    }

    .burger .burger-lines:before {
        /*left: 1em;*/
        top: 1em;
    }


    /*ANIMATION*/

    .burger.burger-arrow .burger-lines, .burger.burger-arrow .burger-lines:after, .burger.burger-arrow .burger-lines:before {
        transition: .2s top, .2s left, .2s transform, .4s background-color .2s;
    }

    .burger.burger-arrow .burger-lines:after, .burger.burger-arrow .burger-lines:before {
        /*width: 2em;*/
        width: 100%;
    }

    .burger.burger-arrow.burger-right {
        transform: rotateY(180deg);
    }

    .burger.burger-arrow.burger-right .burger-lines:after {
        /*left: 1em;*/
    }

    .burger.burger-arrow.burger-right .burger-lines:before {
        /*left: 0em;*/
    }

    .burger.burger-arrow.is-active .burger-lines, .burger.burger-arrow.is-active .burger-lines:after, .burger.burger-arrow.is-active .burger-lines:before {
        transition: .2s background-color, .2s top, .2s left, .2s transform;
    }

    .burger.burger-arrow.is-active .burger-lines {
        /*background-color: rgba(255, 255, 255, 0.7);*/
        opacity: 0.7;
    }

    .burger.burger-arrow.is-active .burger-lines:before, .burger.burger-arrow.is-active .burger-lines:after {
        /*left: -.3em;*/
        top: 0px;
    }

    .burger.burger-arrow.is-active .burger-lines:before {
        top: -.62em;
        transform: rotate(-45deg);
    }

    .burger.burger-arrow.is-active .burger-lines:after {
        top: .62em;
        transform: rotate(45deg);
    }
</style>
