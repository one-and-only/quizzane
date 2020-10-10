<?php
ob_start();
include('src/includes.php');
include('header.php');
ob_end_flush();
?>
<div style="padding-top: 2vh; text-align: center; max-width: 97vw; margin-left: auto; margin-right: auto; display: block; overflow: auto; padding-bottom: 10vh;">
<?php

$getRecentAnnouncements = "SELECT * FROM announcements ORDER BY announcementDate DESC LIMIT 5";
$getRecentAnnouncements = $pdo->prepare($getRecentAnnouncements);
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
        </div>
    <?php
    }
    ?>
    </div>
    <?php
}