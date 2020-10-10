<?php

//stylesheets, scripts, and favicon
echo '
<!DOCTYPE html>
<link rel="stylesheet" href="src/bootstrap/css/bootstrap.min.css">
<link rel="shortcut icon" type="image/png" href="src/logos/quizzane-no-text.png">
<script src="src/bootstrap/js/jquery-3.5.1.slim.min.js"></script>
<script src="src/bootstrap/js/bootstrap.min.js"></script>
<script src="src/bootstrap/js/popper.min.js"></script>
<link rel="stylesheet" href="src/styles.css">
';
//database connection
include('src/dbconn.php');

// get all of the announcements
$getRecentAnnouncements = "SELECT * FROM announcements ORDER BY announcementDate ASC LIMIT 2";
$getRecentAnnouncements = $pdo->prepare($getRecentAnnouncements);

?>
<div style="padding-top: 2vh; text-align: center; max-width: 97vw; margin-left: auto; margin-right: auto; display: block; overflow: auto; padding-bottom: 10vh;">
<?php

if ($getRecentAnnouncements->execute()) {
    // Here we're using fetchAll() to get all records
    $announcements = $getRecentAnnouncements->fetchAll(PDO::FETCH_ASSOC);
    $announcementsText = array();
    foreach ($announcements as $announcement) {
        // Let's put the HTML directly here. No need for an extra array
    ?>
        <title>Announcements | Quizzane</title>
        <div class="jumbotron" style="background-color: #3d94ff; color: white; padding-bottom: 3vh; max-width: 97vw; border-radius: 15px; overflow: hidden;">
            <h1 class="display-4" style="font-size: 45px;"><?php echo $announcement['announcementDate']; ?></h1>
            <hr class="my-4">
            <div class="lead announcement" style="max-width: 95vw;">
                <?php 
                // We're fetching the records as assoc so use the column name to get the value
                echo $announcement['announcementText'];
                ?>
            </div>
            <hr class="my-4">
            <p>This is usually only part of the announcement. If you would like to read more, please click the button below.</p>
            <a class="btn-signature-green" href="announcements.php" style="font-size: 25px; text-decoration: none !important;" role="button">Read More</a>
        </div>
    <?php
    }
    ?>
    </div>
    <?php
}