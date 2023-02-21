<div id="section-219" class="section is-relative py-72 pb-48 py-64-landscape py-144-desktop scheme-1268">
    <div class="container">
        <div class="has-text-left has-text-centered-desktop">
            <div class="mb-56 mb-0-tablet">
                <h4 id="top" class="caption-lg mb-8 mb-12-tablet has-text-base">
                    Less design, better results.
                </h4>
                <h1 id="second" class="mega pb-12-tablet mb-0" style=
                "background-image: -webkit-linear-gradient(135deg, #904DC4 0%, #4384E6 33%, #4AD0FF 66%, #00FFBE 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; -webkit-animation: hue 2.75s infinite ease-in-out; -webkit-animation-direction: alternate;">
                    Web design blocks, for every project.
                </h1>
            </div>
            <div id="tablet-video-container" class="video-container mb-32 mb-40-tablet is-clipped has-border-radius-xl has-min-height-500-tablet has-min-height-600-desktop is-hidden is-block-tablet" style=
            "transform: perspective(900px) rotateX(45deg); width: 100%;">
                <video id="my-video" class="video-js vjs-default-skin has-min-height-500-tablet has-min-height-600-desktop" style="width: 100%;" preload="auto" poster=
                "https://res.cloudinary.com/dyfkrtheb/image/upload/v1621342324/video_thumbnail_zz8ra3.png" data-setup='{ "aspectRatio":"640:267", "playbackRates": [1, 1.5, 2] }' controls=""><source src=
                                                                                                                                                                                                      "/videos/Pexels.mp4" type="video/mp4" />
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="https://videojs.com/html5-video-support/">supports HTML5 video</a>
                    </p></video>
            </div>
            <div class="video-container mb-32 mb-40-tablet is-clipped has-border-radius-xl has-min-height-200 has-min-height-250-landscape is-block is-hidden-tablet" style="width: 100%;">
                <video id="my-video2" class="video-js vjs-default-skin has-min-height-200 has-min-height-250-landscape" style="width: 100%;" preload="auto" poster=
                "https://res.cloudinary.com/dyfkrtheb/image/upload/v1621342324/video_thumbnail_zz8ra3.png" data-setup='{ "aspectRatio":"640:267", "playbackRates": [1, 1.5, 2] }' controls=""><source src=
                                                                                                                                                                                                      "/videos/Pexels.mp4" type="video/mp4" />
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="https://videojs.com/html5-video-support/">supports HTML5 video</a>
                    </p></video>
            </div>
            <div class="is-align-items-center avatar-container is-justify-content-center is-hidden is-flex-tablet" style="opacity: 0;">
                <h5 class="h5 mb-0 has-text-muted">
                    Watch us build this page in 7 minutes with Kitspring.
                </h5>
            </div>
            <div class="is-align-items-center is-justify-content-center is-flex is-hidden-tablet">
                <h5 class="h5 mb-0 has-text-muted">
                    Watch us build this page in 7 minutes with Kitspring.
                </h5>
            </div>
        </div>
    </div>
</div>


@section('scripts')
    @parent
    <!-- The rest of your scripts -->
    <script>

        gsap.registerPlugin(ScrollTrigger);

        function myFunction(mediaQuery) {
            if (mediaQuery.matches) { // If media query matches

                // Less or equal = Do nothing

            } else {

                // Greater than = Execute code below

                gsap.to("#top", {
                    yPercent: 0,
                    y: -64,
                    opacity: 0,
                    scrollTrigger: {
                        trigger: "#section-219",
                        start: "start", // the default values
                        end: '7.5%',
                        scrub: true,
                        //markers: true
                    },
                });

                gsap.to("#second", {
                    yPercent: 0,
                    y: -64,
                    opacity: 0,
                    scrollTrigger: {
                        trigger: "#section-219",
                        start: "2.5%", // the default values
                        end: '10%',
                        scrub: true,
                        //  markers: true
                    },
                });

                gsap.to(".video-container", {
                    yPercent: 0,
                    rotationX: 0,
                    perspective: "900px",
                    scrollTrigger: {
                        trigger: "#section-219",
                        start: "10%", // the default values
                        end: '25%',
                        scrub: true,
                        // markers: true
                    },
                });

                gsap.to(".avatar-container", {
                    opacity: 1,
                    y: -8,
                    scrollTrigger: {
                        trigger: "#section-219",
                        start: "10%", // the default values
                        end: '25%',
                        scrub: true,
                        // markers: true
                    },
                });


                gsap.from('#top', {"duration": 0.35, "y": 24, "opacity": 0})
                gsap.from('#second', {"delay": 0.2, "duration": 0.35, "y": 24, "opacity": 0})
                gsap.from('#tablet-video-container', {"delay": 0.6, "duration": 0.5, "y": "3%", "opacity": 0})

            }
        }

        var mediaQuery = window.matchMedia("(max-width: 594px)")
        myFunction(mediaQuery) // Call listener function at run time
        mediaQuery.addListener(myFunction) // Attach listener function on state changes


        /*
                  gsap.to(".vjs-big-play-button", {
                      //rotationZ: 0,
                      //z: 100,
                      scaleX: 1.5,
                      scaleY: 1.5,
                      scrollTrigger: {
                       trigger: "#section-219",
                          start: "0%", // the default values
                          end: '96%',
                          scrub: true,
                          // markers: true
                      },
                  });
                  */


    </script>

@endsection

<style>
    @-webkit-keyframes hue {
        from {
            -webkit-filter: hue-rotate(0deg);
        }
        to {
            -webkit-filter: hue-rotate(65deg);
        }
    }

    .video-js:hover .vjs-control-bar, .video-js:hover .vjs-big-play-button, .video-js:hover .vjs-menu-button .vjs-menu-content {
        background-color: rgba(35, 37, 38, 0.7);
        background-color: rgba(35, 37, 38, 0.7);
    }

    video[poster]{
        object-fit: cover;
    }
    .vjs-poster {
        background-size: cover;
        background-position: inherit;
    }

    .video-js {
        /* The base font size controls the size of everything, not just text. All dimensions use em-based sizes so that the scale along with the font size. Try increasing it to 15px and see what happens. */
        font-size: 12px;
        /* The main font color changes the ICON COLORS as well as the text */
        color: #fff;
    }
    /* The "Big Play Button" is the play button that shows before the video plays. To center it set the align values to center and middle. The typical location of the button is the center, but there is trend towards moving it to a corner where it gets out of the way of valuable content in the poster image.*/
    .vjs-default-skin .vjs-big-play-button {
        /* The font size is what makes the big play button...big. All width/height values use ems, which are a multiple of the font size. If the .video-js font-size is 10px, then 3em equals 30px.*/
        font-size: 3em;
        /* We're using SCSS vars here because the values are used in multiple places. Now that font size is set, the following em values will be a multiple of the new font size. If the font-size is 3em (30px), then setting any of the following values to 3em would equal 30px. 3 * font-size. */
        /* 1.5em = 45px default */
        line-height: 2.5em;
        height: 2.5em;
        width: 2.5em;
        /* 0.06666em = 2px default */
        /*border: 0.06666em solid $primary-foreground-color;
        */
        /* 0.3em = 9px default */
        border-radius: 100%;
        /* Align center */
        left: 50%;
        top: 50%;
        margin-left: -1.5em;
        margin-top: -1.5em;
    }
    /* The default color of control backgrounds is mostly black but with a little bit of blue so it can still be seen on all-black video frames, which are common. */
    .video-js .vjs-control-bar, .video-js .vjs-menu-button .vjs-menu-content {
        /* IE8 - has no alpha support */
        background-color: #232526;
        /* Opacity: 1.0 = 100%, 0.0 = 0% */
        background-color: rgba(35, 37, 38, 0.7);
    }
    .video-js .vjs-big-play-button {
        height: 112px;
        width: 112px;
        background-color: rgba(35, 37, 38, 0.7);
        background-image: url('https://res.cloudinary.com/dyfkrtheb/image/upload/v1620914963/play_btn_s4bl02.svg');
        background-repeat: no-repeat;
        background-size: 32px;
        background-position: 53.5% calc(50%);
        border: none !important;
        box-shadow: none !important;
    }
    .video-js .vjs-big-play-button:before {
        content: "";
        display: none;
    }
    /* Slider - used for Volume bar and Progress bar */
    .video-js .vjs-slider {
        background-color: #747a7e;
        background-color: rgba(116, 122, 126, 0.5);
    }
    /* The slider bar color is used for the progress bar and the volume bar (the first two can be removed after a fix that's coming) */
    .video-js .vjs-volume-level, .video-js .vjs-play-progress, .video-js .vjs-slider-bar {
        background: #fff;
    }
    /* The main progress bar also has a bar that shows how much has been loaded. */
    .video-js .vjs-load-progress {
        /* For IE8 we'll lighten the color */
        background: #b5b9bb;
        /* Otherwise we'll rely on stacked opacities */
        background: rgba(116, 122, 126, 0.5);
    }
    /* The load progress bar also has internal divs that represent smaller disconnected loaded time ranges */
    .video-js .vjs-load-progress div {
        /* For IE8 we'll lighten the color */
        background: #f8f8f8;
        /* Otherwise we'll rely on stacked opacities */
        background: rgba(116, 122, 126, 0.75);
    }


    .vjs-big-play-button .vjs-icon-placeholder:before {
        content: "";
        display: none;
    }
</style>
