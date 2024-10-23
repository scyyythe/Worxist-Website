<?php
    session_start();
    include("include/connection.php");
    include 'class/manageAcc.php'; 
    
    
    if (isset($_POST['login'])) {
        $accountManager = new AccountManager($conn);
        $username = $_POST['username'];
        $password = $_POST['password'];
        $result = $accountManager->login($username, $password);
        if ($result) {
            echo $result;
        }
    }
    
    
    if (isset($_POST['register'])) {
        $accountManager = new AccountManager($conn);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $accountManager->register($name, $email, $username, $password);
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
    <!-- Display success message -->

    <div id="validationModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modalMessage">Invalid credentials or missing fields.</p>
        </div>
    </div>
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
                <p>Already a member? <a href="#" id="show-login">Sign in</a></p>
                
            </div>
            <form method="POST" name="register">

                
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
                    <input type="email" id="email" name="email"  placeholder="Email or Phone No." required> <br>

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
                    <button type="submit" class="signup-btn" name="register">Sign Up</button>

            </div>
            </form>
        </div>
        
       
        <!-- LOGIN -->
        
        <div class="container-login" id="login-container">
            <div class="to-create">
                <p> <i id="return" class='bx bx-chevron-left'></i></p>
                <p>Not a member? <a href="" id="show-create">Sign up</a></p>
                
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
                <button type="submit" class="signin-btn" name="login">Sign In</button>

        </div>
    </form>

          
       
        <!-- end of wrapper -->
    </div>
    <script src="js/dashboard.js" ></script>
    <script>
         const errorMessage = "<?php echo $errorMessage; ?>";
         

    document.addEventListener("DOMContentLoaded", () => {
        const modal = document.getElementById("validationModal");
        const span = document.getElementsByClassName("close")[0];
        const modalMessage = document.getElementById("modalMessage");

        
        span.onclick = function() {
            modal.style.display = "none";
        };

   
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };

        
        if (errorMessage) {
            modalMessage.innerText = errorMessage;
            modal.style.display = "block"; 
        }

        // Form validation for login
        const loginForm = document.forms["login"];
        loginForm.addEventListener("submit", (e) => {
            const username = loginForm["username"].value;
            const password = loginForm["password"].value;

            if (!username || !password) {
                e.preventDefault(); 
                modalMessage.innerText = "Please enter both username and password.";
                modal.style.display = "block"; 
            }
        });
    });

    </script>
</body>
</html>