<?php
class ExhibitManager
{
    private $conn;
    private $u_id;

    public function __construct($db_conn)
    {
        $this->conn = $db_conn;
        $this->u_id = $_SESSION['u_id'];
    }

    public function requestSoloExhibit($exbt_title, $exbt_descrip, $exbt_date, $selected_artworks) {
        $exbt_type = 'Solo';
        $exbt_status = 'Pending';
        
        $selectedArtworks = json_decode($selected_artworks, true);
        if ($selectedArtworks === null || empty($selectedArtworks)) {
            error_log("No artworks selected or invalid JSON.");
            return;
        }
    
        $this->conn->beginTransaction();
    
        try {
           
            $statement = $this->conn->prepare("
                INSERT INTO exhibit_tbl (u_id, exbt_title, exbt_descrip, exbt_date, exbt_type, exbt_status)
                VALUES (:u_id, :exbt_title, :exbt_descrip, :exbt_date, :exbt_type, :exbt_status)
            ");
            $statement->bindValue(':u_id', $this->u_id, PDO::PARAM_INT);
            $statement->bindValue(':exbt_title', $exbt_title);
            $statement->bindValue(':exbt_descrip', $exbt_descrip);
            $statement->bindValue(':exbt_date', $exbt_date);
            $statement->bindValue(':exbt_type', $exbt_type);
            $statement->bindValue(':exbt_status', $exbt_status);
            $statement->execute();
    
            $exbt_id = $this->conn->lastInsertId();
            
            foreach ($selectedArtworks as $a_id) {
                $checkStmt = $this->conn->prepare("SELECT COUNT(*) FROM art_info WHERE a_id = :a_id");
                $checkStmt->bindValue(':a_id', $a_id, PDO::PARAM_INT);
                $checkStmt->execute();
    
                if ($checkStmt->fetchColumn()) {
                    $artworkStmt = $this->conn->prepare("
                        INSERT INTO exhibit_artworks (exbt_id, a_id)
                        VALUES (:exbt_id, :a_id)
                    ");
                    $artworkStmt->bindValue(':exbt_id', $exbt_id, PDO::PARAM_INT);
                    $artworkStmt->bindValue(':a_id', $a_id, PDO::PARAM_INT);
                    $artworkStmt->execute();
                } else {
                    error_log("Invalid artwork ID: " . $a_id);
                }
            }
    
            $this->conn->commit();
            header("Location: dashboard.php");
            exit;
    
        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("Error: " . $e->getMessage());
        }
    }
    
    public function requestCollabExhibit($exbt_title, $exbt_descrip, $exbt_date, $selected_artworks, $selected_collaborators) {
        $exbt_type = 'Collaborate';  
        $exbt_status = 'Pending';
    
        $this->conn->beginTransaction();
    
        $statement = $this->conn->prepare("
            INSERT INTO exhibit_tbl (u_id, exbt_title, exbt_descrip, exbt_date, exbt_type, exbt_status)
            VALUES (:u_id, :exbt_title, :exbt_descrip, :exbt_date, :exbt_type, :exbt_status)
        ");
        $statement->bindValue(':u_id', $this->u_id, PDO::PARAM_INT);
        $statement->bindValue(':exbt_title', $exbt_title);
        $statement->bindValue(':exbt_descrip', $exbt_descrip);
        $statement->bindValue(':exbt_date', $exbt_date);
        $statement->bindValue(':exbt_type', $exbt_type);
        $statement->bindValue(':exbt_status', $exbt_status);
    
        if (!$statement->execute()) {
            error_log("Error inserting exhibit: " . implode(", ", $statement->errorInfo()));
            $this->conn->rollBack();
            return;
        }
    
        $exbt_id = $this->conn->lastInsertId();
    

        $selectedArtworks = json_decode($selected_artworks, true);
   
            foreach ($selectedArtworks as $a_id) {
                $checkStmt = $this->conn->prepare("SELECT COUNT(*) FROM art_info WHERE a_id = :a_id");
                $checkStmt->bindValue(':a_id', $a_id, PDO::PARAM_INT);
                $checkStmt->execute();
    
                if ($checkStmt->fetchColumn()) {
                    $artworkStmt = $this->conn->prepare("
                        INSERT INTO exhibit_artworks (exbt_id, a_id)
                        VALUES (:exbt_id, :a_id)
                    ");
                    $artworkStmt->bindValue(':exbt_id', $exbt_id, PDO::PARAM_INT);
                    $artworkStmt->bindValue(':a_id', $a_id, PDO::PARAM_INT);
                    if (!$artworkStmt->execute()) {
                        error_log("Error inserting artwork into exhibit: " . implode(", ", $artworkStmt->errorInfo()));
                    }
                } else {
                    error_log("Invalid artwork ID: " . $a_id);
                }
            
        }
    
        $collaborators = explode(',', $selected_collaborators);
        foreach ($collaborators as $u_id) {
          
            $checkStmt = $this->conn->prepare("SELECT COUNT(*) FROM accounts WHERE u_id = :u_id");
            $checkStmt->bindValue(':u_id', $u_id, PDO::PARAM_INT);
            $checkStmt->execute();
    
            if ($checkStmt->fetchColumn()) {
                
                $collabStmt = $this->conn->prepare("
                    INSERT INTO collab_exhibit (exbt_id, u_id)
                    VALUES (:exbt_id, :u_id)
                ");
                $collabStmt->bindValue(':exbt_id', $exbt_id, PDO::PARAM_INT);
                $collabStmt->bindValue(':u_id', $u_id, PDO::PARAM_INT);
                if (!$collabStmt->execute()) {
                    error_log("Error inserting collaborator into exhibit: " . implode(", ", $collabStmt->errorInfo()));
                }
            } else {
                error_log("Invalid collaborator ID: " . $u_id);
            }
        }
    
        $this->conn->commit();
        header("Location: dashboard.php");
        exit;
    }
    

    
    
     
    public function getAcceptedExhibits(){
        $statement = $this->conn->prepare("
            SELECT 
                exhibit_tbl.exbt_title, 
                exhibit_tbl.exbt_descrip, 
                art_info.title AS artwork_title, 
                art_info.description AS artwork_description, 
                art_info.file AS artwork_file, 
                art_info.u_id AS artist_id, 
                accounts.u_name AS u_name 
            FROM exhibit_tbl
            INNER JOIN exhibit_artworks ON exhibit_tbl.exbt_id = exhibit_artworks.exbt_id
            INNER JOIN art_info ON exhibit_artworks.a_id = art_info.a_id
            INNER JOIN accounts ON art_info.u_id = accounts.u_id
            WHERE exhibit_tbl.exbt_status = 'Accepted'
        ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function searchCollaborators($query) {
        
        $response = [];

        if (!empty($query)) {
            $stmt = $this->conn->prepare("SELECT * FROM accounts WHERE u_name LIKE :query LIMIT 10");
            $stmt->execute(['query' => '%' . $query . '%']);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                
                foreach ($results as $collaborator) {
                    $response[] = [
                        'name' => $collaborator['u_name'],
                        'u_id' => $collaborator['u_id'],
                    ];
                }
            } else {
              
                $response[] = ['name' => 'No collaborators found.'];
            }
        }
        return json_encode($response);
    }

}
?>