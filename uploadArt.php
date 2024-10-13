<?php

include("include/connection.php");
include("include/addArtwork.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="image/vags-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/uploadArt.css">
    <title>Upload Artwork</title>
</head>
<body>
    <header>
        <div class="return">
             <p class="return" onclick="returnArt()"><</p>
        </div>

        <div class="display-header">
            <h4>Post Artwork</h2>
            <div id="date-time-display"></div>
        </div>
        
       
 
    </header>


    <div class="container">  
    <!-- input artwork details -->
    <div class="artwork-upload">
        <form action="" method="POST" name="uploadArt" enctype="multipart/form-data">
           
            <label for="title"><b>Title</b></label><br>
            <input type="text" name="title" id="title" class="title" placeholder="Add a Title"><br>

            <label for="description-of-artwork"><b>Description</b></label><br>
            <textarea name="description" id="description" placeholder="Add a Description"></textarea><br>

            
            <label for="title"><b>Category</b></label><br>
            <select name="category" id="category">
                <option value="Sculpture">Sculpture</option>
                <option value="Painting">Painting</option>
                <option value="Sketches">Sketches</option>
                <option value="Expressionism">Expressionism</option>
            </select>
            <br><br>

            <div class="image-upload">
                
                <div class="image-display">
                    <img id="uploadedImage" src="" alt="Uploaded Image" class="hidden">
                   
                </div>    
                <label class="custom-file-upload">
                    <input type="file" name="file" class="choose" accept="image/*">
                    Choose a file
                </label>
                
            </div> 
            <button name="uploadArt">Upload Artwork</button>
        </form>
    </div>
    
    <!-- display image -->
 
        
    </div>

    <script>
        function returnArt() {
    window.location.href = 'dashboard.php';
    }

    // display chosen image/file
document.querySelector('.choose').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const imageDisplay = document.getElementById('uploadedImage');

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            imageDisplay.src = e.target.result; 
            imageDisplay.classList.remove('hidden'); 
            setTimeout(() => {
                imageDisplay.classList.add('show'); 
            }, 100); 
        }

        reader.readAsDataURL(file); 
    }
});

// live date and time 
    function updateDateTime() {

    const dateTimeDisplay = document.getElementById("date-time-display");
    const now = new Date(); 

            //  date formatting
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        const date = now.toLocaleDateString('en-US', options);
        const time = now.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }); 

            dateTimeDisplay.textContent = `${date} | ${time}`; 
        }

        updateDateTime();
        setInterval(updateDateTime, 60000); 

    </script>

</body>
</html>