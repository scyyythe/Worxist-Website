<?php

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['requestSolo'])) {
    $u_id = $_SESSION['u_id'];
    $exbt_title = $_POST['exhibit-title'];
    $exbt_descrip = $_POST['exhibit-description'];
    $exbt_date = $_POST['exhibit-date'];
    $exbt_type = 'Solo'; 
    $exbt_status = 'Pending'; 

   
    if (!empty($_POST['selected_artworks'])) {
        $selectedArtworks = json_decode($_POST['selected_artworks'], true);
        error_log("Selected Artworks: " . json_encode($selectedArtworks));
        
        foreach ($selectedArtworks as $a_id) {
            
            $checkStmt = $conn->prepare("SELECT COUNT(*) FROM art_info WHERE a_id = :a_id");
            $checkStmt->bindValue(':a_id', $a_id);
            $checkStmt->execute();
            $exists = $checkStmt->fetchColumn();

            if ($exists) {
               
                $statement = $conn->prepare("INSERT INTO exhibit_tbl (u_id, exbt_title, exbt_descrip, exbt_date, exbt_type, exbt_status, a_id) VALUES (:u_id, :exbt_title, :exbt_descrip, :exbt_date, :exbt_type, :exbt_status, :a_id)");
                $statement->bindValue(':u_id', $u_id);
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

    // Redirect to the dashboard
    header("Location: dashboard.php");
    exit;
}


    if (isset($_POST['requestCollab'])){
        $result = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            $u_id = $_SESSION['u_id'];
            $exbt_status='Pending';
            $exbt_type='Collab';

            $exhibit_title=$_POST['exhibit-title']; 
            $exhibit_description=$_POST['exhibit-description'];
            $exhibit_date=$_POST['exhibit-date'];

            $statement=$conn->prepare("INSERT INTO exhibit_tbl (u_id,exbt_title,exbt_descrip,exbt_date,exbt_type,exbt_status)VALUES
            (:u_id,:exbt_title,:exbt_descrip,:exbt_date,:exbt_type, :exbt_status)");

            $statement->bindValue(':u_id', $u_id);
            $statement->bindValue(':exbt_title', $exhibit_title);
            $statement->bindValue(':exbt_descrip', $exhibit_description);
            $statement->bindValue(':exbt_date', $exhibit_date);
            $statement->bindValue(':exbt_type', $exbt_type);
            $statement->bindValue(':exbt_status', $exbt_status);

            $result = $statement->execute();

            if ($result) {
                $_SESSION['u_id'] = $u_id;
                $_SESSION['exbt_title'] =  $exhibit_title;
                $_SESSION['exbt_descrip'] =  $exhibit_description;
                $_SESSION['exbt_date'] = $exhibit_date;
                $_SESSION['exbt_type'] = $exbt_type;
                $_SESSION['exbt_status'] =  $exbt_status;

                header("Location: dashboard.php#exhibitContainer");
                die;
            }
        
        }
    }
?>