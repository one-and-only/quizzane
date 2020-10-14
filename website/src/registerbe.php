<?php
ob_start();
session_name('user');
session_start();
session_regenerate_id(true);
ob_end_flush();
include('openssl.php');
$openssl = new encrypt('openssl.php');
include('dbconn.php');
$username = $_POST['username'];
$email = $openssl->opensslEncryptAES256($_POST['email'], include('opensslkey.php'));
$password = sodium_crypto_pwhash_str($_POST['passwordField1'], 4, 128000000);
$st = time();
$dateSrc = new DateTime("@$st");

$registerSQL = "INSERT INTO users (username, email, password, activeSince) VALUES (:username, :email, :password, :activeSince)";
$userInfo = [
    ':username' => $username,
    ':email' => $email,
    ':password' => $password,
    ':activeSince' => $dateSrc->format('Y-m-d')
];
$registerSQL = $pdo->prepare($registerSQL);

if ($registerSQL->execute($userInfo)) {
    $_SESSION['username'] = $username;
    $_SESSION['isAuthorized'] = 'YES';
    $_SESSION['redirectReason'] = 'REGISTER-SUCCESS';
    $URL = "/";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}
else {
    if (!isset($_SESSION['isAuthorized']) or $_SESSION['isAuthorized'] != 'YES') {
        $_SESSION['isAauthorized'] = 'NO';
    }
}
