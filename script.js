
// Explore More Button

function scrollToAbout() {
    document.getElementById('about').scrollIntoView({ behavior: 'smooth' });
  }
// Gallery move
const carousel=document.querySelector(".gallery-images"),
    firstImg=document.querySelectorAll("img")[0];


const arrowIcons=document.querySelectorAll(".arrow i");


let dragStart=false, prevPageX, prevScrollLeft;
let firstImgWidth= firstImg.clientWidth+272;
arrowIcons.forEach(icon=>{
    icon.addEventListener("click",()=>{
        carousel.scrollLeft+=icon.id=="left"?-firstImgWidth:firstImgWidth
    });
});

const signIn = document.getElementById("show-login");
const signUp = document.getElementById("show-create");
const wrapper = document.getElementById("wrapper");

signIn.addEventListener('click', (event) => {
    event.preventDefault();  
    wrapper.classList.add("right-panel-activate");  
});

signUp.addEventListener('click', (event) => {
    event.preventDefault();  
    wrapper.classList.remove("right-panel-activate");  
});