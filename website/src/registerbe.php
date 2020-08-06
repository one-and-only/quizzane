<?php 

include('dbconn.php');

$_POST['password'] = $password;
$passwordHASHED = password_hash($password, PASSWORD_ARGON2I);
$_POST['email'] = $email;
$_POST['username'] = $username;

$registerSQL = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
$registerSQL = $pdo->prepare($registerSQL);
$userInfo = [
    ':username' => $username,
    ':email' => $email,
    ':password' => $passwordHASHED
];

if ($registerSQL->execute($userInfo)) {
    header(localhost);
    exit("Registered Successfully");
}
else {
    header(localhost);
    exit("An Unknown Error Occured While Registering");
}

?>