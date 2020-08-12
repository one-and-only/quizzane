<?php

include('dbconn.php');

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$registerSQL = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
$userInfo = [
    ':username' => $username,
    ':email' => $email,
    ':password' => $password
];
$registerSQL = $pdo->prepare($registerSQL);

if ($registerSQL->execute($userInfo)) {
    header('Location: /');
    echo '<form method="GET"><input type="hidden" value="success"></form>';    //remove after done with debug
    exit();
} else {
    header('Location: /');
    echo '<form method="GET"><input type="hidden" value="failure"></form>';
    exit();
}