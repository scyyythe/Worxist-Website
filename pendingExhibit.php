<?php
session_start();
include("include/connection.php");
include 'class/accclass.php'; 
include 'class/artClass.php'; 
include 'class/exhbtClass.php'; 
$u_id = $_SESSION['u_id']; 

$exhibitManager = new ExhibitManager($conn);
$pendingExhibits = $exhibitManager->myPendingExhibits($u_id);
$pending=$exhibitManager->getPendingExhibits();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="shortcut icon" href="gallery/image/vags-logo.png" type="image/x-icon">
    <title>Pending Exhibitst</title>
</head>
<body style="background-color: white;">
         
        <!-- Solo Exhibit Request -->
        <div id="reqExhibit-con" class="reqExhibit-con">
            <div class="top-req">
                <a style="text-decoration: none;color:red; font-weight:bold; font-size:25px;" href="dashboard.php"><</a>
                &nbsp;&nbsp;&nbsp;<h3>Pending Exhibit</h3>
            </div>


            <div id="artworkValidationModal" class="artwork-modal">
                <div class="artwork-modal-content">
                    <span class="artwork-close">&times;</span>
                    <h3>Validation Errror</h3>
                    <p>Please select at least one artwork to schedule the exhibit.</p>
                </div>
            </div>
            <?php if (empty($pending)): ?>
                    <p>You don't have pending exhibits.</p>
                <?php else: ?>     
            <div id="Solo" class="requestTab">
    <div class="exhibit-inputs">
        <form action="" name="soloExhibit" method="POST" id="soloExhibitForm">
            <label for="exhibit-title">Exhibit Title</label><br>
            <?php if (!empty($pending)): ?>
    <input type="text" name="exhibit-title" placeholder="Enter the title of your exhibit" value="<?php echo htmlspecialchars($pending[0]['exbt_title']); ?>" required><br>
<?php endif; ?>


            <label for="exhibit-description">Exhibit Description</label><br>
            <?php if (!empty($pending)): ?>
                <textarea name="exhibit-description" id="exhibit-description" placeholder="Describe the theme or story behind your exhibit" required><?php echo htmlspecialchars($pending[0]['exbt_descrip']); ?></textarea><br>
            <?php endif; ?>

            <label for="exhibit-date">Exhibit Date</label><br>
            <?php if (!empty($pending)): ?>
                <input type="date" id="exhibit-date" name="exhibit-date" value="<?php echo htmlspecialchars($pending[0]['exbt_date']); ?>" required><br>
            <?php endif; ?>
            
            <label for="type">Exhibit Type</label><br>
            <?php if (!empty($pending)): ?>
                <input type="text" id="exhibit-type" name="exhibit-type" value="<?php echo htmlspecialchars($pending[0]['exbt_type']); ?>" required disabled><br>
            <?php endif; ?>
            
            <input type="hidden" name="selected_artworks" id="selectedArtworks" required>

            <div class="update-actions">
                <button class="update-btn" id="update-btn" name="updateRequest">Save Changes</button>
                <button class="cancel-btn" id="cancel-btn" name="updateRequest">Cancel Request</button>
            </div>
        </form>

        <?php
if ($pending[0]['exbt_type'] === 'Collaborate'): ?>
    <div class="display-collaborators">
        <label for="collaborators">Collaborators</label>
        <ul>
            <?php 
                $collaborators = [];
                foreach ($pending as $exhibit) {
                    if (!empty($exhibit['collaborator_name'])) {
                        $collaborators[] = $exhibit['collaborator_name'];
                    }
                }
                $collaborators = array_unique($collaborators);
                foreach ($collaborators as $collaborator) {
                    echo "<li>" . htmlspecialchars($collaborator) . "</li>";
                }
            ?>
        </ul>
    </div>
<?php endif; ?>


    </div>

    <div class="select-art">
    <p>Selected Artworks </p>
    <div class="display-creations">
        <?php if (!empty($pending)): ?>
            <?php foreach ($pending as $image): ?>
                <div class="image-item">
                    <img style="width:400px;" src="<?php echo ($image['artwork_file']); ?>" alt="Uploaded Artwork">
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>You don't have any uploaded artworks.</p>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
</div>


        </div>
<script src="js/dashboard.js"></script>
</body>
</html>