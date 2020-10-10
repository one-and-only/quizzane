<?php
ob_start();
session_name('user');
session_start();
session_regenerate_id(true);
include('openssl.php');
$openssl = new encrypt('openssl.php');
include('dbconn.php');
$username = $_POST['username'];
$email = $openssl->opensslEncryptAES256($_POST['email'], include('opensslkey.php'));
$password = sodium_crypto_pwhash_str($_POST['passwordField1'], 4, 128000000);

$registerSQL = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
$userInfo = [
    ':username' => $username,
    ':email' => $email,
    ':password' => $password
];
$registerSQL = $pdo->prepare($registerSQL);
$registerSQL->execute($userInfo);
$_SESSION['username'] = $username;
setcookie('auth', sodium_crypto_pwhash_str('YES', 2, 67108864));
$URL = "/";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
