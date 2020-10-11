<?php
ob_start();
include('src/includes.php');
include('header.php');
ob_end_flush();
?>
<!-- empty div for padding (top) -->
<div style="padding-bottom: 2vh;"></div>
<div style="text-align: center; font-size: 25px; background-color: #67e827; color: white; border-radius: 15px; max-width: 97vw; margin-left: auto; margin-right: auto; display: block;"><a>All Announcements</a></div>
<div style="padding-top: 2vh; text-align: center; max-width: 97vw; margin-left: auto; margin-right: auto; display: block; overflow: auto; padding-bottom: 10vh;">
<?php

$getRecentAnnouncements = "SELECT * FROM announcements ORDER BY announcementDateTime DESC LIMIT 5";
$getRecentAnnouncements = $pdo->prepare($getRecentAnnouncements);
if ($getRecentAnnouncements->execute()) {
    // Here we're using fetchAll() to get all records
    $announcements = $getRecentAnnouncements->fetchAll(PDO::FETCH_ASSOC);
    $announcementsText = array();
    foreach ($announcements as $announcement) {
        // Let's put the HTML directly here. No need for an extra array
    ?>
        <title>Announcements | Quizzane</title>
        <div class="jumbotron" style="background-color: #3d94ff; color: white; padding-bottom: 3vh; padding-top: 3vh; max-width: 97vw; border-radius: 30px; overflow: hidden;">
            <h1 class="display-4" style="font-size: 30px;"><?php echo $announcement['announcementDate']; ?></h1>
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