<?php
ob_start();
session_name('user');
session_start();
session_destroy();
session_name('user');
session_start();
session_regenerate_id(true);
setcookie('auth', sodium_crypto_pwhash_str('NO', 2, 67108864));
ob_end_flush();
$URL = "/";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
