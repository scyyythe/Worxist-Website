<?php

if (isset($_POST['interact'])){

}
if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $userId = $_POST['u_id'];  
    $artworkId = $_POST['a_id'];  
    $action = $_POST['action'];  

    try {
        
        switch ($action) {
            case 'like':
                $stmt = $pdo->prepare("INSERT INTO likes (u_id, a_id) VALUES (:u_id, :a_id)
                                       ON DUPLICATE KEY UPDATE u_id = u_id");
                break;
            case 'save':
                $stmt = $pdo->prepare("INSERT INTO saved (u_id, a_id) VALUES (:u_id, :a_id)
                                       ON DUPLICATE KEY UPDATE u_id = u_id");
                break;
            case 'favorite':
                $stmt = $pdo->prepare("INSERT INTO favorite (u_id, a_id) VALUES (:u_id, :a_id)
                                       ON DUPLICATE KEY UPDATE u_id = u_id");
                break;
            default:
                throw new Exception('Invalid action');
        }

        // Bind the parameters
        $stmt->bindParam(':u_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':a_id', $artworkId, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            echo ucfirst($action) . ' action successful!';
        } else {
            echo 'Action failed.';
        }

    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
