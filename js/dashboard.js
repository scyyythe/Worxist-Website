// katong lihok sa login register
document.addEventListener('DOMContentLoaded', function() {

    function scrollToAbout() {
      const aboutSection = document.getElementById('about');
      if (aboutSection) {
          aboutSection.scrollIntoView({ behavior: 'smooth' });
      } else {
          console.error("Element with id='about' not found.");
      }
  }

  const exploreButton = document.querySelector('.explore-button button');
  if (exploreButton) {
      exploreButton.addEventListener('click', scrollToAbout);
  }



  const carousel = document.querySelector(".gallery-images"),
      firstImg = document.querySelectorAll("img")[0];


if (firstImg) {
  const arrowIcons = document.querySelectorAll(".arrow i");
  let firstImgWidth = firstImg.clientWidth + 272; 

  arrowIcons.forEach(icon => {
      icon.addEventListener("click", () => {
          if (icon.id === "left") {
              
              carousel.scrollLeft -= firstImgWidth; 
          } else if (icon.id === "right") {
              // Scroll right
              carousel.scrollLeft += firstImgWidth; 
          }
      });
  });
} else {
  console.error("Gallery images not found.");
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

  // return click
  const returnTo = document.getElementById('returnTo');
  if (returnTo) {
    returnTo.addEventListener('click', function() {
      window.location.href = 'index.php';
    });
  } else {
    console.error("Return button with id='return' not found.");
  }



  const signIn = document.getElementById("show-login");
  const signUp = document.getElementById("show-create");
  const wrapper = document.getElementById("wrapper");

  if (signIn && signUp && wrapper) {
    signIn.addEventListener('click', (event) => {
      event.preventDefault();  
      wrapper.classList.add("right-panel-activate");
    });

    signUp.addEventListener('click', (event) => {
      event.preventDefault();  
      wrapper.classList.remove("right-panel-activate");
    });
  } else {
    console.error("Sign-in, Sign-up, or wrapper elements not found.");
  }


  const exploreBtn = document.getElementById('explore');
  if (exploreBtn) {
    exploreBtn.addEventListener('click', function() {
      window.location.href = 'accounLogin.html';
    });
  } else {
    console.error("Explore button with id='explore' not found.");
  }
});



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


function showPopup(element) {
  const blur = document.getElementById('blur');
  const popup = document.getElementById('popup');

  const imageSrc = element.getAttribute('data-image');
  const title = element.getAttribute('data-title');
  const artist = element.getAttribute('data-artist');
  const artistId = element.getAttribute('data-artist-id');
  const category = element.getAttribute('data-category');
  const description = element.getAttribute('data-description');
  const date = element.getAttribute('data-date');
  const artworkId = element.getAttribute('data-artwork-id');

  console.log("Artwork ID (a_id):", artworkId);
  console.log("Title:", title);
  console.log("Artist:", artist);

  const socialIcons = document.querySelector('.social-interact-icons');
  socialIcons.setAttribute('data-artwork-id', artworkId);

  document.querySelector('.box-pop img').src = imageSrc;
  document.querySelector('.top-details h3').innerText = title;
  const dataIdLink = document.querySelector('.data-id');
  dataIdLink.href = `profileDash.php?id=${artistId}`;
  dataIdLink.innerText = artist;

  document.querySelector('.category').innerText = category;
  document.querySelector('.description-of-art').innerText = description;
  document.querySelector('.dateUpload').innerText = date;

  const loggedInUserId = document.getElementById('data-id').getAttribute('data-artist-id');


  const existingEditOption = document.querySelector('.edit-option');
  if (existingEditOption) {
    existingEditOption.remove();
  }

 
  if (artistId === loggedInUserId) {
    const editOption = document.createElement('p');
    editOption.innerHTML = "<i class='bx bxs-edit'></i>";
    editOption.classList.add('edit-option');

    editOption.onclick = () => {
      window.location.href = `editArtwork.php?a_id=${artworkId}`;
    };

    document.querySelector('.top-details').appendChild(editOption);
  }

  popup.style.display = 'flex';
  setTimeout(() => {
      popup.classList.add('active');
  }, 0);

  blur.classList.add('active');

  document.addEventListener('DOMContentLoaded', () => {
    const artworkId = document.querySelector('.box-pop img').getAttribute('data-artwork-id');
    initializeIconStates(artworkId);  
    
  });

  document.querySelector('.like-icon').onclick = () => {
      const likeIcon = document.querySelector('.like-icon');
      likeIcon.classList.toggle('liked'); 
      updateDatabase('likeArtwork', artworkId); 
  };
  
  document.querySelector('.bookmark-icon').onclick = () => {
      const bookmarkIcon = document.querySelector('.bookmark-icon');
      bookmarkIcon.classList.toggle('saved'); 
      updateDatabase('saveArtwork', artworkId); 
  };
  
  document.querySelector('.favorite-icon').onclick = () => {
      const favoriteIcon = document.querySelector('.favorite-icon');
      favoriteIcon.classList.toggle('favorited'); 
      updateDatabase('addToFavorites', artworkId); 
  };
}


function initializeIconStates(artworkId) {
  fetch(`class/interaction.php?action=getStates&a_id=${artworkId}`)
    .then(response => response.json())
    .then(data => {
        if (data) {
          
            if (data.liked) {
                document.querySelector('.like-icon').classList.add('liked');
            }
            if (data.saved) {
                document.querySelector('.bookmark-icon').classList.add('saved');
            }
            if (data.favorited) {
                document.querySelector('.favorite-icon').classList.add('favorited');
            }
        }
    })
    .catch(error => {
        console.error('Error fetching icon states:', error);
    });
}


function updateDatabase(action, artworkId) {
    return fetch('class/interaction.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ action: action, a_id: artworkId })
    })
    .then(response => {
        return response.text().then(text => {
            console.log('Raw response:', text); 
            const jsonResponse = JSON.parse(text); 
            return jsonResponse; 
        });
    })
    .catch(error => {
        console.error('Error:', error);
        return { success: false, message: 'Error occurred' }; 
    });
}

function closePopup() {
  const popup = document.getElementById('popup');
  const blur = document.getElementById('blur');

  popup.classList.remove('active'); 
  blur.classList.remove('active'); 

 
  setTimeout(() => {
      popup.style.display = 'none';
  }, 300); 
}


function toggleEditProfile() {

  const dashboardContainer = document.getElementById('dashboardContainer');
  const artworkContainer = document.getElementById('artworkContainer');
  const messageContainer = document.getElementById('messageContainer');
  const exhibitContainer = document.getElementById('exhibitContainer');
  const settingContainer = document.getElementById('settingsContainer');
  const reqContainer=document.getElementById('reqExhibit-con');


  dashboardContainer.style.display = 'none';
  artworkContainer.style.display = 'none';
  messageContainer.style.display = 'none';
  exhibitContainer.style.display = 'none';
  reqContainer.style.display='none';
  

  settingContainer.style.display = 'block';
}


//exhibit
function toggleExhibit() {

  const dashboardContainer = document.getElementById('dashboardContainer');
  const artworkContainer = document.getElementById('artworkContainer');
  const messageContainer = document.getElementById('messageContainer');
  const exhibitContainer = document.getElementById('exhibitContainer');
  const settingContainer = document.getElementById('settingsContainer');
  const reqContainer=document.getElementById('reqExhibit-con');


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

//select artwork

document.querySelectorAll('.display-creations img').forEach((img) => {
  img.addEventListener('click', function () {
      if (img.classList.contains('selected')) {
          img.classList.remove('selected');
      } else {
          if (document.querySelectorAll('.selected').length < 10) {
              img.classList.add('selected');
          } else {
              alert('You can only select up to 10 artworks.');
              return; 
          }
      }
      console.log('Selected Artwork ID:', img.getAttribute('data-id'));

      const selectedIds = Array.from(document.querySelectorAll('.display-creations img.selected'))
          .map(selectedImg => selectedImg.getAttribute('data-id'));
      document.getElementById('selectedArtworks').value = JSON.stringify(selectedIds);
  });
});

//search collaboratots
let debounceTimeout;

function searchCollaborators(query) {
    const searchResultsDiv = document.getElementById("searchResults");
    searchResultsDiv.innerHTML = ""; 

    if (query.length === 0) {
        searchResultsDiv.innerHTML = '';
        return; 
    }
    searchResultsDiv.innerHTML = '<p>Loading...</p>'; 
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => {
        
        fetch('dashboard.php?query=' + encodeURIComponent(query))
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch data');
                }
                return response.json(); 
            })
            .then(data => {
              console.log(data); 
          
              searchResultsDiv.innerHTML = '';
              
              if (data.length === 1 && data[0].name === 'No collaborators found.') {
                  searchResultsDiv.innerHTML = '<p>No collaborators found.</p>';
                  return;
              }
          
              data.forEach(collaborator => {
                  const div = document.createElement('div');
                  div.classList.add('collab-item');
          
                  const span = document.createElement('span');
                  span.classList.add('collab-name');
                  span.textContent = collaborator.name;
          
                  const button = document.createElement('button');
                  button.classList.add('select-collab-btn');
                  button.textContent = 'Select';
                  button.onclick = function() {
                      console.log(collaborator); 
                      selectCollaborator(collaborator.name, collaborator.u_id); 
                  };
          
                  div.appendChild(span);
                  div.appendChild(button);
                  searchResultsDiv.appendChild(div);
              });
          })
          
            .catch(error => {
                searchResultsDiv.innerHTML = '<p>Error fetching data: ' + error.message + '</p>';
            });
    }, 300);  
}

function selectCollaborator(name, u_id) {
  console.log("Collaborator Selected:", name, u_id);  

  const selectedCollaboratorsDiv = document.getElementById("selectedCollaborators");
  const selectedCollaboratorsInput = document.getElementById("selectedCollaboratorsInput");
  
  if (selectedCollaboratorsDiv.innerHTML.includes(name)) {
      alert("This collaborator is already selected.");
      return;
  }

  const collaboratorItem = document.createElement("div");
  collaboratorItem.classList.add("selected-collaborator");
  collaboratorItem.textContent = name;

  const removeBtn = document.createElement("button");
  removeBtn.textContent = "Remove";
  removeBtn.classList.add("remove-collab-btn");
  removeBtn.onclick = function() {
      removeCollaborator(collaboratorItem, u_id);
  };

  collaboratorItem.appendChild(removeBtn);
  selectedCollaboratorsDiv.appendChild(collaboratorItem);

  const selectedCollaborators = selectedCollaboratorsInput.value ? selectedCollaboratorsInput.value.split(',') : [];
  selectedCollaborators.push(u_id); 
  selectedCollaboratorsInput.value = selectedCollaborators.join(','); 
}


function removeCollaborator(collaboratorItem, u_id) {
  const selectedCollaboratorsDiv = document.getElementById("selectedCollaborators");
  const selectedCollaboratorsInput = document.getElementById("selectedCollaboratorsInput");

  selectedCollaboratorsDiv.removeChild(collaboratorItem);

  let selectedCollaborators = selectedCollaboratorsInput.value.split(',');
  selectedCollaborators = selectedCollaborators.filter(id => id !== u_id);
  selectedCollaboratorsInput.value = selectedCollaborators.join(',');

  console.log('Selected Collaborators Input Value after Removal:', selectedCollaboratorsInput.value); 
}




