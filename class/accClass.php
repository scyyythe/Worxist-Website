<?php
class AccountManager
{
    private $conn;
    
    public function __construct($db_conn)
    {
        $this->conn = $db_conn;
      
    }

  
    public function login($username, $password)
    {
        $statement = $this->conn->prepare("SELECT u_id, u_name, username, email, password, u_type FROM accounts WHERE username = :username");
        $statement->bindValue(':username', $username);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    
        if ($user && password_verify($password, $user['password'])) {
          
            $_SESSION['u_id'] = $user['u_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['u_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['u_type'] = $user['u_type'];

            $_SESSION['loggedin'] = true;
    
           
            if ($user['u_type'] === 'Admin') {
                header("Location:admin/admin.php");
            } elseif ($user['u_type'] === 'User') {
                header("Location: dashboard.php");
            } elseif ($user['u_type'] === 'Organizer') {
                header("Location: organizer.php");
            }
            die;
        } else {
            
            echo "Invalid username or password.";
        }
    }
    

   
    public function register($name, $email, $username, $password)
    {
        $accType = 'User';
        $accStatus = 'Pending';
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $statement = $this->conn->prepare("INSERT INTO accounts (u_name, email, username, password, u_type, u_status) 
                                           VALUES (:name, :email, :username, :hashed_password, :accType, :accStatus)");
        $statement->bindValue(':name', $name);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':hashed_password', $hashed_password);
        $statement->bindValue(':accType', $accType);
        $statement->bindValue(':accStatus', $accStatus);

        if ($statement->execute()) {
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['accType'] = $accType;
            $_SESSION['accStatus'] = $accStatus;
          
            header("Location: login-register.php");
            die;
        }
        return false;
    }

    public function getAccountInfo($u_id)
    {
        $sql = "SELECT * FROM accounts WHERE u_id = :u_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':u_id', $u_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function changeName($u_id, $new_name)
    {
        $sql = "UPDATE accounts SET u_name = :new_name WHERE u_id = :u_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':new_name', $new_name, PDO::PARAM_STR);
        $stmt->bindValue(':u_id', $u_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

   
    public function changePassword($u_id, $new_password)
    {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE accounts SET password = :new_password WHERE u_id = :u_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':new_password', $hashed_password, PDO::PARAM_STR);
        $stmt->bindValue(':u_id', $u_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function changeEmail($u_id, $new_email)
    {
        $sql = "UPDATE accounts SET email = :new_email WHERE u_id = :u_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':new_email', $new_email, PDO::PARAM_STR);
        $stmt->bindValue(':u_id', $u_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function changeUsername($u_id, $new_username) {
        $sql = "UPDATE accounts SET username = :new_username WHERE u_id = :u_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':new_username', $new_username, PDO::PARAM_STR);
        $stmt->bindValue(':u_id', $u_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    

    public function deleteAccount($u_id)
    {
        $sql = "DELETE FROM accounts WHERE u_id = :u_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':u_id', $u_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function uploadProfilePicture($file) {
        // Check if file is uploaded
        if ($file['error'] == 0) {
            // Create a directory for the file if it doesn't exist
            if (!is_dir('profile_pics')) {
                mkdir('profile_pics');
            }

            $fileName = $_SESSION['u_id'] . '_profile.jpg'; // Store image with user ID as name
            $filePath = 'profile_pics/' . $fileName;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                // Update the 'profile' field in the accounts table
                $statement = $this->conn->prepare("UPDATE accounts SET profile = :filePath WHERE u_id = :u_id");
                $statement->bindValue(':filePath', $filePath);
                $statement->bindValue(':u_id', $_SESSION['u_id']);
                $statement->execute();

                // Redirect to the profile page or dashboard
                header("Location: dashboard.php");
                exit;
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "No file selected or error in file upload.";
        }
    }

    // Method to remove profile picture
    public function removeProfilePicture() {
        // Remove the profile picture from the database
        $statement = $this->conn->prepare("UPDATE accounts SET profile = NULL WHERE u_id = :u_id");
        $statement->bindValue(':u_id', $_SESSION['u_id']);
        $statement->execute();

        // Optionally, remove the file from the server as well
        $filePath = 'profile_pics/' . $_SESSION['u_id'] . '_profile.jpg';
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Redirect to the profile page or dashboard
        header("Location: dashboard.php");
        exit;
    }

    
}


//upload ug image
class ArtUploader {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    private function randomString($n) {
        $characters = '0123456789abcdefghijklmnopqrstunvwxyzABCDEFGHIJKLMNOPQRSTUNVWXYZ';
        $str = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $str .= $characters[$index];
        }

        return $str;
    }

    public function uploadArtwork($file, $title, $description, $category) {
        if (!is_dir('files')) {
            mkdir('files');
        }
    
        $a_status = 'Pending';
        $u_id = $_SESSION['u_id'];
        $date = date('Y-m-d');  
        $filePath = '';
    
        if ($file && $file['tmp_name']) {
            $filePath = 'files/' . $this->randomString(8) . '/' . $file['name'];
            mkdir(dirname($filePath));
            move_uploaded_file($file['tmp_name'], $filePath);
        }
    
        $statement = $this->conn->prepare("INSERT INTO art_info (u_id, title, description, category, file, date, a_status) VALUES (:u_id, :title, :description, :category, :file, :date, :a_status)");
    
       
        $statement->bindValue(':u_id', $u_id);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':category', $category);
        $statement->bindValue(':file', $filePath);
        $statement->bindValue(':date', $date);
        $statement->bindValue(':a_status', $a_status);
    
        $result = $statement->execute();
    
        if ($result) {
            $_SESSION['title'] = $title;
            $_SESSION['description'] = $description;
            $_SESSION['category'] = $category;
            $_SESSION['file'] = $filePath;
            $_SESSION['date'] = $date;
            $_SESSION['a_status'] = $a_status;
    
            header("Location: dashboard.php");
            exit;
        }
    }
    
}




?>
