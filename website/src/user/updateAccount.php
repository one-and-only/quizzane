<?php
ob_start();
include('../dbconn.php');
include('../openssl.php');
$openssl = new encrypt('../openssl.php');
//start the session
session_name('user');
session_start();
session_regenerate_id(false);

$updateType;

// check for email change (should always be true because email form is required)
if ($_POST['email'] != "") {
    $updateType += 1;
}

// check for password change
if ($_POST['confirmNewPassword'] == $_POST['newPassword']) {
    $updateType += 2;
} elseif ($_POST['confirmNewPassword'] != "" and $_POST['newPassword'] == "") {
    $_SESSION['redirect'] = 'UNSET-PASSWORD';
    $URL = "profile.php";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    ob_end_flush();
} elseif ($_POST['confirmNewPassword'] == "" and $_POST['newPassword'] != "") {
    $_SESSION['redirect'] = 'UNSET-CONFIRM-PASSWORD';
    $URL = "profile.php";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    ob_end_flush();
} elseif ($_POST['newPassword'] != $_POST['confirmNewPassword']) {
    $_SESSION['redirect'] = 'PASSWORD-MISMATCH';
    $URL = "profile.php";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    ob_end_flush();
}

// check for username change (should always be true because username form is required)
if ($_POST['username'] != "") {
    $updateType += 3;
}

// do update prep for username + email update
if ($updateType = 4) {
    $updateUser = "UPDATE users SET username = :username, email = :email";
    $options = [
        ':username' => $_POST['username'],
        ':email' => $openssl->opensslEncryptAES256($_POST['email'], include('../opensslkey.php'))
    ];
}
//do update prep for username + email + password update
elseif ($updateType = 6) {
    $updateUser = "UPDATE users SET username = :username, email = :email, password = :password";
    $options = [
        ':username' => $_POST['username'],
        ':email' => $openssl->opensslEncryptAES256($_POST['email'], include('../opensslkey.php')),
        ':password' => sodium_crypto_pwhash_str($_POST['newPassword'], 4, 128000000)
    ];
}

$updateUser = $pdo->prepare($updateUser);

// make the updates
if ($updateUser->execute($options)) {
    $_SESSION['username'] = $_POST['username'];
    $URL = "profile.php";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    ob_end_flush();
} else {
    echo "an error occured";
    ob_end_flush();
}
