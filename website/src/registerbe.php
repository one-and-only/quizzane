<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('dbconn.php');

$_POST['passwordField1'] = $password;
$passwordHASHED = password_hash($password, PASSWORD_BCRYPT);
$email = $_POST['email'];
$username = $_POST['username'];

$registerSQL = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
$registerSQL = $pdo->prepare($registerSQL);
$userInfo = [
    ':username' => $username,
    ':email' => $email,
    ':password' => $passwordHASHED
];

if ($registerSQL->execute($userInfo)) {
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    header('localhost');
}
else {
    header('localhost');
}

?>