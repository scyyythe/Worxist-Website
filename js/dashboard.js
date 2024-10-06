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
// Get modal element
const modal = document.getElementById("followers-modal");
const followersContent = document.getElementById("followers-content");
const followingContent = document.getElementById("following-content");

// Get buttons to open modal
const viewFollowersButton = document.getElementById("openFollowers");
const viewFollowingButton = document.getElementById("openFollowing");

// Get close button
const closeButton = document.getElementsByClassName("close-button")[0];

// Open Followers modal
viewFollowersButton.addEventListener("click", function(event) {
    event.preventDefault(); // Prevent default link behavior
    followersContent.style.display = "block";
    followingContent.style.display = "none";
    modal.style.display = "block";
});

// Open Following modal
viewFollowingButton.addEventListener("click", function(event) {
    event.preventDefault(); // Prevent default link behavior
    followersContent.style.display = "none";
    followingContent.style.display = "block";
    modal.style.display = "block";
});

// Close modal when close button is clicked
closeButton.addEventListener("click", function() {
    modal.style.display = "none"; 
});

// Close modal when clicking outside the modal content
window.addEventListener("click", function(event) {
    if (event.target === modal) {
        modal.style.display = "none"; 
    }
});


document.addEventListener('DOMContentLoaded', function() {

  // sidebar links
  const dashboardLink = document.querySelector('.dashboard');
  const artworkLink = document.querySelector('.my-artworks');
  const messageLink=document.querySelector('.messages');
  const exhibitLink=document.querySelector('.exhibit');
  const settingLink=document.querySelector('.settings');

  
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


  // Dashboard
  dashboardLink.addEventListener('click', function(e) {
      e.preventDefault(); 
      dashboardContainer.style.display = 'block';
      artworkContainer.style.display = 'none';
      messageContainer.style.display = 'none';
      exhibitContainer.style.display = 'none';
      settingContainer.style.display = 'none';

  });

  //my-artworks Management
  artworkLink.addEventListener('click', function(e) {
      e.preventDefault();
      dashboardContainer.style.display = 'none';
      artworkContainer.style.display = 'block';
      messageContainer.style.display = 'none';
      exhibitContainer.style.display = 'none';
      settingContainer.style.display = 'none';

  });

  // messages section
messageLink.addEventListener('click', function(e) {
    e.preventDefault();
    dashboardContainer.style.display = 'none';
    artworkContainer.style.display = 'none';
    messageContainer.style.display = 'block';
    exhibitContainer.style.display = 'none';
    settingContainer.style.display = 'none';

});



// exhibit container
exhibitLink.addEventListener('click', function(e) {
  e.preventDefault();
  dashboardContainer.style.display = 'none';
      artworkContainer.style.display = 'none';
      messageContainer.style.display = 'none'
      exhibitContainer.style.display = 'block';
      settingContainer.style.display = 'none';

});


// settings
settingLink.addEventListener('click', function(e) {
  e.preventDefault();
  dashboardContainer.style.display = 'none';
      artworkContainer.style.display = 'none';
      messageContainer.style.display = 'none';
      exhibitContainer.style.display = 'none';
      settingContainer.style.display = 'block';

});
 
});

    // pop up image description
    function toggleImage() {
      var blur = document.getElementById('blur');
      var popup = document.getElementById('popup');
      
      blur.classList.toggle('active'); 
      popup.classList.toggle('active');
  }
// created
  function toggleCreation() {
    var blur = document.getElementById('artworkContainer');
    var popup = document.getElementById('popup-creation');
    
    blur.classList.toggle('active'); 
    popup.classList.toggle('active');
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
  
  // Hide all sections
  dashboardContainer.style.display = 'none';
  artworkContainer.style.display = 'none';
  messageContainer.style.display = 'none';
  exhibitContainer.style.display = 'none';
  
  // Show the settings container
  settingContainer.style.display = 'block';
}


