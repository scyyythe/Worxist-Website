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

    public function requestSoloExhibit($exbt_title, $exbt_descrip, $exbt_date, $selected_artworks)
    {
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

    public function requestCollabExhibit($exbt_title, $exbt_descrip, $exbt_date)
    {
        $exbt_type = 'Collab';
        $exbt_status = 'Pending';

        $statement = $this->conn->prepare("INSERT INTO exhibit_tbl (u_id, exbt_title, exbt_descrip, exbt_date, exbt_type, exbt_status) VALUES (:u_id, :exbt_title, :exbt_descrip, :exbt_date, :exbt_type, :exbt_status)");
        $statement->bindValue(':u_id', $this->u_id);
        $statement->bindValue(':exbt_title', $exbt_title);
        $statement->bindValue(':exbt_descrip', $exbt_descrip);
        $statement->bindValue(':exbt_date', $exbt_date);
        $statement->bindValue(':exbt_type', $exbt_type);
        $statement->bindValue(':exbt_status', $exbt_status);
        $statement->execute();

        header("Location: dashboard.php#exhibitContainer");
        exit;
    }

    public function getUserArtworks()
    {
        $statement = $this->conn->prepare("SELECT a_id, file, title, description, category FROM art_info WHERE u_id = :u_id");
        $statement->bindValue(':u_id', $this->u_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllArtworks()
    {
        $statement = $this->conn->prepare("
            SELECT accounts.u_id,art_info.file, accounts.u_name, art_info.title, art_info.description, art_info.category
            FROM art_info 
            JOIN accounts ON art_info.u_id = accounts.u_id
        ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAcceptedExhibits()
    {
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
