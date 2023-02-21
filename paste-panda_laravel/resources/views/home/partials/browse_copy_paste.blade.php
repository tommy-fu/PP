<div id="section-222" class="section py-48 py-64-landscape py-96-desktop scheme-1268">
    <div class="container">
        <div class="columns is-flex is-flex-direction-column is-multiline">
            <div class="column is-12 mb-32 mb-40-landscape mb-48-desktop has-text-centered">
                <h4 class="caption-lg mb-16 mb-24-tablet mb-32-desktop has-text-base">
                    A new way of working.
                </h4>
                <h2 class="h1 mb-0">
                    <span id="browse__browse" class="toggle-btn is-active mx-4 mb-16" swiper-index="0">Browse</span>
                    <span id="browse__copy" class="toggle-btn mx-4" swiper-index="1">Copy</span> <span id=
                                                                                                       "browse__paste"
                                                                                                       class="toggle-btn mx-4"
                                                                                                       swiper-index="2">Paste</span>
                </h2>
            </div>
            <div class="column is-12 mb-40 mb-48-landscape mb-64-desktop">
                <div class="swiper-container has-border-radius-xl has-max-height-350 has-max-height-400-tablet has-max-height-450-desktop">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" style=
                        "background: -webkit-linear-gradient(135deg, #904DC4 0%, #4384E6 33%, #4AD0FF 66%, #00FFBE 100%); -webkit-animation: hue 2.75s infinite ease-in-out; -webkit-animation-direction: alternate;">
                            <img class="swiper-img is-hidden is-block-tablet"
                                 src="https://res.cloudinary.com/dyfkrtheb/image/upload/v1622124173/browse_bkhd0n.png"/>
                            <img class=
                                 "swiper-img is-block is-hidden-tablet"
                                 src="https://res.cloudinary.com/dyfkrtheb/image/upload/v1622126945/browse_mobile_dpefoi.png"/>
                        </div>
                        <div class="swiper-slide" style=
                        "background: -webkit-linear-gradient(135deg, #904DC4 0%, #4384E6 33%, #4AD0FF 66%, #00FFBE 100%); -webkit-animation: hue 2.75s infinite ease-in-out; -webkit-animation-direction: alternate;">
                            <img class="swiper-img is-hidden is-block-tablet"
                                 src="https://res.cloudinary.com/dyfkrtheb/image/upload/v1622124173/copy_zglhdb.png"/>
                            <img class=
                                 "swiper-img is-block is-hidden-tablet"
                                 src="https://res.cloudinary.com/dyfkrtheb/image/upload/v1622126945/copy_mobile_j0edab.png"/>
                        </div>
                        <div class="swiper-slide" style=
                        "background: -webkit-linear-gradient(135deg, #904DC4 0%, #4384E6 33%, #4AD0FF 66%, #00FFBE 100%); -webkit-animation: hue 2.75s infinite ease-in-out; -webkit-animation-direction: alternate;">
                            <img class="swiper-img is-hidden is-block-tablet"
                                 src="https://res.cloudinary.com/dyfkrtheb/image/upload/v1622124173/paste_fer1rm.png"/>
                            <img class=
                                 "swiper-img is-block is-hidden-tablet"
                                 src="https://res.cloudinary.com/dyfkrtheb/image/upload/v1622126946/paste_mobile_hjnpdx.png"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-12 is-10-tablet is-offset-1-tablet is-8-desktop is-offset-2-desktop has-text-centered">
                <p class="body-xl mb-32 mb-40-tablet">
                    Browse Pastepanda’s library of 80+ dynamic sections, copy the ones you like and paste them into your
                    editor.
                </p><a class="link_xl" style=
                "background-image: -webkit-linear-gradient(135deg, #904DC4 0%, #4384E6 33%, #4AD0FF 66%, #00FFBE 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; -webkit-animation: hue 2.75s infinite ease-in-out; -webkit-animation-direction: alternate;">Apply
                    for Beta access →</a>
            </div>
        </div>
    </div>
</div>


<style>
    #browse__paste {
        margin-bottom: 0px !important;
    }

    .toggle-btn.is-active {
        border-color: #4AD0FF;
        /*transform: translate3d(0px, 0px, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(6deg) skew(0deg, 0deg);*/
        /*transform-style: preserve-3d;*/
        color: transparent;
        font-weight: 700;
        background-image: -webkit-linear-gradient(135deg, #904DC4 0%, #4384E6 33%, #4AD0FF 66%, #00FFBE 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        -webkit-animation: hue 2.75s infinite ease-in-out;
        -webkit-animation-direction: alternate;
    }

    .swiper-img {
        width: 100%;
        object-fit: cover;
    }

    .toggle-btn {
        display: inline-block;
        border-color: #333;
        border-width: 3px;
        border-style: solid;
        transform-style: preserve-3d;
        color: #565F62;
        /*transition: 0.5s;*/
        cursor: pointer;
        /*height: 100px;*/
        /*line-height: 140px;*/
        -webkit-touch-callout: none; /* iOS Safari */
        -webkit-user-select: none; /* Safari */
        -khtml-user-select: none; /* Konqueror HTML */
        -moz-user-select: none; /* Old versions of Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
        user-select: none; /* Non-prefixed version, currently */
        border-radius: 16px;
        /*font-weight: 700;*/
        /*font-size: 34px;*/
        padding: 10px 20px;
    }

    @media screen and (min-width: 768px) {
        .toggle-btn {
            /*font-size: 64px;*/
            margin-bottom: 32px;
            border-radius: 24px;
            padding: 16px 24px;
        }
    }

    @media screen and (min-width: 992px) {
        .toggle-btn {
            padding: 20px 32px;
            border-radius: 32px;
            border-width: 4px;
        }
    }

    @-webkit-keyframes hue {
        from {
            -webkit-filter: hue-rotate(0deg);
        }
        to {
            -webkit-filter: hue-rotate(65deg);
        }
    }
</style>


@section('scripts')
    @parent
    <!-- The rest of your scripts -->
    <script>
        const swiper = new Swiper('.swiper-container', {
            "autoplay": {"delay": 3500},
            "speed": 500,
            "autoplayDisableOnInteraction": true,
            "autoHeight": false,
            "effect": "fade"
        });

        swiper.on('slideChange', function (el) {

            Array.from(toggleButtons).forEach(function (btn) {
                btn.classList.remove('is-active');
                gsap.to('#' + btn.id, {
                    rotationZ: 0,
                });
            });

            toggleButtons[el.activeIndex].classList.toggle('is-active');

            gsap.to('#' + toggleButtons[el.activeIndex].id, {
                rotationZ: 4,
                // opacity: 0
            });

        });

        var toggleButtons = document.getElementsByClassName('toggle-btn');

        Array.from(toggleButtons).forEach(function (btn) {
            btn.addEventListener('click', function (el) {
                swiper.slideTo(el.target.getAttribute('swiper-index'));
            })

        });

        gsap.to('#browse__browse', {
            rotationZ: 4,
            duration: 0,
        });

    </script>

@endsection
