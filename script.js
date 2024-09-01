
// Gallery move
const carousel=document.querySelector(".gallery-images"),
    firstImg=document.querySelectorAll("img")[0];


const arrowIcons=document.querySelectorAll(".arrow i");


let dragStart=false, prevPageX, prevScrollLeft;
let firstImgWidth= firstImg.clientWidth+270;
arrowIcons.forEach(icon=>{
    icon.addEventListener("click",()=>{
        carousel.scrollLeft+=icon.id=="left"?-firstImgWidth:firstImgWidth
    });
});

