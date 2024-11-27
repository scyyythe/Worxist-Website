<?php
session_start();

include("include/connection.php");
include 'class/accclass.php'; 
include 'class/artClass.php'; 
include 'class/exhbtClass.php'; 

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login-register.php");
    die;
}

$exhibitManager = new artManager($conn);
$images = $exhibitManager->getUserArtworks();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="shortcut icon" href="gallery/image/vags-logo.png" type="image/x-icon">
    <title>Collaborative Artwork</title>
</head>
<body style="background-color: white;">
    <header class="head-collab">
        <h3>Be a Collaborator</h3>
    </header>

    <main>
        <div class="selectart-collab">
             <h3>Select Artworks (Maximum of 5)</h3>

             <div class="includeArt-collab">
                 <img src="files/yZDBIRPR/2b2b0cb62b723dececee9ec1e9815533.jpg" alt="">
                
             </div>

             <div class="saveCollabArt">
                <button type="submit">Submit Artworks</button>
             </div>
        </div>
       
    </main>
</body>
</html>