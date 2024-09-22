document.addEventListener('DOMContentLoaded', function() {
    // Explore More Button
    function scrollToAbout() {
      const aboutSection = document.getElementById('about');
      if (aboutSection) {
        aboutSection.scrollIntoView({ behavior: 'smooth' });
      } else {
        console.error("Element with id='about' not found.");
      }
    }
  
    // Gallery move
    const carousel = document.querySelector(".gallery-images"),
          firstImg = document.querySelectorAll("img")[0];
  
    if (firstImg) {
      const arrowIcons = document.querySelectorAll(".arrow i");
      let firstImgWidth = firstImg.clientWidth + 272;
      arrowIcons.forEach(icon => {
        icon.addEventListener("click", () => {
          carousel.scrollLeft += icon.id == "left" ? -firstImgWidth : firstImgWidth;
        });
      });
    } else {
      console.error("Gallery images not found.");
    }
  
    // left click
    const leftBtn = document.getElementById('left');
    if (leftBtn) {
      leftBtn.addEventListener('click', function() {
        window.location.href = 'index.php';
      });
    } else {
      console.error("Left button with id='left' not found.");
    }
  
    // return click
    const returnBtn = document.getElementById('return');
    if (returnBtn) {
      returnBtn.addEventListener('click', function() {
        window.location.href = 'index.php';
      });
    } else {
      console.error("Return button with id='return' not found.");
    }
  

  //   const signIn = document.getElementById("show-login");
  //   const signUp = document.getElementById("show-create");
  //   const wrapper = document.getElementById("wrapper");
  
  //   if (signIn && signUp && wrapper) {
  //     signIn.addEventListener('click', (event) => {
  //       event.preventDefault();  
  //       wrapper.classList.add("right-panel-activate");
  //     });
  
  //     signUp.addEventListener('click', (event) => {
  //       event.preventDefault();  
  //       wrapper.classList.remove("right-panel-activate");
  //     });
  //   } else {
  //     console.error("Sign-in, Sign-up, or wrapper elements not found.");
  //   }
  

  //   const exploreBtn = document.getElementById('explore');
  //   if (exploreBtn) {
  //     exploreBtn.addEventListener('click', function() {
  //       window.location.href = 'accounLogin.html';
  //     });
  //   } else {
  //     console.error("Explore button with id='explore' not found.");
  //   }
  });
  
