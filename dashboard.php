<?php
session_start();
include("include/connection.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    die;
}

// User data from session
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'User'; 
$u_id = $_SESSION['u_id']; 
$title = isset($_SESSION['title']) ? $_SESSION['title'] : 'Default Title';


$statement = $conn->prepare("SELECT file, title, description, category FROM art_info WHERE u_id = :u_id");
$statement->bindValue(':u_id', $u_id);
$statement->execute();
$images = $statement->fetchAll(PDO::FETCH_ASSOC);


$statement = $conn->prepare("
    SELECT art_info.file, accounts.u_name, art_info.title, art_info.description, art_info.category
    FROM art_info 
    JOIN accounts ON art_info.u_id = accounts.u_id
");
$statement->execute();
$allImages = $statement->fetchAll(PDO::FETCH_ASSOC);
?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="shortcut icon" href="image/vags-logo.png" type="image/x-icon">

    <title>Worxist</title>
</head>
<body>
   <nav class="sidebar close " id="sidebar">
        <header>
            <div class="image-text" >
                <span class="image" onclick="toggleSidebar()">
                <img src="image/white logo.png" alt="Logo" >
                    <div class="text header-text">
                    <span class="nameLogo">
                        Worxist
                    </span>        
                </div>
                </span>
                
                
            </div>
           
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="" class="dashboard">
                            <i class='bx bxs-dashboard'></i>
                            <span class="text nav-text">
                                Dashboard
                            </span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="" class="my-artworks">
                            <i class='bx bxs-palette'></i>
                            <span class="text nav-text">
                               My Artworks
                            </span>
                        </a>
                    </li>

                    <li class="nav-link">
                    <a href="" class="messages">
                        <i class='bx bxs-chat'></i>
                        <span class="text nav-text">
                          Messages
                        </span>
                    </a>
                </li>


            <li class="nav-link">
                <a href="" class="exhibit">
                <i class='bx bx-image-alt'></i>
                    <span class="text nav-text">
                      Exhibits
                    </span>
                </a>
            </li>

            <li class="nav-link">
                <a href="" class="settings">
                    <i class='bx bxs-cog'></i>
                    <span class="text nav-text">
                      Settings
                    </span>
                </a>
            </li>
            
                </ul>
            </div>

            <div class="bottom-content">
                <li class="nav-link">
                    <a href="index.php">
                        <i class='bx bx-log-out'></i>
                        <span class="text nav-text">
                        Sign Out
                        </span>
                    </a>
                </li>
   
           
            </div>
        </div>   
   </nav>
<!-- end of sidebar -->

   <div class="wrapper">


    <!-- artworks display -->
     <div class="dashcontainer" id="dashboardContainer">
    <div class="overlay">

    </div>
     <div class="top-head">
        <p><b>Worxist</b><span>
        </span></p>

            <div class="searchbar">
                 <input type="text" class="bar">
                <i class='bx bx-search search'></i>

            </div>
           
            <div class="notification-wrapper">
                <div class="notification-icon" onclick="toggleNotifications()">
                    <i class='bx bxs-bell'></i>
                    <span class="badge">3</span> 
                </div>

            <div class="notification-center" id="notificationCenter">
                <h5>Notifications</h5>
                <ul>
                    <li><a href="#">New comment on your post</a></li>
                    <li><a href="#">You have a new follower</a></li>
                    <li><a href="#">Jerald just posted an artwork</a></li>
                </ul>
                <a href="#" class="view-all">View all notifications</a>
            </div>
</div>

            
            <div class="filter-container">
                <i class='bx bx-filter filter-icon' onclick="toggleDropdown()"></i>
                                <div class="dropdown-content" id="dropdown">
                                    <a href="#">Sketches</a>
                                    <a href="#">Sculpture</a>
                                    <a href="#">Painting    </a>
                                </div>
            </div>

            <div class="profile">
                <div class="profile-pic"  onclick="toggleEditProfile()" > 
                 <img src="gallery/eyes.jpg" alt=""> 
                </div>
                <p class="to-edit-profile-btn" onclick="toggleEditProfile()"><b><?php echo $username;?> </b></p>
            </div>
        </div>


          <!-- Pop-up -->
<div class="popup" id="popup">
    <div class="box-pop">
        <img src="gallery/hands.jpg" alt="Hands">  
    </div>

    <!-- Interaction like save favorites -->
    <div class="social-interact-icons">
        <i class='bx bxs-heart'></i>
        <i class='bx bxs-bookmark-star bookmark'></i>
        <i class='bx bxs-star'></i>
    </div>

    <div class="art-details">
        <div class="top-details"> 
            <h3>The Caress</h3>
            <div class="close-popup" onclick="toggleImage()">
                <i class='bx bx-x'></i>
            </div>
        </div>

        <div class="art-information">
            <p><b>Artist:</b> <em><a href="#" class="artist"></a></em></p>
            <p>Catgeory: <span class="category">Paintin</span>g</p>
            <br>
            <p class="description-of-art">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>

        <div class="interaction">
            <h5>Comments</h5>
            <div class="user-image">
                <div class="profile-pic"> 
                    <img src="gallery/eyes.jpg" alt=""> 
                </div> 
                <h5>Angel Canete</h5>                             
            </div>
            <div class="comment">
                <p>Wow!</p>
            </div>                            
        </div>

        <div class="input-comment">
            <textarea name="comment" id="comment" class="comment-area"></textarea>
            <button class="comment-btn"><i class='bx bxs-send'></i></button>
        </div>
    </div>
</div>

<div class="image-artwork" id="blur">
    <?php 
    if (!empty($allImages)) {
        foreach ($allImages as $image) { 
            ?>
            <div class="box" 
                 onclick="showPopup(this)" 
                 data-image="<?php echo htmlspecialchars($image['file']); ?>"
                 data-title="<?php echo htmlspecialchars($image['title']); ?>"
                 data-artist="<?php echo htmlspecialchars($image['u_name']); ?>"
                 data-category="<?php echo htmlspecialchars($image['category']); ?>" 
                 data-description="<?php echo htmlspecialchars($image['description']); ?>">
                 
                <img src="<?php echo htmlspecialchars($image['file']); ?>" alt="Uploaded Image">
                <div class="artist-name">
                    <p><span><b><?php echo htmlspecialchars($image['u_name']); ?></b></span><br>
                    <?php echo htmlspecialchars($image['title']); ?></p>
                </div>
            </div>
            <?php 
        }
    } else {
        echo "<p>No images found.</p>";
    }
    ?>
</div>

     </div>

     <!-- my artworks -->
        <!-- pop-up -->
        <div class="popup" id="popup-creation" >
                    <div class="box-pop">
                        <img src="  gallery/rose.png" alt="Hands">  
                             
                    </div>

                    <!-- interction like save favorites -->
                

                     <div class="social-interact-icons">
                        <i class='bx bxs-heart'></i>  
                        <i class='bx bxs-bookmark-star'></i>       
                        <i class='bx bxs-star' ></i>
                     </div>
                    


                    <div class="art-details">
                        <div class="top-details"> 
                            <h3>The Caress</h3>
                            <div class="close-popup-creations" onclick="toggleCreation()">
                                <i class='bx bx-x'></i>
                             </div>
                        </div>
    
                        <div class="art-information">
                            <p>Artist: <em><a href="" class="artist-name">Jamaica Anuba</a></em> </p>
                            <p>Category: Painting </p>
                            <br>
                            <p class="art-description">&nbsp;&nbsp;&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                        </div>

                        <div class="interaction">
                            <h5>Comments</h5>
            
                            <div class="user-image">
                                <div class="profile-pic"> 
                                <img src="gallery/eyes.jpg" alt=""> 
                                </div> 
                                <h5>Angel Canete</h5>                             
                             </div>
                            
                                <div class="comment">
                                <p>Wow!</p>

                                </div>

                                <div class="input-comment">

                                    <textarea name="comment" id="comment" class="comment-area"></textarea>
                                    <button class="comment-btn"><i class='bx bxs-send'></i></button>
                                </div>
                                
                        </div>
                    </div>
        </div>


        <!-- artwork section -->
     <div class="artwork-section" id="artworkContainer">
    
    <div class="tabpanes">
    <h3>Artworks</h3>
        <div class="tab">
        <a class="tablinks" onclick="myOption(event, 'Created')">Created <span></span></a>
        <a class="tablinks" onclick="myOption(event, 'Saved')">Saved <span></span></a>
        <a class="tablinks" onclick="myOption(event, 'Favorites')">Favorites<span></span></a>

        </div>
    <!-- Created -->
    <div class="tabcontent" id="Created" >
      <h3>My Creations</h3>
     
      <div class="image-artwork created">

            <button class="box-button" id="upload" onclick="window.location.href='uploadArt.php'"> 
                <i class='bx bx-message-square-add'></i>
            </button>

            <?php if (!empty($images)) {
            foreach ($images as $image) {
                echo '<div class="box" onclick="toggleCreation(this)"'; 
                echo ' data-image="' . htmlspecialchars($image['file']) . '"';
                echo ' data-title="' . htmlspecialchars($image['title']) . '"';
                echo ' data-artist="' . htmlspecialchars($name) . '"';
                echo ' data-description="' . htmlspecialchars($image['description']) . '">'; 
                echo '<img src="' . htmlspecialchars($image['file']) . '" alt="Uploaded Image">';
                echo '<div class="artist-name">';
                echo '<p><span><b>' . htmlspecialchars($name) . '</b></span><br>' . htmlspecialchars($image['title']). '</p>'; 
                echo '</div>'; 
                echo '</div>'; 
            }
} ?>



</div>
     
    </div>
    
    
    <!-- Saved -->
    <div id="Saved" class="tabcontent">
      <h3>Saved Artworks</h3>
     
        <div class="image-artwork saved-image">
            <div class="box" onclick="toggleSaved()">
                <img src="gallery/eternity.jpg" alt="Hands">
                <div class="artist-name">
                    <p><span><b>Jerald Aliviano</b></span><br>
                    The Eternity</p>
                </div>
                
            </div>
    
        </div>
      
        </div>
    
    
         <!-- Favorites -->
         <div id="Favorites" class="tabcontent">
            <h3>My Favorites</h3>
            <div class="image-artwork favorite-image">
            <div class="box" onclick="toggleSaved()">
                <img src="gallery/body.jpg" alt="Hands">
                <div class="artist-name">
                    <p><span><b>Jerald Aliviano</b></span><br>
                    The Eternity</p>
                </div>
                
            </div>
    
        </div>
        </div>

        

        <!-- end of tabpande -->
    </div>
    
        <!-- end of myartwork -->
       </div>



       <!-- Messegaes -->
        <div class="messages-container" id="messageContainer">
            
            <div class="head-message">
                 <h5>Chats</h5>
                
            </div>
           
            <div class="message-name">

                <div class="message-name-head">
                        <div class="message-user-image"> 
                             <img src="gallery/girl.jpg" alt=""> <br>
                             <p>Jamaica Anuba</p><br>
                             <input type="text" name="search-friend" id="search-friend" placeholder="Search">
                        </div>
                        
                </div>

                <div class="name-box-container">
                     <div class="message-name-box">
                         <div class="profile-pic message-profile"> 
                             <img src="gallery/girl.jpg" alt=""> 
                        </div>
    
                        <h5>Jerald Aliviano</h5>
                </div>

                <div class="message-name-box">
                    <div class="profile-pic message-profile"> 
                        <img src="gallery/eyes.jpg" alt=""> 
                   </div>

                   <h5>Angel Canete</h5>
                </div>
                </div>
               
                 
            </div>

            <!-- image display -->
            <div class="message-display ">
                <div class="message-name-box header-chat" >
                    <div class="profile-pic message-profile"> 
                        <img src="gallery/eyes.jpg" alt=""> 
                   </div>

                   <h4>Angel Canete</h4>
                </div>

                <div class="messages-body">
            <!-- Incoming Message -->
            <div class="message incoming">
                <div class="message-content">
                    <p>Hello Jai</p>
                    <span class="timestamp">10:30 AM</span>
                </div>
            </div>

            <!-- Outgoing Message -->
            <div class="message outgoing">
                <div class="message-content">
                    <p>Hi gel</p>
                    <span class="timestamp">10:32 AM</span>
                </div>
            </div>

            <!-- Incoming Message -->
            <div class="message incoming">
                <div class="message-content">
                    <p>What are you up to?</p>
                    <span class="timestamp">10:33 AM</span>
                </div>
            </div>
        </div>

        <!-- Message Input Area -->
        <div class="messages-footer">
            <input type="text" placeholder="Type a message" class="message-input">
            <button class="send-btn"><i class='bx bx-send'></i></button>
        </div>

                
            </div>
            <!-- end of message container -->
        </div>




        <!-- Exhbits -->
        <div class="exhibit-container" id="exhibitContainer">
            <button onclick="toggleExhibit()" class="schedule-now">Schedule Now</button>
            <!-- end of exhibit container -->
        </div>


        <!-- Solo Exhibit Request -->
        <div id="reqExhibit-con" class="reqExhibit-con">
            <div class="top-req">
                <i class='bx bx-chevron-left' onclick="toggleExhibit()"></i>
                <p>Schedule Your Exhibition Now</p>
            </div>

            <div class="tab-btn">
                <button class="requestLink" onclick="openPage('Solo')" id="defaultOpen">Solo</button>
                <button class="requestLink" onclick="openPage('Collaborative')" >Collaborate</button>
            </div>
            

            <div id="Solo" class="requestTab">

            <div class="exhibit-inputs">
                <form action="" name="soloExhibit" >
                    <label for="exhibit-title">Exhibit Title</label><br>
                    <input type="text" placeholder="Enter the title of your exhibit"><br>

                    <label for="exhibit-description">Exhibit Description</label><br>
                    <textarea name="exhibit-description" id="exhibit-description" placeholder="Describe the theme or story behind your exhibit"></textarea><br>

                    <label for="exhibit-date">Exhibit Date</label><br>
                    <input type="date" id="exhibit-date" name="exhibit-date">

                </form>
                <div class="image-exhibit">
                    <img src="image/solo-image.png" alt="Painting Graphics">
                </div>
            </div>
                
                    <div class="select-art">
                        <p>Selected Artworks (Maximum of 10)</p>

                        <div class="display-creations">
                        <img src="gallery/girl.jpg " alt="">
                        <img src="gallery/eyes.jpg" alt="">
                        <img src="gallery/body.jpg" alt="">
                        <img src="gallery/eternity.jpg" alt="">
                        </div>
                    </div>

                <div class="confrim-solo">
                    <button class="solo-btn">Confirm Schedule</button>
                </div>
            </div>
<!-- collab request -->
            <div id="Collaborative" class="requestTab">
            <div class="exhibit-inputs">
                <form action="" name="soloExhibit" >
                    <label for="exhibit-title">Exhibit Title</label><br>
                    <input type="text" placeholder="Enter the title of your exhibit"><br>

                    <label for="exhibit-description">Exhibit Description</label><br>
                    <textarea name="exhibit-description" id="exhibit-description" placeholder="Describe the theme or story behind your exhibit"></textarea><br>

                    <label for="exhibit-date">Exhibit Date</label><br>
                    <input type="date" id="exhibit-date" name="exhibit-date">

                </form>
                <div class="add-collab">
                    <label for="">Add Collaborators</label><br>
                   <input type="text" name="" id="" placeholder="Search">

                   <div class="display-collab">

                   </div>
                </div>
            </div>
                
                    <div class="select-art">
                        <p>Selected Artworks (Maximum of 10)</p>

                        <div class="display-creations">
                        <img src="gallery/girl.jpg " alt="">
                        <img src="gallery/eyes.jpg" alt="">
                        <img src="gallery/body.jpg" alt="">
                        <img src="gallery/eternity.jpg" alt="">
                        </div>
                    </div>

                <div class="confrim-solo">
                    <button class="collab-btn">Confirm Schedule</button>
                </div>
            </div>

        </div>




<div class="settings-container" id="settingsContainer">
<h2>Settings</h2>

<div class="tab-container">
<div class="tab-settings">
        <button class="setlinks" onclick="openSettings(event, 'myProfile')" id="defaultOpen">My Profile</button>
        <button class="setlinks" onclick="openSettings(event, 'accSetting')">Account Setting</button>
        <button class="setlinks" onclick="openSettings(event, 'notifSetting')">Notification</button>
    </div>
               
            <div id="myProfile" class="tabInformation"> <!-- Corrected spelling -->
                <h3>My Profile</h3>
                <div class="top-myprofile">
                    <div class="profile-picture">
                    <div class="image-profile">
                            <img src="gallery/girl.jpg" alt="">
                    </div>

                        <div class="text-image">
                            <h3>Upload new image</h3>
                            <p>Max file size - 10mb</p>
                        </div>
                    </div>

                    <div class="upload-image-btn">
                        <button>Upload</button>
                        <button>Remove image</button>
                    </div>

                </div>

                <div class="form-below">

                <div class="follow">
                    <p><span >10</span>
                    <a href="#" id="openFollowers">Followers</a>
                    </p>

                    <p><span >1</span>
                    <a href="#"  id="openFollowing">Following</a>
                    </p>
                </div>
                
                <!-- edit username -->
                    <label for="edit-username">Edit Username</label><br>
                    <input type="text" value="<?php echo $username;?>"><br><br>

                    <button>Save Changes</button>
                </div>
            </div>

            <div id="accSetting" class="tabInformation">
                <h2>Account Setting</h2>
                
                <div class="name-display">

                <div class="myname">
                    <h3>Name</h3>
                    <input type="text" value="<?php echo $name;?>">
                </div>
                    
                    <button>Change</button>
                </div>

                <hr>
                <br>
                <h3>Email Address</h3>
                <p>Your email is <span><em><?php echo $email;?></em></span></p>
                <br>
                <hr>

                <div class="password-container">

                <div class="mypassword">
                     <h3>Password</h3>
                    <label for="password">Password</label>
                    <input type="password" value="secretbastapasswordni">
                </div>
                   
                    <button>Change</button>
                </div>
                
                <div class="delete-container">
                    
                <div class="confirm-delete">
                    <h3>Delete Account</h3>
                    <p>Would you like to delete your account?
                    Deleting your account will remove all the content associated with it.</p>
                </div>
                    

                    <button>I want to delete my account</button>
                </div>

            </div>

            <div id="notifSetting" class="tabInformation"> 
                <h3>Tokyo</h3>
                <p>Tokyo is the capital of Japan.</p>
            </div>      

</div>
  
         <!-- Popup Modal -->
         <div id="followers-modal" class="modal">
                        <div class="modal-content">
                            <span class="close-button">&times;</span>
                            
                            <div id="followers-content">
                                <h5>Followers</h5>
                                <div class="follower-display">
                                    <div class="profile-pic">
                                        <img src="gallery/eyes.jpg" alt="">
                                    </div>
                                    <div class="follower-name">
                                        <h5>Angel Canete <br>
                                            <span><a href="profileDash.php"><span>@</span>scyy</a></span>
                                        </h5>
                                    </div>
                                </div>
                            
                                
                            </div>

                            <div id="following-content" style="display: none;">
                                <h5>Following</h5>
                                <div class="following-display">
                                    <div class="profile-pic">
                                        <img src="gallery/girl.jpg" alt="">
                                    </div>
                                    <div class="follower-name">
                                        <h5>Angel Canete <br>
                                            <span><a href="profileDash.php"><span>@</span>scyy</a></span>
                                        </h5>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>

            <div class="modal-content">
                <span class="close-button">&times;</span>
                
                <div id="followers-content">
                    <h5>Followers</h5>
                    <div class="follower-display">
                        <div class="profile-pic">
                            <img src="gallery/eyes.jpg" alt="">
                        </div>
                        <div class="follower-name">
                            <h5>Angel Canete <br>
                                <span><a href=""><span>@</span>scyy</a></span>
                            </h5>
                        </div>
                    </div>
                
                    
                </div>

                <div id="following-content" style="display: none;">
                    <h5>Following</h5>
                    <div class="following-display">
                        <div class="profile-pic">
                            <img src="gallery/eyes.jpg" alt="">
                        </div>
                        <div class="follower-name">
                            <h5>Angel Canete <br>
                                <span><a href="profileDash.html"><span>@</span>scyy</a></span>
                            </h5>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>

    <!-- end of settings container -->
</div>



        
    <!-- end of wrapper -->
   </div>
  
   <script src="js/dashboard.js"></script>
            
   
</body>
</html>