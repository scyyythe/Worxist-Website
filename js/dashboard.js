function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  sidebar.classList.toggle('open');
}



//sidebar active

const sidebarItems = document.querySelectorAll('.sidebar li');


sidebarItems.forEach(item => {
    item.addEventListener('click', function() {
       
        sidebarItems.forEach(el => el.classList.remove('active'));
        
        this.classList.add('active');
    });
});

//notification
function toggleNotifications() {
  var notificationCenter = document.getElementById("notificationCenter");
  notificationCenter.classList.toggle("active");
}


// tabpane in Artwork Dashboard
function myOption(evt, option) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(option).style.display = "block";
  evt.currentTarget.className += " active";
}
document.addEventListener("DOMContentLoaded", function() {
  var firstTab = document.querySelector('.tablinks');
  firstTab.click(); 
});
// dropdown filter
function toggleDropdown() {
  var dropdown = document.getElementById("dropdown");
  if (dropdown.style.display === "block") {
      dropdown.style.display = "none";
  } else {
      dropdown.style.display = "block";
  }
}
// FOLLOWERS AND FOLLOWING
const modal = document.getElementById("followers-modal");
const followersContent = document.getElementById("followers-content");
const followingContent = document.getElementById("following-content");


const viewFollowersButton = document.getElementById("openFollowers");
const viewFollowingButton = document.getElementById("openFollowing");

const closeButton = document.getElementsByClassName("close-button")[0];

viewFollowersButton.addEventListener("click", function(event) {
    event.preventDefault(); 
    followersContent.style.display = "block";
    followingContent.style.display = "none";
    modal.style.display = "block";
});


// following modal
viewFollowingButton.addEventListener("click", function(event) {
    event.preventDefault(); 
    followersContent.style.display = "none";
    followingContent.style.display = "block";
    modal.style.display = "block";
});

closeButton.addEventListener("click", function() {
    modal.style.display = "none"; 
});

window.addEventListener("click", function(event) {
    if (event.target === modal) {
        modal.style.display = "none"; 
    }
});





// e link mga side bar
document.addEventListener('DOMContentLoaded', function() {

  // sidebar links
  const dashboardLink = document.querySelector('.dashboard');
  const artworkLink = document.querySelector('.my-artworks');
  const messageLink=document.querySelector('.messages');
  const exhibitLink=document.querySelector('.exhibit');
  const settingLink=document.querySelector('.settings');

  //exhibit
  const reqContainer=document.getElementById('reqExhibit-con');
  
  // containers
  const dashboardContainer = document.getElementById('dashboardContainer');
  const artworkContainer = document.getElementById('artworkContainer');
  const messageContainer = document.getElementById('messageContainer');
  const exhibitContainer = document.getElementById('exhibitContainer');
  const settingContainer = document.getElementById('settingsContainer');

  //  show only the dashboard and hide others
  artworkContainer.style.display = 'none';
  messageContainer.style.display = 'none';
  exhibitContainer.style.display = 'none';
  settingContainer.style.display = 'none';
  reqContainer.style.display='none';



  // Dashboard
  dashboardLink.addEventListener('click', function(e) {
      e.preventDefault(); 
      dashboardContainer.style.display = 'block';
      artworkContainer.style.display = 'none';
      messageContainer.style.display = 'none';
      exhibitContainer.style.display = 'none';
      settingContainer.style.display = 'none';
      reqContainer.style.display='none';


  });

  //my-artworks Management
  artworkLink.addEventListener('click', function(e) {
      e.preventDefault();
      dashboardContainer.style.display = 'none';
      artworkContainer.style.display = 'block';
      messageContainer.style.display = 'none';
      exhibitContainer.style.display = 'none';
      settingContainer.style.display = 'none';
      reqContainer.style.display='none';


  });

  // messages section
messageLink.addEventListener('click', function(e) {
    e.preventDefault();
    dashboardContainer.style.display = 'none';
    artworkContainer.style.display = 'none';
    messageContainer.style.display = 'block';
    exhibitContainer.style.display = 'none';
    settingContainer.style.display = 'none';
    reqContainer.style.display='none';


});



// exhibit container
exhibitLink.addEventListener('click', function(e) {
  e.preventDefault();
  dashboardContainer.style.display = 'none';
      artworkContainer.style.display = 'none';
      messageContainer.style.display = 'none'
      exhibitContainer.style.display = 'block';
      settingContainer.style.display = 'none';
      reqContainer.style.display='none';


});


// settings
settingLink.addEventListener('click', function(e) {
  e.preventDefault();
  dashboardContainer.style.display = 'none';
  artworkContainer.style.display = 'none';
  messageContainer.style.display = 'none';
  exhibitContainer.style.display = 'none';
  reqContainer.style.display = 'none';

  settingContainer.style.display = 'block';  
});

 
});

//pop up image then mga descriotion
function showPopup(element) {
  var blur = document.getElementById('blur');
  // get popup container
  const popup = document.getElementById('popup');

  // get data sa image-awtrok na div container
  const imageSrc = element.getAttribute('data-image');
  const title = element.getAttribute('data-title');
  const artist = element.getAttribute('data-artist');
  const category = element.getAttribute('data-category');
  const description = element.getAttribute('data-description');

  document.querySelector('.box-pop img').src = imageSrc;
  document.querySelector('.top-details h3').innerText = title;
  document.querySelector('.artist').innerText = artist;
  document.querySelector('.art-information p em a').href = 'profileDash.php'; 
  document.querySelector('.category').innerText = `${category}`;
  document.querySelector('.description-of-art').innerText = description;

  // Show the popup
  popup.style.display = 'flex';
  setTimeout(() => {
      popup.classList.add('active'); 
  }, 0); 

  blur.classList.add('active');
  popup.classList.add('active');
}


function toggleImage() {
  const popup = document.getElementById('popup');
  const blur = document.getElementById('blur');

  // Remove the active class from the popup and blur
  popup.classList.remove('active'); 
  blur.classList.remove('active'); 
 
}
// created
function toggleCreation(element = null) {
  var blur = document.getElementById('artworkContainer');
  var popup = document.getElementById('popup-creation');

  if (element) {


      const imageSrc = element.getAttribute("data-image");
      const title = element.getAttribute("data-title");
      const artist = element.getAttribute("data-artist");
      const description = element.getAttribute("data-description");
      const category = element.getAttribute("data-category"); 

      const popupImage = popup.querySelector(".box-pop img");
      const popupTitle = popup.querySelector(".top-details h3");
      const popupArtist = popup.querySelector(".art-information em a");
      const popupCategory = popup.querySelector(".art-category"); 
      const popupDescription = popup.querySelector(".art-information p:nth-of-type(3)");

      popupImage.src = imageSrc;
      popupTitle.textContent = title;
      popupArtist.textContent = artist;
      popupCategory.textContent = category; 
      popupDescription.textContent = description;

      blur.classList.add('active');
      popup.classList.add('active');
  } else {
      
      blur.classList.remove('active');
      popup.classList.remove('active');
  }
}


// saved
function toggleSaved() {
  var blur = document.getElementById('artworkContainer');
  var popup = document.getElementById('popup-creation');
  
  blur.classList.toggle('active'); 
  popup.classList.toggle('active');
}

// favortes
function toggleFavorite() {
  var blur = document.getElementById('artworkContainer');
  var popup = document.getElementById('popup-creation');
  
  blur.classList.toggle('active'); 
  popup.classList.toggle('active');
}

function toggleEditProfile() {
  // Access the sections that need to be hidden/shown
  const dashboardContainer = document.getElementById('dashboardContainer');
  const artworkContainer = document.getElementById('artworkContainer');
  const messageContainer = document.getElementById('messageContainer');
  const exhibitContainer = document.getElementById('exhibitContainer');
  const settingContainer = document.getElementById('settingsContainer');
  const reqContainer=document.getElementById('reqExhibit-con');

  // Hide all sections
  dashboardContainer.style.display = 'none';
  artworkContainer.style.display = 'none';
  messageContainer.style.display = 'none';
  exhibitContainer.style.display = 'none';
  reqContainer.style.display='none';
  
  // Show the settings container
  settingContainer.style.display = 'block';
}
function toggleExhibit() {
  // Access the sections that need to be hidden/shown
  const dashboardContainer = document.getElementById('dashboardContainer');
  const artworkContainer = document.getElementById('artworkContainer');
  const messageContainer = document.getElementById('messageContainer');
  const exhibitContainer = document.getElementById('exhibitContainer');
  const settingContainer = document.getElementById('settingsContainer');
  const reqContainer=document.getElementById('reqExhibit-con');

  // Hide all sections
  dashboardContainer.style.display = 'none';
  artworkContainer.style.display = 'none';
  messageContainer.style.display = 'none';
  exhibitContainer.style.display = 'none';
  settingContainer.style.display = 'none';
 
  reqContainer.style.display='block';

}

function openPage(pageName) {
  var i, tabcontent;
  tabcontent = document.getElementsByClassName("requestTab");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  document.getElementById(pageName).style.display = "block";
}

document.getElementById("defaultOpen").click();


//image selection in exhibit
document.querySelectorAll('.display-creations img').forEach((img) => {
  img.addEventListener('click', function() {
     
      if (document.querySelectorAll('.selected').length < 10 || img.classList.contains('selected')) {
          img.classList.toggle('selected');
      } else {
          alert('You can only select up to 10 artworks.');
      }
  });
});


//settings tab

function openSettings(evt, settingTab) {
  var i, tabcontent, setlinks;


  tabcontent = document.getElementsByClassName("tabInformation");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  setlinks = document.getElementsByClassName("setlinks");
  for (i = 0; i < setlinks.length; i++) {
    setlinks[i].className = setlinks[i].className.replace(" active", "");
  }


  document.getElementById(settingTab).style.display = "block";
  evt.currentTarget.className += " active";
}

function openDefaultTab() {
  var defaultTabButton = document.getElementById("defaultOpen");
  
  
  openSettings({ currentTarget: defaultTabButton }, 'myProfile');
}

window.onload = function() {
  openDefaultTab();
};

// // interactions
// function handleInteraction(action, userId, artworkId) {
//   // Prepare the data to send
//   const formData = new FormData();
//   formData.append('action', action);
//   formData.append('u_id', userId);
//   formData.append('a_id', artworkId);

//   // Send the data using AJAX (XMLHttpRequest)
//   const xhr = new XMLHttpRequest();
//   xhr.open('POST', 'interaction.php', true); // Assume you use interactionHandler.php to process the request
//   xhr.onload = function() {
//       if (xhr.status === 200) {
//           document.getElementById('interactionMessage').innerHTML = xhr.responseText; // Display success message
//       } else {
//           document.getElementById('interactionMessage').innerHTML = 'Something went wrong!';
//       }
//   };
//   xhr.send(formData); // Send the form data
// }
