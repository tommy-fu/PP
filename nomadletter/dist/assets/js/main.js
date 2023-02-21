function openMenu() {
    gsap.to('#slider', {
        "duration": 0.15,
        "delay": 0,
        "css": {
            'right': '0'
        }
    });

    document.body.classList.toggle('disable-scroll');
}

function closeMenu() {
    gsap.to('#slider', {
        "duration": 0.15,
        "delay": 0,
        "css": {
            'right': '-800px'
        }
    });

    document.body.classList.toggle('disable-scroll');
}

(function () {

    "use strict";

    const logo = document.getElementById('logo');
    const slider = document.getElementById('slider-icon-container');
    const hamburger = document.getElementById('hamburger');
    const header = document.getElementById('header');

    var tl = gsap.timeline(
        {
            scrollTrigger: {
                trigger: "body",
                start: "top",
                end: "+=1px",
                scrub: 0.3,
                invalidateOnRefresh: true,
                onEnter: self => {
                    logo.src = '/assets/images/nomadletter-black.svg';
                    hamburger.src = '/assets/images/hamburger-dark.svg';
                    slider.style.marginTop = '-16px';
                    header.classList.remove("overlay");
                    header.classList.add("header");
                },
                onLeaveBack: self => {
                    logo.src = '/assets/images/nomadletter-white.svg';
                    hamburger.src = '/assets/images/hamburger.svg';
                    slider.style.marginTop = '0';
                    header.classList.remove("header");
                    header.classList.add("overlay");
                },
            }
        }
    );

    tl.fromTo('header', {
            "css": {
                "border-bottom": "0",
                'background': 'transparent',
                'height': '110px',
            }
        },
        {
            "css": {
                "border-bottom": "1px solid #EDEBEC",
                'background': '#FFFFFF',
                'height': '80px',
            },
        });
}());

(function () {

    "use strict";


    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("is-active");
        });
    }
}());
