<?php
class ExhibitManager {
    private $conn;
    private $u_id;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
        $this->u_id = $_SESSION['u_id'];
    }

    public function requestSoloExhibit($exbt_title, $exbt_descrip, $exbt_date, $selected_artworks) {
        $exbt_type = 'Solo';
        $exbt_status = 'Pending';

        if (is_string($selected_artworks)) {
            $selectedArtworks = json_decode($selected_artworks, true);
            if ($selectedArtworks === null || empty($selectedArtworks)) {
                error_log("No artworks selected or invalid JSON.");
                return;
            }
        } elseif (is_array($selected_artworks)) {
            $selectedArtworks = $selected_artworks; 
        } else {
            error_log("Invalid data format for selected_artworks.");
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

            if (!$statement->execute()) {
                throw new Exception("Failed to insert into exhibit_tbl: " . implode(", ", $statement->errorInfo()));
            }

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
                    if (!$artworkStmt->execute()) {
                        throw new Exception("Failed to insert into exhibit_artworks for artwork ID $a_id: " . implode(", ", $artworkStmt->errorInfo()));
                    }
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
            header("Location: dashboard.php?error=true");  
            exit;
        }
    }

    public function requestCollabExhibit($exbt_title, $exbt_descrip, $exbt_date, $selected_artworks, $selected_collaborators) { 
        $exbt_type = 'Collaborate';  
        $exbt_status = 'Pending';
    
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
    
            if (!$statement->execute()) {
                throw new Exception("Failed to insert into exhibit_tbl: " . implode(", ", $statement->errorInfo()));
            }
    
            $exbt_id = $this->conn->lastInsertId();
    
            error_log("Selected Artworks: " . print_r($selected_artworks, true));
            $selectedArtworks = json_decode($selected_artworks, true);
            if (!empty($selectedArtworks) && is_array($selectedArtworks)) {
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
                            throw new Exception("Failed to insert into exhibit_artworks for artwork ID $a_id: " . implode(", ", $artworkStmt->errorInfo()));
                        }
                    } else {
                      
                        error_log("Invalid artwork ID: " . $a_id);
                    }
                }
            } else {
                error_log("No artworks selected or invalid format.");
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
                        throw new Exception("Failed to insert collaborator into collab_exhibit for collaborator ID $u_id: " . implode(", ", $collabStmt->errorInfo()));
                    }
                } else {
                  
                    error_log("Invalid collaborator ID: " . $u_id);
                }
            }
    
            $this->conn->commit();
            header("Location: dashboard.php");  
            exit; 
        } catch (Exception $e) {
           
            $this->conn->rollBack();
            error_log("Error: " . $e->getMessage());
            header("Location: dashboard.php?error=true");  
            exit;
        }
    }
    public function getExhibitDetails($exhibitId) {
        $statement = $this->conn->prepare("SELECT * FROM exhibit_tbl WHERE exbt_id = ?");
        $statement->bindValue(1, $exhibitId, PDO::PARAM_INT);
        $statement->execute();
    
        return $statement->fetch(PDO::FETCH_ASSOC);
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
    public function getPendingExhibits() {
        $statement = $this->conn->prepare("
            SELECT 
                exhibit_tbl.exbt_id, 
                exhibit_tbl.exbt_title, 
                exhibit_tbl.exbt_descrip, 
                exhibit_tbl.exbt_date, 
                exhibit_tbl.exbt_type, 
                accounts.u_name AS organizer_name, 
                art_info.title AS artwork_title, 
                art_info.description AS artwork_description, 
                art_info.file AS artwork_file, 
                art_info.u_id AS artist_id 
            FROM exhibit_tbl
            INNER JOIN accounts ON exhibit_tbl.u_id = accounts.u_id
            INNER JOIN exhibit_artworks ON exhibit_tbl.exbt_id = exhibit_artworks.exbt_id
            INNER JOIN art_info ON exhibit_artworks.a_id = art_info.a_id
            WHERE exhibit_tbl.exbt_status = 'Pending'
        ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    // public function getPendingExhibits() {
    //     $statement = $this->conn->prepare("
    //         SELECT 
    //             exhibit_tbl.exbt_id, 
    //             exhibit_tbl.exbt_title, 
    //             exhibit_tbl.exbt_descrip, 
    //             exhibit_tbl.exbt_date, 
    //             exhibit_tbl.exbt_type, 
    //             accounts.u_name AS organizer_name
    //         FROM exhibit_tbl
    //         INNER JOIN accounts ON exhibit_tbl.u_id = accounts.u_id
    //         WHERE exhibit_tbl.exbt_status = 'Pending'
    //     ");
    //     $statement->execute();
    //     return $statement->fetchAll(PDO::FETCH_ASSOC);
    // }
    

    
    
    
    
//search collaborators
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