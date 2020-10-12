<?php
ob_start();
//$authorized = include('../loginCheck.php');
include('../includes.php');
include('../openssl.php');
$openssl = new encrypt('../openssl.php');
echo '<title>Profile | Quizzane</title>';
include('../../header.php');
ob_end_flush();

$getUserInfo = "SELECT * FROM users WHERE username = :username";
$getUserInfo = $pdo->prepare($getUserInfo);
$username = [
    ':username' => $_SESSION['username']
];

if ($getUserInfo->execute($username)) {
    $UserInfo = $getUserInfo->fetch(PDO::FETCH_ASSOC);
    $username = $UserInfo['username'];
    $email = $openssl->opensslDecryptAES256($UserInfo['email'], include('../opensslkey.php'));

    echo '
    <div align="center" style="padding-top: 2vh;">
        <form class="modal-signature-blue" style="max-width: 30vw; padding-left: 1vw; padding-right: 1vw; border-radius: 30px;">
        <div class="form-group" style="padding-top: 1vh;">
            <label for="Email">Email address</label>
            <input style="border-radius: 10px;" type="email" class="form-control" id="Email" aria-describedby="newEmail" placeholder="Email" value="'.$email.'">
        </div>
        <div class="form-group">
            <label for="Username">Username</label>
            <input style="border-radius: 10px;" type="text" class="form-control" id="Username" placeholder="Username" value="'.$username.'">
        </div>
        <div class="form-group">
            <label for="newPassword">New Password</label>
            <input style="border-radius: 10px;" type="password" class="form-control" id="newPassword">
        </div>
        <div class="form-group">
            <label for="confirmNewPassword">Confirm New Password</label>
            <input style="border-radius: 10px;" type="password" class="form-control" id="confirmNewPassword">
        </div>
        <div align="center" style="padding-bottom: 3vh;">
        <button type="submit" class="btn-signature-green">Update Account</button>
        </div>
        </form>
    </div>
    ';
}
include('../../footer.php');