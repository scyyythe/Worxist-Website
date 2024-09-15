<?php 
// Include the connection script
include('connection.php');

// Get form data using POST method
$name = $_POST['name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare and bind the SQL statement
$state = $con->prepare("INSERT INTO `accounts` (accountName, accountEmail, accountUser, accountPass) VALUES (?, ?, ?, ?)");

// Check if the statement was successfully prepared
if ($state === false) {
    die("Error in preparing statement: " . $con->error);
}

// Bind the variables to the statement
$state->bind_param("ssss", $name, $email, $username, $password);


if($state->execute()){
    echo "Registered Successfully";

} else {
    echo "Error: " . $state->error;
}

// Close the statement and connection
$state->close();
$con->close();
?>
