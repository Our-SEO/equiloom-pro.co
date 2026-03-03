<?php

require_once rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/') . "/form_crypto_hyper/env.php";
require_once rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/') . "/assets/php/functions.php";

enforceValidLanguagePrefix();

require_once rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/') . "/kclient.php";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (empty($_COOKIE['formSid'])) {
    $sid = bin2hex(random_bytes(16));
    $sig = hash_hmac('sha256', $sid, TRACKER_SECRET);

    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');

    setcookie('formSid', $sid . '|' . $sig, [
        'expires' => time() + 3600,
        'path' => '/',     
        'secure' => $isHttps,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
}


if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


$client = new KClient('https://postback.api-hex.space/', 'syqxnyrhddmdnw1sdqzxt1gtvg9nr4gf');
$params = $client->getParams();
$clientCountryCode = mb_strtolower((string) ($params['headers']['cf-ipcountry'] ?? ''));


$csrf_token = $_SESSION['csrf_token'];
?>