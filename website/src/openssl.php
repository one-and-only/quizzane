<?php
class encrypt {

    public function opensslEncryptAES256($plaintext, $key) {
        $cipher = "aes-256-cbc";
        if (in_array($cipher, openssl_get_cipher_methods())) {
            $iv = base64_decode('z5qxebmag6upcyas2mzku3');
            $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv);
            return $ciphertext;
        }
    }
    public function opensslDecryptAES256($ciphertext, $key) {
        $cipher = "aes-256-cbc";
        $iv = base64_decode('z5qxebmag6upcyas2mzku3');
        $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv);
        return $original_plaintext;
    }
       
}