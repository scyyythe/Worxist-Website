<!-- PHP -->
<?php 
    session_start();
    $_SESSION;

    include("include/connection.php");
    include("include/functions.php");

     // Handle Login
     if (isset($_POST['login']))
     {
      $username = $_POST['username'];
      $password = $_POST['password'];

      if(!empty($username) && !empty($password)) {
          // Query to fetch user data
          $query = "SELECT * FROM accounts WHERE username = '$username' LIMIT 1";
          $result = mysqli_query($con, $query);

          if($result && mysqli_num_rows($result) > 0) {
              $user_data = mysqli_fetch_assoc($result);
              
              if(password_verify($password, $user_data['password'])) {
                  // Set session variables
                  $_SESSION['u_id'] = $user_data['id'];
                  $_SESSION['username'] = $user_data['username'];
              
                  // Redirect to dashboard
                  header("Location: dashboard.php");
                  die;
              } else {
                  echo "Invalid password.";
              }
              
          } else {
              echo "Invalid username.";
          }
      } else {
          echo "Please enter both username and password.";
      }
  }

    if($_SERVER['REQUEST_METHOD']== "POST"){
// somehting was posted
            $name = $_POST['name'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];


        if(!empty($name) && !empty($email) && !empty($username) && !empty($password)){
            // save to database
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // Insert user data into the database
            $query = "INSERT INTO accounts (u_name, email, username, password) VALUES ('$name', '$email', '$username', '$hashed_password')";


             // Execute the query and check for success
             if(mysqli_query($con, $query)){
                // Redirect to the login page

                header("Location: login-register.php");
              
                die;    
            }else{
                echo "Please enter some valid information";
            }
    }

    }


      
?>