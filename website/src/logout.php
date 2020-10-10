<?php
ob_start();
try {
    session_name('user');
    session_start();
    session_destroy();
    session_name('user');
    session_start();
    session_regenerate_id(true);
    setcookie('auth', password_hash('NO', PASSWORD_BCRYPT));
} catch (Error $e) {
    echo "Caught Error: $e";
}
ob_end_flush();
$URL = "/";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
