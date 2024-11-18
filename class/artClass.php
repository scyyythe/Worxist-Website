<?php 
class artManager
{
    private $conn;
    private $u_id;

    public function __construct($db_conn)
    {
        $this->conn = $db_conn;
        $this->u_id = $_SESSION['u_id'];
    }


    public function updateArtwork($a_id, $title, $description, $category) {
        $statement = $this->conn->prepare("
            UPDATE art_info 
            SET title = :title, description = :description, category = :category 
            WHERE a_id = :a_id
        ");
        $statement->bindValue(':a_id', $a_id);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':category', $category);
        return $statement->execute();
    }


    public function deleteArtwork($a_id) {
        $statement = $this->conn->prepare("
            DELETE FROM art_info 
            WHERE a_id = :a_id
        ");
        $statement->bindValue(':a_id', $a_id);
        return $statement->execute();
    }
    public function getArtworkById($artworkId) {
        $statement = $this->conn->prepare("
            SELECT art_info.file, art_info.title, art_info.description, art_info.category
            FROM art_info
            WHERE art_info.a_id = :a_id
        ");
        $statement->bindValue(':a_id', $artworkId);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getUserArtworks() {
        $statement = $this->conn->prepare("
            SELECT 
                accounts.u_id, 
                art_info.file, 
                accounts.u_name, 
                art_info.a_id, 
                art_info.title, 
                art_info.description,
                art_info.date, 
                art_info.category,
                COALESCE(COUNT(DISTINCT likes.u_id), 0) AS likes_count,
                COALESCE(COUNT(DISTINCT saved.u_id), 0) AS saved_count,
                COALESCE(COUNT(DISTINCT favorite.u_id), 0) AS favorites_count
            FROM art_info 
            JOIN accounts ON art_info.u_id = accounts.u_id
            LEFT JOIN likes ON art_info.a_id = likes.a_id
            LEFT JOIN saved ON art_info.a_id = saved.a_id
            LEFT JOIN favorite ON art_info.a_id = favorite.a_id
            WHERE accounts.u_id = :u_id
            GROUP BY art_info.a_id
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
    
    public function getAllArtworks($category = null) {
        $query = "
            SELECT 
                accounts.u_id, 
                art_info.file, 
                accounts.u_name, 
                art_info.a_id, 
                art_info.title, 
                art_info.description, 
                art_info.date, 
                art_info.category,
                COALESCE(COUNT(DISTINCT likes.u_id), 0) AS likes_count,
                COALESCE(COUNT(DISTINCT saved.u_id), 0) AS saved_count,
                COALESCE(COUNT(DISTINCT favorite.u_id), 0) AS favorites_count
            FROM art_info
            JOIN accounts ON art_info.u_id = accounts.u_id
            LEFT JOIN likes ON art_info.a_id = likes.a_id
            LEFT JOIN saved ON art_info.a_id = saved.a_id
            LEFT JOIN favorite ON art_info.a_id = favorite.a_id
        ";
    
        if ($category) {
            $query .= " WHERE art_info.category = :category";
        }
    
        $query .= " GROUP BY art_info.a_id";
    
        $statement = $this->conn->prepare($query);
        if ($category) {
            $statement->bindParam(':category', $category);
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

}
?>