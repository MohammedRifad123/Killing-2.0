<?php
define('AES_KEY', '4x8mK2pL9nQ7rT1v');
define('AES_IV',  '1234567890abcdef');

function decrypt_url($enc) {
    return openssl_decrypt(
        base64_decode($enc),
        'AES-128-CBC',
        AES_KEY,
        OPENSSL_RAW_DATA,
        AES_IV
    );
}

$enc_url = $_GET['url'] ?? '';
if (empty($enc_url)) { die('Missing url'); }

$url = decrypt_url($enc_url);
if ($url === false) { die('Invalid input'); }

$blocked = ['http://','https://','file://'];
foreach ($blocked as $s) {
    if (stripos($url, $s) === 0) {
        die('Blocked scheme');
    }
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
echo curl_exec($ch);
curl_close($ch);
