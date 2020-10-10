<?php
include('dbconn.php');

$insertAnnouncement = "INSERT INTO announcements (announcementText, announcementDate) VALUES (:announcementText, :announcementDate)";

$st = time();
$dateSrc = new DateTime("@$st");

$params = [
    ':announcementText' => $_POST['announcement'],
    ':announcementDate' => $dateSrc->format('Y-m-d')
];

$insertAnnouncement = $pdo->prepare($insertAnnouncement);

if ($insertAnnouncement->execute($params)) {
    $URL = '/src/announcementGenerator.html';
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}
else {
    echo "Unable to generate announcement :(";
}