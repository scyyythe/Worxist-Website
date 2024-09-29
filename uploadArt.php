<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="image/vags-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/upload.Art.css">
    <title>Upload Artwork</title>
</head>
<body>
    <header>
        <p class="return" onclick="returnArt()"><</p>
        <h2>Upload Artwork</h2>
    </header>
    <div class="container">  

    <!-- input artwork details -->
    <div class="artwork-upload">
        <form action="">
            
            <label for="title"><b>Title</b></label><br>
            <input type="text" name="title" id="title"><br>

            <label for="description-of-artwork"><b>Description</b></label><br>
            <textarea name="description" id="description"></textarea><br>

            
            <label for="title"><b>Category</b></label><br>
            <select name="category" id="category">
                <option value="sculpture">Sculpture</option>
                <option value="painting">Painting</option>
                <option value="">Sculpture</option>
                <option value="painting">Painting</option>
            </select>
            <br><br>

            <button>Upload Artwork</button>
        </form>
    </div>
    
    <!-- display image -->
    <div class="image-upload">
        <div class="image-display">
            <img src="gallery/eyes.jpg" alt="">
        </div>    
        <input type="file">

    </div>  
        
    </div>

    <script>
        function returnArt() {
    window.location.href = 'dashboard.php';
    }
    </script>
</body>
</html>