<?php
ob_start();
//proper DOCTYPE and html lang
echo '
<!DOCTYPE html>
<html lang="en">

<head>
';
include('src/includes.php');
//stuff for SEO
echo '
<title>Home | Quizzane</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Quizzane Homepage. Create and Join quiz games in varying categories in this familiar and exciting game format for FREE!">
';
include('header.php');

?>
<div style="padding-top: 2vh; text-align: center; max-width: 97vw; margin-left: auto; margin-right: auto; display: block; overflow: auto; padding-bottom: 10vh;">
<?php

$getLatestAnnouncements = "SELECT * FROM announcements ORDER BY announcementDateTime DESC LIMIT 1";
$getLatestAnnouncements = $pdo->prepare($getLatestAnnouncements);

if ($getLatestAnnouncements->execute()) {
    // Here we're using fetchAll() to get all records
    $announcements = $getLatestAnnouncements->fetchAll(PDO::FETCH_ASSOC);
    foreach ($announcements as $announcement) {
        // Let's put the HTML directly here. No need for an extra array
    ?>
        <title>Announcements | Quizzane</title>
        <div style="text-align: center; font-size: 25px; background-color: #67e827; color: white; border-radius: 15px;"><a>Latest Announcement</a></div>
        <!-- empty div for padding -->
        <div style="padding-bottom: 0.5vh;"></div>
        <div class="jumbotron" style="background-color: #3d94ff; color: white; padding-bottom: 2vh; padding-top: 3vh; max-width: 97vw; border-radius: 30px; overflow: hidden;">
            <h1 class="display-4" style="font-size: 30px;"><?php echo $announcement['announcementDate']; ?></h1>
            <hr class="my-4">
            <div class="lead announcement" style="max-width: 95vw;">
                <?php 
                // We're fetching the records as assoc so use the column name to get the value
                echo $announcement['announcementText'];
                ?>
            </div>
            <hr class="my-4">
            <p style="font-size: 15px;">This is usually only part of the announcement. If you would like to read more, and view more announcements, please click the button below.</p>
            <a class="btn-signature-green" href="announcements.php" style="font-size: 20px; text-decoration: none !important;" role="button">Read Announcements</a>
        </div>
    <?php
    }
    ?>
    </div>
    <?php
}

include('footer.php');
