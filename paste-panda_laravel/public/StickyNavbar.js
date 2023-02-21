gsap.to('header', {
    "duration": 0.15,
    "delay": 0,
    "css": {
        // "border-bottom": "1px solid #212121",
        "border-bottom": "1px solid red",
        'height': '80px',
        'background': 'inherit'
    },
    scrollTrigger: {
        trigger: "body",
        start: "top",
        toggleActions: "play pause resume reverse",
    },
});
