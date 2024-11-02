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
        $statement = $this->conn->prepare("SELECT u_id, u_name, username, email, password FROM accounts WHERE username = :username");
        $statement->bindValue(':username', $username);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['u_id'] = $user['u_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['u_name'];
            $_SESSION['email'] = $user['email'];
            header("Location: dashboard.php");
            die;
        } else {
            return "Failed to login. Please try again.";
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
        $sql = "SELECT u_id, u_name, email, username, u_type, u_status FROM accounts WHERE u_id = :u_id";
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


    
}

//interaction sa image like,saved,favorites
class artInteraction {
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }
//store database
    public function addToFavorites($a_id) {
        $u_id = $_SESSION['u_id'];

        if ($this->isArtworkFavorited($u_id, $a_id)) {
            return $this->unfavoriteArtwork($a_id); 
        } else {
            $statement = $this->conn->prepare("INSERT INTO favorite (u_id, a_id) VALUES (:u_id, :a_id)");
            $statement->bindValue(':u_id', $u_id);
            $statement->bindValue(':a_id', $a_id);
            return $statement->execute();
        }
       
    }

    public function likeArtwork($a_id) {
        $u_id = $_SESSION['u_id'];

        if ($this->isArtworkLiked($u_id, $a_id)) {
            return $this->unlikeArtwork($a_id); 
        } else {
            $statement = $this->conn->prepare("INSERT INTO likes (u_id, a_id) VALUES (:u_id, :a_id)");
            $statement->bindValue(':u_id', $u_id);
            $statement->bindValue(':a_id', $a_id);
            return $statement->execute();
        }
    }

    public function saveArtwork($a_id) {
        $u_id = $_SESSION['u_id'];


        if ($this->isArtworkSaved($u_id, $a_id)) {
            return $this->unsaveArtwork($a_id); // Return true if unsaved successfully
        } else {
            $statement = $this->conn->prepare("INSERT INTO saved (u_id, a_id) VALUES (:u_id, :a_id)");
            $statement->bindValue(':u_id', $u_id);
            $statement->bindValue(':a_id', $a_id);
            return $statement->execute(); 
        }
    }

    //delete sa database once e unlike or e unsaved or wagtaong sa favorites
    public function unlikeArtwork($a_id) {
        $u_id = $_SESSION['u_id'];
        $statement = $this->conn->prepare("DELETE FROM likes WHERE u_id = :u_id AND a_id = :a_id");
        $statement->bindValue(':u_id', $u_id);
        $statement->bindValue(':a_id', $a_id);
        return $statement->execute();
    }

    public function unsaveArtwork($a_id) {
        $u_id = $_SESSION['u_id'];
        $statement = $this->conn->prepare("DELETE FROM saved WHERE u_id = :u_id AND a_id = :a_id");
        $statement->bindValue(':u_id', $u_id);
        $statement->bindValue(':a_id', $a_id);
        return $statement->execute(); 
    }

    public function unfavoriteArtwork($a_id) {
        $u_id = $_SESSION['u_id'];
        $statement = $this->conn->prepare("DELETE FROM favorite WHERE u_id = :u_id AND a_id = :a_id");
        $statement->bindValue(':u_id', $u_id);
        $statement->bindValue(':a_id', $a_id);
        return $statement->execute(); 
    }



    //tig check if na like ba sa user ang kana na artwork pwede rpd pang display
    private function isArtworkLiked($u_id, $a_id) {
        $query = "SELECT COUNT(*) FROM likes WHERE u_id = :u_id AND a_id = :a_id";
        $statement = $this->conn->prepare($query);
        $statement->bindValue(':u_id', $u_id);
        $statement->bindValue(':a_id', $a_id);
        $statement->execute();
        return $statement->fetchColumn() > 0;
    }


    private function isArtworkSaved($u_id, $a_id) {
        $query = "SELECT COUNT(*) FROM saved WHERE u_id = :u_id AND a_id = :a_id";
        $statement = $this->conn->prepare($query);
        $statement->bindValue(':u_id', $u_id);
        $statement->bindValue(':a_id', $a_id);
        $statement->execute();
        return $statement->fetchColumn() > 0; 
    }

   
    private function isArtworkFavorited($u_id, $a_id) {
        $query = "SELECT COUNT(*) FROM favorite WHERE u_id = :u_id AND a_id = :a_id";
        $statement = $this->conn->prepare($query);
        $statement->bindValue(':u_id', $u_id);
        $statement->bindValue(':a_id', $a_id);
        $statement->execute();
        return $statement->fetchColumn() > 0; 
    }

    //retrieve saved and favorties
    public function getSavedArtworks($u_id) {
        $statement = $this->conn->prepare("
            SELECT art_info.file, art_info.title, art_info.description, art_info.category, art_info.a_id, accounts.u_name, accounts.u_id
            FROM saved 
            JOIN art_info ON saved.a_id = art_info.a_id
            JOIN accounts ON art_info.u_id = accounts.u_id
            WHERE saved.u_id = :u_id
        ");
    
        $statement->bindValue(':u_id', $u_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    //retrieve favorites
    public function getFavoriteArtworks($u_id) {
        $statement = $this->conn->prepare("
            SELECT art_info.file, art_info.title, art_info.description, art_info.category, art_info.a_id, accounts.u_name, accounts.u_id
            FROM favorite 
            INNER JOIN art_info ON favorite.a_id = art_info.a_id
            INNER JOIN accounts ON art_info.u_id = accounts.u_id
            WHERE favorite.u_id = :u_id
        ");
    
        $statement->bindValue(':u_id', $u_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
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
        $filePath = '';

        if ($file && $file['tmp_name']) {
            $filePath = 'files/' . $this->randomString(8) . '/' . $file['name'];
            mkdir(dirname($filePath));
            move_uploaded_file($file['tmp_name'], $filePath);
        }

        $statement = $this->conn->prepare("INSERT INTO art_info (u_id, title, description, category, file, a_status) VALUES (:u_id, :title, :description, :category, :file, :a_status)");
        
        $statement->bindValue(':u_id', $u_id);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':category', $category);
        $statement->bindValue(':file', $filePath);
        $statement->bindValue(':a_status', $a_status);

        $result = $statement->execute();

        if ($result) {
            $_SESSION['title'] = $title;
            $_SESSION['description'] = $description;
            $_SESSION['category'] = $category;
            $_SESSION['file'] = $filePath;
            $_SESSION['a_status'] = $a_status;

            header("Location: dashboard.php");
            exit;
        }
    }
}

class ExhibitManager
{
    private $conn;
    private $u_id;

    public function __construct($db_conn)
    {
        $this->conn = $db_conn;
        $this->u_id = $_SESSION['u_id'];
    }

    public function requestSoloExhibit($exbt_title, $exbt_descrip, $exbt_date, $selected_artworks){
        $exbt_type = 'Solo';
        $exbt_status = 'Pending';

        if (!empty($selected_artworks)) {
            $selectedArtworks = json_decode($selected_artworks, true);

            foreach ($selectedArtworks as $a_id) {
                $checkStmt = $this->conn->prepare("SELECT COUNT(*) FROM art_info WHERE a_id = :a_id");
                $checkStmt->bindValue(':a_id', $a_id);
                $checkStmt->execute();
                $exists = $checkStmt->fetchColumn();

                if ($exists) {
                    $statement = $this->conn->prepare("INSERT INTO exhibit_tbl (u_id, exbt_title, exbt_descrip, exbt_date, exbt_type, exbt_status, a_id) VALUES (:u_id, :exbt_title, :exbt_descrip, :exbt_date, :exbt_type, :exbt_status, :a_id)");
                    $statement->bindValue(':u_id', $this->u_id);
                    $statement->bindValue(':exbt_title', $exbt_title);
                    $statement->bindValue(':exbt_descrip', $exbt_descrip);
                    $statement->bindValue(':exbt_date', $exbt_date);
                    $statement->bindValue(':exbt_type', $exbt_type);
                    $statement->bindValue(':exbt_status', $exbt_status);
                    $statement->bindValue(':a_id', $a_id);
                    $statement->execute();
                } else {
                    error_log("Invalid a_id: " . $a_id);
                }
            }
        } else {
            error_log("No artworks selected.");
        }
        header("Location: dashboard.php");
        exit;
    }

    public function requestCollabExhibit($exbt_title, $exbt_descrip, $exbt_date, $collaborative_artworks, $collaborators) {
        $exbt_type = 'Collab';
        $exbt_status = 'Pending';
    
        // Insert exhibit details first
        $statement = $this->conn->prepare("INSERT INTO exhibit_tbl (u_id, exbt_title, exbt_descrip, exbt_date, exbt_type, exbt_status) VALUES (:u_id, :exbt_title, :exbt_descrip, :exbt_date, :exbt_type, :exbt_status)");
        $statement->bindValue(':u_id', $this->u_id);
        $statement->bindValue(':exbt_title', $exbt_title);
        $statement->bindValue(':exbt_descrip', $exbt_descrip);
        $statement->bindValue(':exbt_date', $exbt_date);
        $statement->bindValue(':exbt_type', $exbt_type);
        $statement->bindValue(':exbt_status', $exbt_status);
        $statement->execute();
    
       
        $exbt_id = $this->conn->lastInsertId();
    
        // Insert each collaborator
        if (!empty($collaborators)) {
            foreach ($collaborators as $collab_id) {
                $collabStmt = $this->conn->prepare("INSERT INTO collab_exhibit (exbt_id, u_id, a_id) VALUES (:exbt_id, :u_id, :a_id)"); 
                $collabStmt->bindValue(':exbt_id', $exbt_id);
                $collabStmt->bindValue(':u_id', $collab_id);
                $collabStmt->bindValue(':a_id', $collaborative_artworks); 
                $collabStmt->execute();
            }
        }
    
        header("Location: dashboard.php#exhibitContainer");
        exit;
    }
    
    

    public function getUserArtworks() {
        $statement = $this->conn->prepare("
            SELECT accounts.u_id, art_info.file, accounts.u_name, art_info.a_id, art_info.title, 
                   art_info.description, art_info.category
            FROM art_info 
            JOIN accounts ON art_info.u_id = accounts.u_id
            WHERE accounts.u_id = :u_id
        ");
        $statement->bindValue(':u_id', $this->u_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function visitArtworks($userId){
        $statement = $this->conn->prepare("SELECT a_id, file, title, description, category FROM art_info WHERE u_id = :u_id");
        $statement->bindValue(':u_id', $userId); 
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllArtworks(){
        $statement = $this->conn->prepare("
            SELECT accounts.u_id,art_info.file, accounts.u_name,art_info.a_id, art_info.title, art_info.description, art_info.category
            FROM art_info 
            JOIN accounts ON art_info.u_id = accounts.u_id
        ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAcceptedExhibits(){
        $statement = $this->conn->prepare("
        SELECT exhibit_tbl.exbt_title, exhibit_tbl.exbt_descrip, art_info.title, art_info.description, art_info.file, art_info.u_id, accounts.u_name 
        FROM exhibit_tbl 
        INNER JOIN art_info ON exhibit_tbl.a_id = art_info.a_id
        INNER JOIN accounts ON art_info.u_id = accounts.u_id
        WHERE exhibit_tbl.exbt_status = 'Accepted'");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
