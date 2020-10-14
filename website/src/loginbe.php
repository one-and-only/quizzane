<?php
ob_start();
include('dbconn.php');
session_name('user');
session_start();
session_regenerate_id(false);
if (!isset($_SESSION['isAuthorized']) or $_SESSION['isAuthorized'] != 'YES') {
    if ($_SESSION['isAauthorized'] = 'NO') {
        ob_end_flush();
    } else {
        echo 'Unable to set the Authorization Cookie (required for this site to function). Please disable all anti-cookie settings in your browser.';
        ob_end_flush();
        exit();
    }
}
$checkUsername = $_POST['username'];
$checkPassword = $_POST['password'];

$getPassword = "SELECT * FROM users WHERE username = :username";
$username = [
    ':username' => $checkUsername
];
$getPassword = $pdo->prepare($getPassword);

$getPassword->execute($username);
$checkAgainstPassword = $getPassword->fetch(PDO::FETCH_ASSOC);
$checkAgainstPassword = $checkAgainstPassword['password'];
if (sodium_crypto_pwhash_str_verify($checkAgainstPassword, $checkPassword)) {
    $_SESSION['username'] = $checkUsername;
    $_SESSION['isAauthorized'] = 'YES';
    $_SESSION['redirectReason'] = 'LOGIN-SUCCESS';
    ob_end_flush();
    $URL = "/";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
} else {
    $_SESSION['redirectReason'] = 'INVALID-USERPASS';
    ob_end_flush();
    $URL = "/";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}
