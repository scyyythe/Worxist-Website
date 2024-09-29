
<?php 
    session_start();
    $_SESSION;

    include("include/connection.php");

     // Handle Login
     if (isset($_POST['login']))
     {
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
  }
  if (isset($_POST['register'])){
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

         
          header("Location: login-register.php");  
          die;
      }
  }
  }
  


      
?>