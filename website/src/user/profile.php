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
    <script>
        $(window).on("load", function() {
            document.getElementById("updateAccountButton").disabled = true;
            $("#updateAccountForm :input").change(function() {
                document.getElementById("updateAccountButton").disabled = false;
            });
        });
    </script>

    <div align="center" style="padding-top: 2vh;">
        <form action="updateAccount.php" method="POST" class="modal-signature-blue" id="updateAccountForm" style="max-width: 30vw; padding-left: 1vw; padding-right: 1vw; border-radius: 30px;">
        <div class="form-group" style="padding-top: 1vh;">
            <label for="Email">Email address</label>
            <input style="border-radius: 10px;" type="text" name="email" class="form-control" id="Email" aria-describedby="newEmail" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title = "Must be a valid email and less than 64 characters" placeholder="Email" value="'.$email.'" required>
        </div>
        <div class="form-group">
            <label for="Username">Username</label>
            <input style="border-radius: 10px;" type="text" name="username" class="form-control" id="Username" placeholder="Username" value="'.$username.'" required>
        </div>
        <div class="form-group">
            <label for="newPassword">New Password</label>
            <input style="border-radius: 10px;" type="password" name="newPassword" class="form-control" id="newPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
        </div>
        <div class="form-group">
            <label for="confirmNewPassword">Confirm New Password</label>
            <input style="border-radius: 10px;" type="password" name="confirmNewPassword" class="form-control" id="confirmNewPassword">
        </div>
        <div align="center" style="padding-bottom: 3vh;">
        <button type="submit" id="updateAccountButton" class="btn-signature-green">Update Account</button>
        </div>
        </form>
    </div>
    ';
}
include('../../footer.php');