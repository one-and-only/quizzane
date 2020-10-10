<?php
ob_start();
include('src/dbconn.php');
session_name('user');
session_start();
ob_end_flush();

function redirectToJoin() {
    $URL = 'join.php';
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

$getCode = "SELECT * FROM games WHERE gameCode = :gameCode";
$gameCode = [
    ':gameCode' => $_GET['code']
];
$getCode = $pdo->prepare($getCode);

if ($getCode->execute($gameCode)) {
    if ($getCode->rowCount() == 1) {
        echo "do stuff that gets the user into the game with the right game code";
    }
    elseif ($getCode->rowCount() > 1) {
        $_SESSION['redirectReason'] = 'DUPLICATE-GAMECODE';
        $_SESSION['toPage'] = 'join';
        redirectToJoin();
    }
    elseif ($getCode->rowCount() == 0) {
        $_SESSION['redirectReason'] = 'GAME-NOT-FOUND';
        $_SESSION['toPage'] = 'join';
        redirectToJoin();
    }
}
else {
    $_SESSION['redirectReason'] = 'UNKNOWN-ERROR';
    $_SESSION['toPage'] = 'join';
    redirectToJoin();
}