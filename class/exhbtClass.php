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
    
        // Decode the selected artworks (array of a_ids)
        $selectedArtworks = json_decode($selected_artworks, true);
        if ($selectedArtworks === null || empty($selectedArtworks)) {
            error_log("No artworks selected or invalid JSON.");
            return;
        }
    
        // Begin a transaction to ensure data consistency
        $this->conn->beginTransaction();
    
        try {
            // Insert the exhibit into the exhibit_tbl
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
    
            // Get the last inserted exhibit ID (exbt_id)
            $exbt_id = $this->conn->lastInsertId();
    
            // Insert each selected artwork into exhibit_artworks
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
    
            // Commit the transaction
            $this->conn->commit();
            
            header("Location: dashboard.php");
            exit;
    
        } catch (Exception $e) {
            // If something goes wrong, roll back the transaction
            $this->conn->rollBack();
            error_log("Error: " . $e->getMessage());
        }
    }
    

    public function requestCollabExhibit($exbt_title, $exbt_descrip, $exbt_date, $collaborative_artworks, $collaborators) {
        $exbt_type = 'Collab';
        $exbt_status = 'Pending';
    
        if (empty($collaborators) || empty($collaborative_artworks)) {
            error_log("Collaborators or artworks are missing for the collaboration request.");
            return;
        }
    
        // Insert exhibit details
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
    
        // Add collaborators and their artworks
        foreach ($collaborators as $index => $collab_id) {
            $artwork_id = $collaborative_artworks[$index] ?? null;
            if ($artwork_id) {
                $collabStmt = $this->conn->prepare("
                    INSERT INTO collab_exhibit (exbt_id, u_id, a_id)
                    VALUES (:exbt_id, :u_id, :a_id)
                ");
                $collabStmt->bindValue(':exbt_id', $exbt_id, PDO::PARAM_INT);
                $collabStmt->bindValue(':u_id', $collab_id, PDO::PARAM_INT);
                $collabStmt->bindValue(':a_id', $artwork_id, PDO::PARAM_INT);
                $collabStmt->execute();
            }
        }
    
        header("Location: dashboard.php#exhibitContainer");
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
                accounts.u_name AS artist_name 
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