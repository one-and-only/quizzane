<?php
ob_start();
include('../dbconn.php');
include('../openssl.php');
$openssl = new encrypt('../openssl.php');
//start the session
session_name('user');
session_start();
session_regenerate_id(false);
ob_end_flush();

$updateType = 0;
// used later to check if the SQL query should be ran
$updateStatus = 0;

$getUserData = 'SELECT * FROM users WHERE username = :username';
$username = [
    ':username' => $_SESSION['username']
];
$getUserData = $pdo->prepare($getUserData);

if ($getUserData->execute($username)) {
    $userData = $getUserData->fetch(PDO::FETCH_ASSOC);
    $emailCipherText = $userData['email'];
    $username = $userData['username'];
    $passwordHash = $userData['password'];
}

// check for email change
if ($_POST['email'] != "" and $openssl->opensslDecryptAES256($emailCipherText, include('../opensslkey.php')) != $_POST['email']) {
    $updateType += 1;
}

// check for password change and set redirect reason
if ($_POST['confirmNewPassword'] == $_POST['newPassword'] and sodium_crypto_pwhash_str_verify($userData['password'], $_POST['newPassword']) == false) {
    $updateType += 2;
} elseif ($_POST['confirmNewPassword'] != "" and $_POST['newPassword'] == "") {
    $_SESSION['redirectReason'] = 'UNSET-PASSWORD';
    $URL = "profile";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    exit();
} elseif ($_POST['confirmNewPassword'] == "" and $_POST['newPassword'] != "") {
    $_SESSION['redirectReason'] = 'UNSET-CONFIRM-PASSWORD';
    $URL = "profile";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    exit();
} elseif ($_POST['newPassword'] != $_POST['confirmNewPassword']) {
    $_SESSION['redirectReason'] = 'PASSWORD-MISMATCH';
    $URL = "profile";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    exit();
} elseif ($_POST['confirmNewPassword'] == $_POST['newPassword'] and sodium_crypto_pwhash_str_verify($userData['password'], $_POST['newPassword']) == true) {
    $_SESSION['redirectReason'] = 'UPDATE-SAME-PASSWORD';
    $URL = "profile";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    exit();
}

// check for username update
if ($_POST['username'] != "" and $username != $_POST['username']) {
    $updateType += 3;
}

// do update prep for email update
if ($updateType == 1) {
    $updateUser = "UPDATE users SET email = :email WHERE username = :username";
    $options = [
        ':username' => $_POST['username'],
        ':email' => $openssl->opensslEncryptAES256($_POST['email'], include('../opensslkey.php'))
    ];
    $updateStatus = 1;
}

// do update prep for password update
elseif ($updateType == 2) {
    $updateUser = "UPDATE users SET password = :password WHERE username = :usernameDB";
    $options = [
        ':password' => sodium_crypto_pwhash_str($_POST['newPassword'], 4, 128000000),
        ':usernameDB' => $userData['username']
    ];
    $updateStatus = 1;
}

// do update prep for username update
elseif ($updateType == 3) {
    $updateUser = "UPDATE users SET username = :username WHERE username = :usernameDB";
    $options = [
        ':username' => $_POST['username'],
        ':usernameDB' => $userData['username']
    ];
    $updateStatus = 1;
}

// do update prep for username + email update
elseif ($updateType == 4) {
    $updateUser = "UPDATE users SET username = :username, email = :email WHERE username = :usernameDB";
    $options = [
        ':username' => $_POST['username'],
        ':email' => $openssl->opensslEncryptAES256($_POST['email'], include('../opensslkey.php')),
        ':usernameDB' => $userData['username']
    ];
    $updateStatus = 1;
}

//do update prep for username + email + password update
elseif ($updateType == 6) {
    $updateUser = "UPDATE users SET username = :username, email = :email, password = :password WHERE username = :usernameDB";
    $options = [
        ':username' => $_POST['username'],
        ':email' => $openssl->opensslEncryptAES256($_POST['email'], include('../opensslkey.php')),
        ':password' => sodium_crypto_pwhash_str($_POST['newPassword'], 4, 128000000),
        ':usernameDB' => $userData['username']
    ];
    $updateStatus = 1;
}

// make the updates
if ($updateStatus == 1 and $updateUser = $pdo->prepare($updateUser)) {
    if ($updateUser->execute($options)) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['redirectReason'] = 'UPDATE-SUCCESS';
        $URL = "profile";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }
}
