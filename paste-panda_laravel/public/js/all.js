// Listen for click on the document
document.addEventListener('click', function (event) {

    //Bail if our clicked element doesn't have the class
    if (!event.target.classList.contains('accordion-toggle')) return;

    // Get the target content
    var content = document.querySelector(event.target.hash);
    if (!content) return;

    // Prevent default link behavior
    event.preventDefault();

    // If the content is already expanded, collapse it and quit
    if (content.classList.contains('active')) {
        content.classList.remove('active');
        event.target.classList.remove('active');
        return;
    }

    // Get all open accordion content, loop through it, and close it
    // var accordions = document.querySelectorAll('.accordion-content.active');
    // for (var i = 0; i < accordions.length; i++) {
    //     accordions[i].classList.remove('active');
    // }

    // Toggle our content
    content.classList.toggle('active');
    event.target.classList.toggle('active');
})



const html = document.documentElement;
const canvas = document.getElementById("hero-lightpass");
const context = canvas.getContext("2d");

console.log(html);

const frameCount = 148;
const currentFrame = index => (
    `https://www.apple.com/105/media/us/airpods-pro/2019/1299e2f5_9206_4470_b28e_08307a42f19b/anim/sequence/large/01-hero-lightpass/${index.toString().padStart(4, '0')}.jpg`
)

const preloadImages = () => {
    for (let i = 1; i < frameCount; i++) {
        const img = new Image();
        img.src = currentFrame(i);
    }
};

const img = new Image()
img.src = currentFrame(5);
canvas.width=1158;
canvas.height=770;
img.onload=function(){
    context.drawImage(img, 0, 0);
}

const updateImage = index => {
    img.src = currentFrame(index);
    console.log("Updating...");
    context.drawImage(img, 0, 0);
    console.log(index);
}

window.addEventListener('scroll', () => {
    console.log("Add scroll");
    // const scrollTop = html.scrollTop;
    const scrollTop = document.scrollingElement.scrollTop;
    const maxScrollTop = html.scrollHeight - window.innerHeight;
    const scrollFraction = scrollTop / maxScrollTop;


    console.log("Scrollfraction: " + scrollFraction);

    const frameIndex = Math.min(
        frameCount - 1,
        Math.ceil(scrollFraction * frameCount)
    );

    requestAnimationFrame(() => updateImage(frameIndex + 1))
});

preloadImages();

//SLIDER

const items = document.querySelectorAll('img');
const itemCount = items.length;
const nextItem = document.querySelector('.next');
const previousItem = document.querySelector('.previous');
let count = 0;

function showNextItem() {
    items[count].classList.remove('active');

    if(count < itemCount - 1) {
        count++;
    } else {
        count = 0;
    }

    items[count].classList.add('active');
    console.log(count);
}

function showPreviousItem() {
    items[count].classList.remove('active');

    if(count > 0) {
        count--;
    } else {
        count = itemCount - 1;
    }

    items[count].classList.add('active');
    console.log(count);
}

function keyPress(e) {
    e = e || window.event;

    if (e.keyCode == '37') {
        showPreviousItem();
    } else if (e.keyCode == '39') {
        showNextItem();
    }
}

nextItem.addEventListener('click', showNextItem);
previousItem.addEventListener('click', showPreviousItem);
document.addEventListener('keydown', keyPress);
