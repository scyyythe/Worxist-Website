<?php
session_start();
include("include/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user from the database based on the username
    $statement = $conn->prepare("SELECT u_id, u_name, username, password FROM accounts WHERE username = :username");
    $statement->bindValue(':username', $username);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Set session variables on successful login
        $_SESSION['u_id'] = $user['u_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['name'] = $user['u_name'];  // Set the 'name' session variable
        header("Location: dashboard.php");
        die;
    } else {
        echo "Invalid credentials";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/accountLgin.css">
    <link rel="shortcut icon" href="image/vags-logo.png" type="image/x-icon">

    <title>Worxist Login</title>
</head>
<body>
    <div class="wrapper" id="wrapper">
   
          <!-- Right Image -->
          <div class="overlay-container-login" id="overlay-container">
            
            <div class="name">
                <p><span>W</span>orxist</p>
           </div>
                    <div class="circle">
                </div>
                <div class="zues">
                        <img src="image/greek god (1).png" alt="zeus">  
                </div>  
        </div>

        <!-- LOGO -->
        <div class="logo">
            <img src="image/vags-logo.png" alt="Worxist Logo">
        </div>

       
        <!-- LOGIN -->

        <div class="container-login" id="login-container">
            <div class="to-create">
                <p> <i id="return" class='bx bx-chevron-left'></i></p>
                <p>Not a member? <a href="register.php" id="show-create">Sign up</a></p>
                
            </div>
            <form method="POST" class="login-form" name="login">
            
                <div class="welcome">
                      <h1>Welcome Back!</h1>
                </div>
    
                <div class="login-withAccounts">
                    <button><i class='bx bxl-google'></i>&nbsp;Sign up with Google</button>
                    <button><i class='bx bxl-facebook-circle' ></i>&nbsp;with Facebook</button>
                </div>
              
    <div class="fields">
        <div class="input-form">   
            <div class="separator">
                <span></span>
                <p>or</p>
                <span></span>
            </div>
            
                <label for="username">Username</label> <br>
                <input type="text" id="username" name="username"  placeholder="Username" required> <br>

                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
               
                <div class="terms">
                    <input type="checkbox" id="terms" required>
                    <label for="Remember">Remember me</label>
                </div>
                <br>
                <button type="submit" class="signin-btn">Sign In</button>

        </div>
    </form>

          
       
        <!-- end of wrapper -->
    </div>
    <script src="js/script.js" ></script>

</body>
</html>