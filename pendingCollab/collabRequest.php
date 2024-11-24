<?php
session_start();
include("../include/connection.php");
include '../class/accclass.php'; 
include '../class/artClass.php'; 
include '../class/exhbtClass.php'; 
$u_id = $_SESSION['u_id']; 

$exhibit = new ExhibitManager($conn);
$pendingExhibits = $exhibit->myPendingExhibits($u_id);
$pending=$exhibit->getPendingExhibits();

if (isset($_GET['id'])) {
    $exhibit= new ExhibitManager($conn);
    $exhibitId = $_GET['id'];
    $pendingDetails = $exhibit->getExhibitDetails
    ($exhibitId);

    header('Content-Type: application/json');
    if ($pendingDetails) {
        echo json_encode($pendingDetails);
    } else {
        echo json_encode(['error' => 'Exhibit not found']);
    }

    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/gallery/image/vags-logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>Pending Exhibit for Collab Request</title>
</head>
<body>
    <section class="container">
        <div class="header">
        <a style="text-decoration: none;color:black; font-weight:bold; font-size:25px;" href="/dashboard.php"><</a>
            <span class="title">Pending Exhibit</span>
        </div>
        <div class="tabs">
            <h4 class="tab collaborative active">Collaborative</h4>
        </div>
        <div class="wrapper">
            <div class="form">
                <div class="form-group">
                    <label for="exhibit-title">Exhibit Title</label>
                    <div class="input-field">
                        <i class='bx bxs-pencil'></i>
                        <?php if (!empty($pending)): ?>
    <input disabled type="text" name="exhibit-title" placeholder="Enter the title of your exhibit" value="<?php echo htmlspecialchars($pending[0]['exbt_title']); ?>" required><br>
<?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exhibit-description">Exhibit Description</label>
                    <div class="input-field1">
                        <i class='bx bxs-pencil'></i>
                        <?php if (!empty($pending)): ?>
                <textarea disabled name="exhibit-description" id="exhibit-description" placeholder="Describe the theme or story behind your exhibit" required><?php echo htmlspecialchars($pending[0]['exbt_descrip']); ?></textarea><br>
            <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exhibit-date">Exhibit Date</label>
                    <div class="input-field">
                            <i class='bx bxs-pencil'></i>
                        <div class="date-picker">
                        <?php if (!empty($pending)): ?>
                <input type="date" id="exhibit-date" name="exhibit-date" value="<?php echo htmlspecialchars($pending[0]['exbt_date']); ?>" required><br>
            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <img src="pics/graphic.png" class="graphic">
            </div>

            <div class="artworks">
                <div class="admin">
                    <h4>Your Artworks</h4>
                    <div class="admin-card">
                        <div class="art-collage">
                            <div class="artworks">
                                <img src="pics/a1.jpg" class="art1">
                                <img src="pics/a3.jpg" class="art2">
                            </div>
                            <div class="artwork">
                                <img src="pics/a2.jpg" alt="Art 3">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="collaborators">
        <h2>Collaborators</h2>
        <div class="collaborator-cards" id="collaborators-cards">
        
        <?php 
        $collaborators = [];
        foreach ($pending as $exhibit) {
            if (!empty($exhibit['collaborator_name'])) {
                $collaborators[] = $exhibit['collaborator_name'];
            }
        }
        $collaborators = array_unique($collaborators);
        foreach ($collaborators as $collaborator) {
            // Get the first name (before the first space)
            $firstName = explode(' ', $collaborator)[0];
            
            echo "<div class='collab-details'>";
            echo "<p class='collab-name1' id='collab_name'>" . htmlspecialchars($firstName) . "</p>";
            
            echo "<div class='collaborator'>
                    <div class='art-collage'>
                        <div class='c-artworks'>
                            <img src='pics/a1.jpg' alt='Art 1'>
                            <img src='pics/a3.jpg' alt='Art 2'>
                        </div>
                        <div class='c-artwork'>
                            <img src='pics/a2.jpg' alt='Art 3'>
                        </div>
                    </div>
                  </div>";
            echo "</div>";
        }
    ?>            
        
        </div>
    </div>


            </div>

            <!-- Modal -->
            <div class="modal" id="image-modal">
                <button class="nav-btn left-btn">&lt;</button>
                <button class="nav-btn right-btn">&gt;</button>
                <div class="modal-content">
                    <img src="" class="modal-image">
                    <div class="replace-container">
                        <div class="replace-text">Replace</div>
                        <input type="file" id="replace-input" accept="image/*" style="display: none;">
                    </div>
                </div>
            </div>
            
            <div class="footer">
                <p>Wait for the organizer to approve your exhibit</p>
            </div>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>