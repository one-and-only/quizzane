<?php
class encrypt {

    public function opensslEncryptAES256($plaintext, $key) {
        //$key should have been previously generated in a cryptographically safe way, like openssl_random_pseudo_bytes
        $cipher = "aes-256-cbc";
        if (in_array($cipher, openssl_get_cipher_methods())) {
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = base64_decode('z5qxebmag6upcyas2mzku3');
            $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv);
            return $ciphertext;
        }
    }
    public function opensslDecryptAES256($ciphertext, $key) {
        $cipher = "aes-256-cbc";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = base64_decode('z5qxebmag6upcyas2mzku3');
        $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv);
        return $original_plaintext;
    }
       
}