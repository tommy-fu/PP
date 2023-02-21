<section id="section-265" class="section pt-64 pt-96-tablet pt-124-desktop is-flex is-align-items-center scheme-1268">
    <div class="container">
        <div class="columns is-multiline">
            <div class="column is-12 is-10-landscape is-offset-1-landscape mb-88 mb-112-landscape mb-128-desktop has-text-centered">
                <h1 id="enter-hex__title" class="h1 mb-24">
          <span style=
                "background-image: -webkit-linear-gradient(135deg, #904DC4 0%, #4384E6 33%, #4AD0FF 66%, #00FFBE 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; -webkit-animation: hue 2.75s infinite ease-in-out; -webkit-animation-direction: alternate;">
          Just enter a hex and</span> let the magic happen
                </h1>
                <p id="enter-hex__description" class="body-xl mb-32 mb-40-tablet">
                    Get a color-matched and contrast-approved library of sections by inputting one single hex value.
                </p><a class="link_xl" style=
                "background-image: -webkit-linear-gradient(135deg, #904DC4 0%, #4384E6 33%, #4AD0FF 66%, #00FFBE 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; -webkit-animation: hue 2.75s infinite ease-in-out; -webkit-animation-direction: alternate;">Apply
                    for Beta access →</a>
            </div>
            <div class="column is-relative is-12 is-10-landscape is-offset-1-landscape is-8-tablet is-offset-2-tablet">
                <div class="blur-gradient"></div>
                <div class="input-container is-relative">
                    <div id="enter-hex-tooltip">
                        <span style="">Click me!</span>
                        <div id="enter-hex-tooltip-tip"></div>
                    </div>
                    <div id="enter-hex" class="input_lg">
                        <div class="is-flex is-align-items-center">
                            <div id="enter-hex__input-palette"></div>
                            <div id="placeholder-text" class="ml-16 ml-24-tablet">
                                Enter hex
                            </div>
                            <div class="ml-16 ml-24-tablet is-flex">
                                <span class="active-text">4</span> <span class="active-text">A</span> <span class="active-text">D</span> <span class="active-text">0</span> <span class="active-text">F</span>
                                <span class="active-text">F</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="is-flex is-justify-content-space-between">
                    <div id="palette-1" class="palette-item">
                        <div id="dark" class="palette-inner"></div>
                    </div>
                    <div id="palette-2" class="palette-item">
                        <div id="light" class="palette-inner"></div>
                    </div>
                    <div id="palette-3" class="palette-item">
                        <div id="pastel" class="palette-inner"></div>
                    </div>
                    <div id="palette-4" class="palette-item">
                        <div id="darktint" class="palette-inner"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    @-webkit-keyframes hue {
        from {
            -webkit-filter: hue-rotate(0deg);
        }
        to {
            -webkit-filter: hue-rotate(65deg);
        }
    }

    #enter-hex {
        background: rgba(255, 255, 255, 0.075);
        border: 2px solid transparent;
        padding-left: 24px;
        cursor: pointer;
    }

    @media only screen and (max-width: 596px) {
        #enter-hex {
            padding-left: 20px;
        }
    }

    #enter-hex:hover {
        background: rgba(255, 255, 255, 0.025) !important;
        border: 2px solid rgba(255, 255, 255, 0.1) !important;
    }

    #enter-hex__input-palette {
        height: 24px;
        width: 24px;
        background: #fff;
        border: none;
        border-radius: 4px;
    }

    @media only screen and (max-width: 596px) {
        #enter-hex__input-palette {
            width: 20px;
            height: 20px;
        }
    }

    #enter-hex-tooltip {
        background-color: #434A4D;
        border-radius: 8px;
        box-sizing: border-box;
        margin-bottom: 0;
        margin-left: 24px;
        opacity: 1;
        padding: 8px 16px;
        transform: translate3d(0, -64px, 0) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(-8deg) skew(0deg, 0deg);
        transform-style: preserve-3d;
        color: #C1C7C9;
        font-family: Inter;
        font-size: 16px;
        line-height: 22px;
        position: absolute;
        text-align: center;
        z-index: 5;
    }

    @media only screen and (max-width: 596px) {
        #enter-hex-tooltip {
            transform: translate3d(0, -48px, 0) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(-8deg) skew(0deg, 0deg);
            padding: 4px 10px;
            font-size: 14px;
            line-height: 20px;
            margin-left: 16px;
            border-radius: 6px;
        }
    }

    #enter-hex-tooltip-tip {
        position: absolute;
        left: 14px;
        top: 25px;
        width: 20px;
        height: 16px;
        border-radius: 3px;
        background-color: #434A4D;
        transform: rotate(54deg);
        z-index: -1;
    }

    @media only screen and (max-width: 596px) {
        #enter-hex-tooltip-tip {
            top: 15px;
        }
    }

    .active-text {
        opacity: 0;
    }

    #placeholder-text {
        color: rgba(255, 255, 255, 0.3);
    }

    .blur-gradient {
        background-image: linear-gradient(to right, #904DC4 0%, #4384E6 33%, #4AD0FF 66%, #00FFBE 100%);
        opacity: 0.3;
        -webkit-filter: blur(35px);
        filter: blur(35px);
        position: absolute;
        width: 100%;
        height: 124px;
        border-radius: 100px;
        z-index: 0;
        top: -10%;
    }

    @media only screen and (max-width: 596px) {
        .blur-gradient {
            top: -5%;
            height: 64px;
        }
    }


    .palette-item {
        border-radius: 24px;
        width: 128px;
        height: 128px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        opacity: 0;
    }

    @media only screen and (max-width: 768px) {
        .palette-item {
            border-radius: 20px;
            width: 88px;
            height: 88px;
        }
    }

    @media only screen and (max-width: 400px) {
        .palette-item {
            border-radius: 16px;
            width: 64px;
            height: 64px;
        }
    }

    .palette-inner {
        border-radius: 12px;
        width: 80px;
        height: 80px;
        display: inline-block;
    }

    @media only screen and (max-width: 768px) {
        .palette-inner {
            border-radius: 12px;
            width: 56px;
            height: 56px;
        }
    }

    @media only screen and (max-width: 400px) {
        .palette-inner {
            border-radius: 8px;
            width: 40px;
            height: 40px;
        }
    }

    #dark {
        /*border: 2px solid rgba(229, 248, 255, 0.1);*/
        background: #131313;
    }

    #light {
        /*border: 2px solid rgba(75, 80, 82, 0.1);*/
        background: #fff;
    }

    #pastel {
        /*border: 2px solid rgba(75, 80, 82, 0.1);*/
        background: #edfaff;
    }

    #darktint {
        /*border: 2px solid rgba(229, 248, 255, 0.1);*/
        background: #252a2b;
    }

    #palette-1 {
        border: 2px solid rgba(229, 248, 255, 0.1);

    }

    #palette-2 {
        background: transparent;
        border: 2px solid rgba(229, 248, 255, 0.1);
    }

    #palette-3 {
        border: 2px solid rgba(229, 248, 255, 0.1);
        background: transparent;
    }

    #palette-4 {
        border: 2px solid rgba(229, 248, 255, 0.1);
        background: transparent;
    }
</style>

@section('scripts')
    @parent

    <script>
        var animationRunning = false;


        document.getElementById('enter-hex').addEventListener('click', function () {

            if (!animationRunning) {

                animationRunning = true;

                gsap.to('#enter-hex', {"duration": 0.05, "delay": 0, "css": {"border": "2px solid #4DD3FA"}})
                gsap.to('#enter-hex', {"duration": 0.2, "delay": 2.75, "css": {"y": -16, "opacity": 0}})
                gsap.to('#enter-hex', {"duration": 0.05, "delay": 6.85, "css": {"border": "2px solid transparent"}})
                gsap.to('#enter-hex', {"duration": 0.2, "delay": 7.5, "css": {"y": 0, "opacity": 1}})

                gsap.to('.active-text', {
                    "duration": 0.2, "delay": 0.95, stagger: 0.2, css: {
                        "opacity": 1
                    }
                })

                gsap.to('.active-text', {
                    "duration": 0.2, "delay": 6.85, css: {
                        "opacity": 0
                    }
                })

                gsap.to('#placeholder-text', {"duration": 0.1, "delay": 0.8, "css": {"opacity": 0, "display": "none"}})
                gsap.to('#placeholder-text', {"duration": 0.1, "delay": 6.85, "css": {"opacity": 1, "display": "block"}})

                gsap.to('#enter-hex__input-palette', {"duration": 0.25, "delay": 2.25, "css": {"background": "#4DD3FA"}})
                gsap.to('#enter-hex__input-palette', {"duration": 0.25, "delay": 6.85, "css": {"background": "#fff"}})


                gsap.to('#enter-hex-tooltip', {
                    "duration": 0.25,
                    "delay": 0.55,
                    "css": {"rotationX": 0, "rotationY": 0, "rotationZ": 16, "y": -40, "opacity": 0},
                    "ease": "back"
                })

                gsap.to('#enter-hex-tooltip', {
                    "duration": 0.25,
                    "delay": 7.7,
                    "css": {"opacity": 1, "y": "-165%", "rotationX": 0, "rotationY": 0, "rotationZ": -8}
                })


                gsap.to('#palette-1', {"duration": 0.5, "delay": 2.25, "css": {"border": "2px solid rgba(74, 208, 255, 1)"}})
                gsap.to('#palette-1', {
                    "duration": 0.3,
                    "delay": 2.85,
                    "css": {"opacity": 1, "y": -96, "rotationZ": -8},
                    "ease": "back"
                })
                gsap.to('#palette-1', {
                    "duration": 0.1,
                    "delay": 3.45,
                    "css": {"border": "2px solid rgba(9, 10, 10, 0.1)", "rotationZ": 0}
                })
                gsap.to('#palette-1', {"duration": 0.1, "delay": 5.65, "css": {"border": "2px solid rgba(229, 248, 255, 0.1)"}})
                gsap.to('#palette-1', {
                    "duration": 0.2,
                    "delay": 6.75,
                    "css": {"border": "2px solid rgba(74, 208, 255, 1)", "rotationZ": -8}
                })
                gsap.to('#palette-1', {"duration": 0.3, "delay": 7.3, "css": {"rotationZ": 0, "y": 0, "opacity": 0}})

                gsap.to('#palette-2', {"duration": 0.3, "delay": 2.95, "css": {"opacity": 1, "y": -96}, "ease": "back"})
                gsap.to('#palette-2', {
                    "duration": 0.2,
                    "delay": 3.45,
                    "css": {"border": "2px solid rgba(74, 208, 255, 1)", "rotationZ": -8}
                })
                gsap.to('#palette-2', {
                    "duration": 0.1,
                    "delay": 4.55,
                    "css": {"border": "2px solid rgba(9, 10, 10, 0.1)", "rotationZ": 0}
                })
                gsap.to('#palette-2', {"duration": 0.1, "delay": 5.65, "css": {"border": "2px solid rgba(229, 248, 255, 0.1)"}})
                gsap.to('#palette-2', {"duration": 0.3, "delay": 7.2, "css": {"y": 0, "opacity": 0}, "ease": "back"})

                gsap.to('#palette-3', {"duration": 0.3, "delay": 3.05, "css": {"opacity": 1, "y": -96}, "ease": "back"})
                gsap.to('#palette-3', {"duration": 0.1, "delay": 3.45, "css": {"border": "2px solid rgba(9, 10, 10, 0.1)"}})
                gsap.to('#palette-3', {
                    "duration": 0.2,
                    "delay": 4.55,
                    "css": {"border": "2px solid rgba(74, 208, 255, 1)", "rotationZ": -8}
                })
                gsap.to('#palette-3', {
                    "duration": 0.1,
                    "delay": 5.65,
                    "css": {"border": "2px solid rgba(229, 248, 255, 0.1)", "rotationZ": 0}
                })
                gsap.to('#palette-3', {"duration": 0.3, "delay": 7.1, "css": {"y": 0, "opacity": 0}, "ease": "back"})

                gsap.to('#palette-4', {"duration": 0.3, "delay": 3.15, "css": {"opacity": 1, "y": -96}, "ease": "back"})
                gsap.to('#palette-4', {"duration": 0.1, "delay": 3.45, "css": {"border": "2px solid rgba(9, 10, 10, 0.1)"}})
                gsap.to('#palette-4', {
                    "duration": 0.2,
                    "delay": 5.65,
                    "css": {"border": "2px solid rgba(74, 208, 255, 1)", "rotationZ": -8}
                })
                gsap.to('#palette-4', {
                    "duration": 0.1,
                    "delay": 6.75,
                    "css": {"border": "2px solid rgba(229, 248, 255, 0.1)", "rotationZ": 0}
                })
                gsap.to('#palette-4', {"duration": 0.3, "delay": 7, "css": {"y": 0, "opacity": 0}, "ease": "back"})

                gsap.to('#section-265', {"duration": 0.1, "delay": 3.45, "css": {"background": "rgba(255,255, 255)"}})
                gsap.to('#section-265', {"duration": 0.1, "delay": 4.55, "css": {"background": "rgba(237,250, 255)"}})
                gsap.to('#section-265', {"duration": 0.1, "delay": 5.65, "css": {"background": "rgba(37,42, 43)"}})
                gsap.to('#section-265', {"duration": 0.1, "delay": 6.75, "css": {"background": "rgba(19,19, 19)"}})


                /*gsap.to('#enter-hex__input-palette', {
                    "duration": 0.1,
                    "delay": 3.45,
                    "css": {"border": "2px solid rgba(9, 10, 10, 0.1)"}
                })
                gsap.to('#enter-hex__input-palette', {
                    "duration": 0.1,
                    "delay": 5.65,
                    "css": {"border": "2px solid rgba(229, 248, 255, 0.1)"}
                })*/

                gsap.to('#enter-hex__description', {"duration": 0.1, "delay": 3.45, "css": {"color": "rgba(17,18, 19)"}})
                gsap.to('#enter-hex__description', {"duration": 0.1, "delay": 5.65, "css": {"color": "rgba(255,255, 255)"}})

                gsap.to('#enter-hex__title', {"duration": 0.1, "delay": 3.45, "css": {"color": "rgba(17,18, 19)"}})
                gsap.to('#enter-hex__title', {"duration": 0.1, "delay": 5.65, "css": {"color": "rgba(255,255, 255)"}})


                setTimeout(function () {
                    animationRunning = false;
                }, 8000)

            }

        });


    </script>
@endsection
