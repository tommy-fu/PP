<div id="section-258" class="scheme-2 py-48 py-64-landscape py-96-desktop scheme-1268">
    <div class="section px-32">
        <div class="container">
            <div class="column is-12 is-10-landscape is-offset-1-landscape is-offset-0-desktop mb-56 mb-72-landscape mb-88-desktop">
                <h1 class="h1 mb-24">
          <span style=
                "background-image: -webkit-linear-gradient(135deg, #904DC4 0%, #4384E6 33%, #4AD0FF 66%, #00FFBE 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; -webkit-animation: hue 2.75s infinite ease-in-out; -webkit-animation-direction: alternate;">
          Find a beautiful palette</span> for your project
                </h1>
                <p class="body-xl mb-32 mb-40-tablet">
                    Not quite sure what color’s right for your project? Scroll through our palette library and try different palettes until you find the perfect match.
                </p><a class="link_xl" style=
                "background-image: -webkit-linear-gradient(135deg, #904DC4 0%, #4384E6 33%, #4AD0FF 66%, #00FFBE 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; -webkit-animation: hue 2.75s infinite ease-in-out; -webkit-animation-direction: alternate;">Apply
                    for Beta access →</a>
            </div>
        </div>
    </div><img class="color-palette__img is-hidden is-inline-block-desktop" style="object-fit: cover; width: 100%; padding: 0;" src=
    "https://res.cloudinary.com/dyfkrtheb/image/upload/v1622138445/palette_library_img_a2j63m.png" /> <img class="color-palette__img is-hidden is-inline-block-landscape is-hidden-desktop" style=
    "object-fit: cover; width: 100%; padding: 0;" src="https://res.cloudinary.com/dyfkrtheb/image/upload/v1622138213/palette_library_img_tablet_ljii8i.png" /> <img class=
                                                                                                                                                                    "color-palette__img is-inline-block is-hidden-landscape" style="object-fit: cover; width: 100%; padding: 0;" src=
                                                                                                                                                                    "https://res.cloudinary.com/dyfkrtheb/image/upload/v1622138214/palette_library_img_mobile_h1gg3k.png" />
</div>


@section('scripts')
    @parent
    <!-- The rest of your scripts -->
    <script>
        gsap.from(".color-palette__img", {
            opacity: 0,
            y: 200,
            scrollTrigger: {
                trigger: "#section-258",
                start: "-48px", // the default values
                end: '400px',
                scrub: true,
                markers: true
            },
        });
    </script>

@endsection
