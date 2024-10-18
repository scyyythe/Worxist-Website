<?php
include("include/connection.php");


$u_id = isset($_GET['u_id']) ? intval($_GET['u_id']) : 0;


$query = "SELECT * FROM accounts WHERE u_id = 34"; 
$stmt = $conn->prepare($query);
$stmt->execute(['u_id' => $u_id]);
$user = $stmt->fetch(); 


if (!$user) {
    echo "User not found!";
    exit; 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profileDash.css">
    <link rel="shortcut icon" href="image/vags-logo.png" type="image/x-icon">
    <title>Profile View</title>
</head>
<body>
    <header>
        <p><a href="dashboard.php"><</a></p>
    </header>

    <div class="wrapper">
        <div class="profile-details">
            <div class="image-profile">
                <img src="gallery/head.png" alt="">
            </div>

            <div class="user-information">
            <h5><?php echo htmlspecialchars($user['name']); ?></h5>
            <p><span>@</span><?php echo htmlspecialchars($user['username']); ?></p>

                <div class="follow">
                    <p><span >10</span>
                    <a href="" id="openFollowers">Followers</a>
                    </p>

                    <p><span >1</span>
                    <a href=""  id="openFollowing">Following</a>
                    </p>
                </div>

                <button class="follow-btn">
                    Follow
                </button>
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


        <!-- below folder section -->
 
                <div class="tab">
                    <button class="tablinks" onclick="openTab(event, 'created')">Created</button>
                    <button class="tablinks" onclick="openTab(event, 'saved')">Saved</button>
                </div>
                
                <!-- Tab content -->
                <div id="created" class="tabcontent">
                    <div class="image-artwork" >
                        <div class="box">
                            <img src="gallery/girl.jpg" alt="Uploaded Image 1">
                            <div class="artist-name">
                                <p><span><b>Jamaica Anuba</b></span><br>
                                The Curse</p>
                            </div>
                        </div>

                        <div class="box" >
                            <img src="gallery/lips.jpg" alt="Uploaded Image 1">
                            <div class="artist-name">
                                <p><span><b>Jamaica Anuba</b></span><br>
                                Anxiety</p>
                            </div>
                        </div>

                        <div class="box" >
                            <img src="gallery/body.jpg" alt="Uploaded Image 1">
                            <div class="artist-name">
                                <p><span><b>Jamaica Anuba</b></span><br>
                                   Human Body in All Its Glory</p>
                            </div>
                        </div>
                        
                    </div>
                                      
                </div>
                
                
                <div id="saved" class="tabcontent">
                    <div class="folder-container">

                        <div class="folder-image">

                            <div class="right-image">
                                 <img src="gallery/prof.jpg" alt="">
                                <img src="gallery/red.jpg" alt="">
                            </div>
                            

                             <div class="left-image">
                                 <img src="gallery/girl.jpg" alt="">
                             </div>                           
                             
                        </div>

                        <div class="folder-image">

                            <div class="right-image">
                                 <img src="gallery/prof.jpg" alt="">
                                <img src="gallery/red.jpg" alt="">
                            </div>
                            

                             <div class="left-image">
                                 <img src="gallery/girl.jpg" alt="">
                             </div>                           
                             
                        </div>

                        <div class="folder-image">

                            <div class="right-image">
                                 <img src="gallery/prof.jpg" alt="">
                                <img src="gallery/red.jpg" alt="">
                            </div>
                            

                             <div class="left-image">
                                 <img src="gallery/girl.jpg" alt="">
                             </div>                           
                             
                        </div>
                   
                    </div>

                    
                </div>
                
         
    </div>
    
    <script src="js/dashboard.js"> </script>
    <script>
 function openTab(evt, tabName) {
    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none"; // Hide all tab content
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", ""); // Remove active class
    }

    document.getElementById(tabName).style.display = "block"; 
    evt.currentTarget.className += " active"; 
}


document.addEventListener("DOMContentLoaded", function() {
    var firstTab = document.querySelector('.tablinks');
    firstTab.click(); 
});



      </script>
</body>
</html>