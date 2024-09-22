<?php 
session_start();
    $_SESSION;

    include("include/connection.php");

    $result = [];
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // something was posted
        $accType = 'User';
        $accStatus = 'Pending';

        // Get data from text fields
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
                    
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $statement = $conn->prepare("INSERT INTO accounts (u_name, email, username, password, u_type, u_status) VALUES (:name, :email, :username, :hashed_password, :accType, :accStatus)");

        $statement->bindValue(':name', $name);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':hashed_password', $hashed_password);
        $statement->bindValue(':accType', $accType);
        $statement->bindValue(':accStatus', $accStatus);

        $result = $statement->execute();

        if ($result) {
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $name; 
            $_SESSION['email'] = $email;
            $_SESSION['accType'] = $accType;
            $_SESSION['accStatus'] = $accStatus;

           
            header("Location: login.php");  
            die;
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

    <title>Worxist Register</title>
</head>
<body>
    <div class="wrapper" id="wrapper">
   
          <!-- Right Image -->
          <div class="overlay-container-c" id="overlay-container">
            
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


        <!-- CREATE ACCOUNT -->
        <div class="form-container" id="form-container">
        

            <div class="to-login">
                <p> <i id="left" class='bx bx-chevron-left'></i></p>
                <p>Already a member? <a href="login.php" id="show-login">Sign in</a></p>
                
            </div>


            <?php if($result):?>
                <div class="alert-sucess">
                    <?php echo "Created Successfully" ?>
                </div>

            <?php endif ?>
            <form action="" method="POST" name="register">

                
                    <div class="create">
                          <h2>Create Account</h2>
                    </div>
                
                    <div class="login-withAccounts">
                        <button><i class='bx bxl-google'></i>&nbsp;Sign up with Google</button>
                        <button><i class='bx bxl-facebook-circle' ></i>&nbsp;with Facebook</button>
                    </div>
                 
        <div class="fields">
            <div class="input-form">   
                    <span class="line"></span>
                    <p>Or sign up using your email address</p><br>
                   
                     <label for="name">Name</label><br>
                    <input type="text" id="name" name="name" placeholder="Name" required><br>

                    <label for="email">Email or Phone no</label> <br>
                    <input type="text" id="email" name="email"  placeholder="Email or Phone No." required> <br>

                    <label for="username">Username</label> <br>
                    <input type="text" id="username" name="username"  placeholder="Username" required> <br>

                    <label for="password">Password</label><br>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                   
                    <div class="terms">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">I agree to all terms and Privacy Policy</label>
                    </div>
                    <br>
                    <button type="submit" class="signup-btn">Sign Up</button>

            </div>
            </form>

        </div>
         
        <!-- end of wrapper -->
    </div>
    <script src="js/script.js" ></script>

</body>
</html>