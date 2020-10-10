<?php
if (!isset($_COOKIE['auth']) or !sodium_crypto_pwhash_str_verify($_COOKIE['auth'], 'YES')) {
    $_SESSION['redirect'] = 'UNAUTHORIZED';
    $URL = "/";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}
