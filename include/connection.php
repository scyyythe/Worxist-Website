<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $db_name = "gallery_db";

    // Connect to the MySQL database
    $con = mysqli_connect($host, $username, $password, $db_name);

    // Check for connection errors
    if(!$con){
        die("Failed to Connect to MySQL: " . mysqli_connect_error());
    }
?>
