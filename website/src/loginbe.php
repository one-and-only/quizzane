<?php
ob_start();
include('dbconn.php');
session_name('user');
session_start();
session_regenerate_id(false);
if (!isset($_COOKIE['auth'])) {
    if (setcookie('auth', sodium_crypto_pwhash_str('NO', 2, 67108864))) {
        echo 'Set Auth Cookie';
        ob_end_flush();
    } else {
        echo 'Unable to set Authorization cookie (required for this site to function). Please disable all anti-cookie settings in your browser.';
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
    setcookie('auth', sodium_crypto_pwhash_str('YES', 2, 67108864));
    ob_end_flush();
    $URL = "/";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
} else {
    echo 'Invalid Username and Password Combination. Redirecting...<br>';
    ob_end_flush();
    $URL = "/";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}
