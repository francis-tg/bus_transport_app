<?php

namespace Cisco\Shadow\crypto;

class Hash{
    public function __construct() {
        
    }
    static function Cipher(string $data, string $passphrase){
        return openssl_encrypt($data,openssl_get_cipher_methods()[0],$passphrase);
    }

    static function VerifyCipher(string $data,string $passphrase){
        return openssl_decrypt($data, openssl_get_cipher_methods()[0], $passphrase);
    }
}