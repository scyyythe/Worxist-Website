
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


document.getElementById("show-login").addEventListener("click", function(event) {
    event.preventDefault(); // Prevents default anchor behavior
    
    // Show the login container
    document.getElementById("login-container").style.right = "0";

    // Hide the form container
    document.getElementById("form-container").style.display = "none"; // Hides the form-container

    document.getElementById("greek-god").style.right="0";
});