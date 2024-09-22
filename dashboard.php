<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    die;
}

// Access user data from session
$username = $_SESSION['username'];
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'User'; 
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
            <div class="image-text">
                <span class="image">
                    <img src="image/vags-logo.png" alt="Logo">
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
                <a href="" class="notifications">
                    <i class='bx bxs-bell' ></i>
                    <span class="text nav-text">
                       Notification
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
        <p>Good Day <span>
        </span></p>

            <div class="searchbar">
                 <input type="text" class="bar">
                <i class='bx bx-search search'></i>


                <div class="filter-container">
    <i class='bx bx-filter filter-icon' onclick="toggleDropdown()"></i>
                    <div class="dropdown-content" id="dropdown">
                        <a href="#">Sketches</a>
                        <a href="#">Sculpture</a>
                        <a href="#">Painting    </a>
                    </div>
                </div>

            </div>
           
            <div class="profile">
                <div class="profile-pic"> 
                 <img src="gallery/eyes.jpg" alt=""> 
                </div>
                <p><b><?php echo $username; ?> </b></p>
            </div>
        </div>


                    <!-- pop-up -->
                <div class="popup" id="popup" >
                    <div class="box-pop">
                        <img src="gallery/hands.jpg" alt="Hands">  
                             
                    </div>

                    <!-- interction like save favorites -->
                     <div class="social-interact-icons">
                        <i class='bx bxs-heart'></i>
                        <i class='bx bxs-bookmark-star' ></i>
                        <i class='bx bxs-star' ></i>
                     </div>
                    


                    <div class="art-details">
                        <div class="top-details"> 
                            <h3>The Caress</h3>
                            <div class="close-popup" onclick="toggleImage()">
                                <i class='bx bx-x'></i>
                            </div>
                        </div>
    
                        <div class="art-information">
                            <p>Artist: <em><a href="">Jamaica Anuba</a></em> </p>
                            <p>Category: Painting </p>
                            <br>
                            <p>&nbsp;&nbsp;&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
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
                    </div>
                </div>

         
                <div class="image-artwork" id="blur">
                    <div class="box" onclick="toggleImage()">
                        <img src="gallery/hands.jpg" alt="Hands">

                        <div class="artist-name">
                            <p><span><b>Jamaica Anuba</b></span><br>
                            The Caress</p>
                        </div>
                    </div>
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
                        <i class='bx bxs-bookmark-star' ></i>
                        <i class='bx bxs-star' ></i>
                     </div>
                    


                    <div class="art-details">
                        <div class="top-details"> 
                            <h3>The Caress</h3>
                            <div class="close-popup" onclick="toggleCreation()">
                                <i class='bx bx-x'></i>
                            </div>
                        </div>
    
                        <div class="art-information">
                            <p>Artist: <em><a href="">Jamaica Anuba</a></em> </p>
                            <p>Category: Painting </p>
                            <br>
                            <p>&nbsp;&nbsp;&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
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
                    </div>
        </div>
     <div class="artwork-section" id="artworkContainer">
    
        <div class="profile-info">
                <div class="image-profile">
                    <img src="gallery/eyes.jpg" alt="">
                </div>
    
                <div class="name">
                    <span>Jam Candia</span>
                    <p>jamcadia23</p>
                    <br>
                    <div class="follow">
                        <p><span >10</span>
                        <a href="">Followers</a>
                        </p>
    
                        <p><span >1</span>
                        <a href="">Following</a>
                        </p>
                    </div>
                </div>
    
                <div class="edit-profile-container">
                    <button>Edit Profile</button>
    
                </div>
        </div>
       <hr>
    
    
    <div class="tabpanes">
    
    <div class="tab">
      <a class="tablinks" onclick="myOption(event, 'Created')">Created <span></span></a>
      <a class="tablinks" onclick="myOption(event, 'Saved')">Saved <span></span></a>
      <a class="tablinks" onclick="myOption(event, 'Favorites')">Favorites<span></span></a>

    </div>
    <!-- Created -->
    <div class="tabcontent" id="Created" >
      <h3>My Creations</h3>
     
        <div class="image-artwork">
            <button class="box-button" id="upload" >
                <i class='bx bx-message-square-add'></i>
            </button>
                    <div class="box" onclick="toggleCreation()">
                        <img src="gallery/rose.png" alt="Hands">

                        <div class="artist-name">
                            <p><span><b>Jamaica Anuba</b></span><br>
                            The Caress</p>
                        </div>
                    </div>
         </div>


      
    </div>
    
    
    <!-- Saved -->
    <div id="Saved" class="tabcontent">
      <h3>Saved Artworks</h3>
     
        <div class="image-artwork">
            <div class="box">
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
            <div class="image-artwork">
                <div class="box">
                    <img src="gallery/guitar.jpg" alt="Hands">
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
                 <h1>Messages </h1>
                 <i class='bx bxs-message-alt-edit'></i>
            </div>
           
            
            <!-- end of message container -->
        </div>



        <!-- Notification -->
        <div class="notification-container" id="notificationContainer">
            <h1>hello notification</h1>


            <!-- end of notification container -->
        </div>



        <!-- Exhbits -->
        <div class="exhibit-container" id="exhibitContainer">
            <h1>hello exhbit</h1>
    

            <!-- end of exhibit container -->
        </div>




        <!-- Settings -->
        <div class="settings-container" id="settingsContainer">
            <h1>hello settings</h1>


            <!-- end of settings container -->
        </div>



        
    <!-- end of wrapper -->
   </div>
  
   <script src="js/dashboard.js"></script>

   
</body>
</html>