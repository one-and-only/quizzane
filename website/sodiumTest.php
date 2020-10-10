<?php
$password = 'password';
$hashed = sodium_crypto_pwhash_str($_POST['password'], 4, 128000000);
echo "Hashed Password: $hashed";
$verified = sodium_crypto_pwhash_str_verify($hashed, $password);
echo " Is Verified: $verified";