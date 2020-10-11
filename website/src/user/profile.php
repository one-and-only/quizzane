<?php
ob_start();
include('../includes.php');
include('../openssl.php');
$openssl = new encrypt('../openssl.php');

$getUserInfo = "SELECT * FROM users WHERE username = :username";
$getUserInfo = $pdo->prepare($getUserInfo);
$username = [
    ':username' => $_SESSION['username']
];

if ($getUserInfo->execute($username)) {
    $UserInfo = $getUserInfo->fetch(PDO::FETCH_ASSOC);
    $username = $UserInfo['username'];
    $email = $openssl->opensslDecryptAES256($UserInfo['email'], include('../opensslkey.php'));
    echo "Email: $email<br>";
    echo "Username: $username<br>";
}