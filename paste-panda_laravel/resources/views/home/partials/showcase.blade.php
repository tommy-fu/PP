<div id="section-205" class="section is-relative py-48 py-64-landscape py-96-desktop scheme-1268">
    <div class="container">
        <div class="column is-12 is-10-tablet is-offset-1-tablet mb-40 mb-48-landscape mb-64-desktop has-text-centered">
            <h1 class="h1 mb-0">
                Built with <span style=
                                 "background-image: -webkit-linear-gradient(135deg, #904DC4 0%, #4384E6 33%, #4AD0FF 66%, #00FFBE 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; -webkit-animation: hue 2.75s infinite ease-in-out; -webkit-animation-direction: alternate;">
        Kitspring</span>
            </h1>
        </div>
        <div class="columns is-multiline">
            <div class="showcase-column column is-12 is-6-tablet mb-40 mb-48-desktop">
                <div class="card showcase-card mb-24">
                    <div class="pt-32 px-32 pt-48-desktop px-48-desktop has-height-250 has-height-350-landscape has-height-250-tablet has-height-350-desktop">
                        <div class="showcase-image-wrapper">
                            <img class="showcase-image" src="https://res.cloudinary.com/dyfkrtheb/image/upload/v1622099659/kitspring_eswi03.png" />
                        </div>
                    </div>
                </div>
                <div class="is-relative is-flex is-flex-direction-row is-justify-content-center is-align-items-center">
                    <p class="body-lg has-text-base mb-0">
                        Kitspring
                    </p><a class="showcase_visit-link link_lg is-absolute mb-0">Preview →</a>
                </div>
            </div>
            <div class="showcase-column column is-12 is-6-tablet mb-40 mb-48-desktop">
                <div class="card showcase-card mb-24">
                    <div class="pt-32 px-32 pt-48-desktop px-48-desktop has-height-250 has-height-350-landscape has-height-250-tablet has-height-350-desktop">
                        <div class="showcase-image-wrapper">
                            <img class="showcase-image" src="https://res.cloudinary.com/dyfkrtheb/image/upload/v1622099660/billaby_hkrg1i.png" />
                        </div>
                    </div>
                </div>
                <div class="is-relative px-0 px-24-landscape is-flex is-flex-direction-row is-justify-content-center is-align-items-center">
                    <p class="body-lg has-text-base mb-0">
                        Billaby
                    </p><a class="showcase_visit-link link_lg is-absolute mb-0">Preview →</a>
                </div>
            </div>
            <div class="showcase-column column is-12 is-6-tablet mb-40 mb-48-desktop">
                <div class="card showcase-card mb-24">
                    <div class="pt-32 px-32 pt-48-desktop px-48-desktop has-height-250 has-height-350-landscape has-height-250-tablet has-height-350-desktop">
                        <div class="showcase-image-wrapper">
                            <img class="showcase-image" src="https://res.cloudinary.com/dyfkrtheb/image/upload/v1622099660/nomadletter_gzaqju.png" />
                        </div>
                    </div>
                </div>
                <div class="is-relative px-0 px-24-landscape is-flex is-flex-direction-row is-justify-content-center is-align-items-center">
                    <p class="body-lg has-text-base mb-0">
                        Nomadletter
                    </p><a class="showcase_visit-link link_lg is-absolute mb-0">Preview →</a>
                </div>
            </div>
            <div class="showcase-column column is-12 is-6-tablet mb-40 mb-48-desktop">
                <div class="card showcase-card mb-24">
                    <div class="pt-32 px-32 pt-48-desktop px-48-desktop has-height-250 has-height-350-landscape has-height-250-tablet has-height-350-desktop">
                        <div class="showcase-image-wrapper">
                            <img class="showcase-image" src="https://res.cloudinary.com/dyfkrtheb/image/upload/v1622099659/zerobit_wwuvgv.png" />
                        </div>
                    </div>
                </div>
                <div class="is-relative px-0 px-24-landscape is-flex is-flex-direction-row is-justify-content-center is-align-items-center">
                    <p class="body-lg has-text-base mb-0">
                        Zerobit
                    </p><a class="showcase_visit-link link_lg is-absolute mb-0">Preview →</a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <!-- The rest of your scripts -->
    <script src="/js/simple-scrollspy.min.js"></script>
    <script>
        // gsap.to('.card-item', {"duration":0.25,"delay":0.5,"css":{"opacity":0.5}})
        //
        // gsap.to('.img-wrapper', {"duration":0.25,"delay":0.5,"css":{"scaleX":1.1,"scaleY":1.1}})
        //
        // gsap.to('606ffb2081184150eac99315|b4093a4e-e4ac-fed6-6acc-88fd5b98b1bc', {"duration":0.25,"delay":0.5,"css":{"background":"rgba(74,208, 255)"}})
        //
        // gsap.to('.body-md.has-text-white', {"duration":0.25,"delay":0.5,"css":{"opacity":0,"y":-12}})
        //
        // gsap.to('.link-md.has-text-primary', {"duration":0.25,"delay":0.5,"css":{"opacity":1,"y":0}})


        function myFunction(mediaQuery) {
            if (mediaQuery.matches) { // If media query matches

                // Less or equal = Do nothing

            } else {

                // Greater than = Execute below code

                const cards = document.querySelectorAll(".card");

                cards.forEach(function(card){

                    // gsap.to(card, {"duration":0,"delay":0,"css":{"background": "#131313"}})

                    card.closest('.card').addEventListener('mouseenter', function(e){
                        var column = card.closest('.showcase-column');

                        gsap.to(column.querySelector('.body-lg'), {"duration":0.15,"delay":0,"css":{"opacity":0}})
                        gsap.to(column.querySelector('.body-lg'), {"duration":0.25,"delay":0,"css":{"y":-12}})
                        /*gsap.to(column.querySelector('.card'), {"duration":0.25,"delay":0,"css":{"background-image":"-webkit-linear-gradient(to right, #904DC4, #4384E6, #4AD0FF, #00FFBE) !important;"}})*/
                        gsap.to(column.querySelector('.showcase_visit-link'), {"duration":0,"delay":0,"css":{"display":"block"}})
                        gsap.to(column.querySelector('.showcase_visit-link'), {"duration":0.15,"delay":0,"css":{"opacity":1}})
                        gsap.to(column.querySelector('.showcase_visit-link'), {"duration":0.25,"delay":0,"css":{"y":0}})
                        gsap.to(column.querySelector('.showcase-image-wrapper'), {"duration":0.25,"delay":0,"css":{"scaleX":1.05,"scaleY":1.05}})
                    });

                    //
                    card.closest('.card').addEventListener('mouseleave', function(e){
                        var column = e.currentTarget.closest('.showcase-column');

                        gsap.to(column.querySelector('.body-lg'), {"duration":0.15,"delay":0,"css":{"opacity":1}})
                        gsap.to(column.querySelector('.body-lg'), {"duration":0.25,"delay":0,"css":{"y":0}})
                        /*gsap.to(column.querySelector('.card'), {"duration":0.25,"delay":0,"css":{"background-image":"-webkit-linear-gradient(#202020) !important;"}})*/
                        gsap.to(column.querySelector('.showcase_visit-link'), {"duration":0,"delay":0,"css":{"display":"none"}})
                        gsap.to(column.querySelector('.showcase_visit-link'), {"duration":0.15,"delay":0,"css":{"opacity":0}})
                        gsap.to(column.querySelector('.showcase_visit-link'), {"duration":0.25,"delay":0,"css":{"y":-12}})
                        gsap.to(column.querySelector('.showcase-image-wrapper'), {"duration":0.25,"delay":0,"css":{"scaleX":1,"scaleY":1}})
                    });
                })

            }
        }

        var mediaQuery = window.matchMedia("(max-width: 768px)")
        myFunction(mediaQuery) // Call listener function at run time
        mediaQuery.addListener(myFunction) // Attach listener function on state changes



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

    .card {
        cursor: pointer;
    }

    .showcase-card {
        transition: 0.15s ease-in-out;
    }

    .showcase-card:hover {
        background: -webkit-linear-gradient(135deg, #904DC4 0%, #4384E6 33%, #4AD0FF 66%, #00FFBE 100%);
        -webkit-animation: hue 2.75s infinite ease-in-out;
        -webkit-animation-direction: alternate;
        box-shadow: 0px 0px 150px rgba(74, 208, 255, 0.3);
    }

    .showcase_visit-link {
        background-image: -webkit-linear-gradient(135deg, #904DC4 0%, #4384E6 33%, #4AD0FF 66%, #00FFBE 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        -webkit-animation: hue 2.75s infinite ease-in-out;
        -webkit-animation-direction: alternate;
        opacity: 0;
        transform: translateY(-12px);
    }

    .showcase-image-wrapper {
        overflow: hidden;
        height: 500px;
        border-radius: 6px;
        filter: drop-shadow(0px 0px 17px rgba(0, 0, 0, 0.4));
    }

    .showcase-image {
        height: 500px;
        min-width: 100%;
        vertical-align: middle;
        display: inline-block;
        object-fit: cover;
        object-position: top;
    }
</style>
