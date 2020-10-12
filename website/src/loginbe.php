<?php
ob_start();
include('dbconn.php');
session_name('user');
session_start();
session_regenerate_id(false);
if (!isset($_SESSION['isAuthorized']) or $_SESSION['isAuthorized'] != 'YES') {
    if ($_SESSION['isAauthorized'] = 'NO') {
        echo 'Set Auth Var';
        ob_end_flush();
    } else {
        echo 'Unable to set Authorization Cookie (required for this site to function). Please disable all anti-cookie settings in your browser.';
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
    ob_end_flush();
    $URL = "/";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
} else {
    echo 'Invalid Username and Password Combination. Redirecting...<br>';
    ob_end_flush();
    $URL = "/";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}
