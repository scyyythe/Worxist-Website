<?php
session_start();

include("include/connection.php");
include 'class/accclass.php'; 
include 'class/artClass.php'; 
include 'class/exhbtClass.php'; 

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login-register.php");
    die;
}

$exhibitManager = new artManager($conn);
$collabImages = $exhibitManager->getUserArtworks();

if (isset($_GET['exbt_id']) && isset($_SESSION['u_id'])) {
    $exbt_id = $_GET['exbt_id']; 
    $u_id = $_SESSION['u_id'];  

    $checkCollabQuery = "SELECT * FROM `collab_exhibit` WHERE `exbt_id` = :exbt_id AND `u_id` = :u_id";
    $stmt = $conn->prepare($checkCollabQuery);
    $stmt->bindValue(':exbt_id', $exbt_id, PDO::PARAM_INT);
    $stmt->bindValue(':u_id', $u_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        
        $checkStatusQuery = "SELECT `exbt_status` FROM `exhibit_tbl` WHERE `exbt_id` = :exbt_id";
        $stmtStatus = $conn->prepare($checkStatusQuery);
        $stmtStatus->bindValue(':exbt_id', $exbt_id, PDO::PARAM_INT);
        $stmtStatus->execute();
        $status = $stmtStatus->fetchColumn();
    }

    if (isset($_POST['selected_artworks_collab'])) {
        $selectedArtworks = json_decode($_POST['selected_artworks_collab'], true);

        if (empty($selectedArtworks)) {
            echo 'No artworks selected.';
        } else {
            $exhibitManager = new ExhibitManager($conn);
            foreach ($selectedArtworks as $a_id) {
                $result = $exhibitManager->addArtworkToExhibit($exbt_id, $a_id);
                echo $result . "<br>"; 
            }
        }
    }
} else {
    echo 'Exhibit ID or user not found.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="shortcut icon" href="gallery/image/vags-logo.png" type="image/x-icon">
    <title>Collaborative Artwork</title>
</head>
<body style="background-color: white;">
    <header class="head-collab">
        <h3>Be a Collaborator</h3>
    </header>

    <main>
        <?php if (isset($status) && $status =='Approved'): ?>
            <p class="displayAlertCollab">You already have an on going exhibit.</p>
        <?php else: ?>
            <form action="" name="submitArtCollab" method="POST" id="submitArtCollab">
                <input type="hidden" id="selectedArtworksCollab" name="selected_artworks_collab" value="[]">
                <input type="hidden" id="selectedArtworks" name="selected_artworks" value="[]">

                <div class="saveCollabArt">
                    <button type="submit">Submit Artworks</button>
                </div>
            </form>

            <div class="selectart-collab">
                <h3>Select Artworks (Maximum of 5)</h3>
                <div class="includeArt-collab">
                    <?php if (!empty($collabImages)): ?>
                        <?php foreach ($collabImages as $image): ?>
                            <div class="image-itemColab">
                                <img class="imgCollab" 
                                     src="<?php echo ($image['file']); ?>" 
                                     alt="Collaborative Artwork" 
                                     data-id="<?php echo ($image['a_id']); ?>">
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No collaborative artworks available.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const maxSelection = 5;
        const selectedArtworks = new Set(); 

        document.querySelectorAll('.imgCollab').forEach((img) => {
            img.addEventListener('click', function () {
                const artworkId = img.dataset.id;
                if (selectedArtworks.has(artworkId)) {
                    selectedArtworks.delete(artworkId);
                    img.classList.remove('selected');
                } else {
                    if (selectedArtworks.size < maxSelection) {
                        selectedArtworks.add(artworkId);
                        img.classList.add('selected');
                    } else {
                        alert('You can only select up to 5 artworks.');
                        return;
                    }
                }
                document.getElementById('selectedArtworksCollab').value = JSON.stringify([...selectedArtworks]);
            });
        });
    });
    </script>
</body>
</html>
