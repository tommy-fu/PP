gsap.to('header', {
    "duration": 0.15,
    "delay": 0,
    "css": {
        // "border-bottom": "1px solid #212121",
        "border-bottom": "1px solid {{$scheme['divider']}}",
        'height': '80px',
        'background': '{{$scheme['background']}}'
    },
    scrollTrigger: {
        trigger: "body",
        start: "top",
        toggleActions: "play pause resume reverse",
    },
});
