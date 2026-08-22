<?php
declare(strict_types=1);

define('SITE_BOOTSTRAP', true);

header('Content-Type: text/html; charset=UTF-8');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('X-Frame-Options: SAMEORIGIN');

if (session_status() !== PHP_SESSION_ACTIVE) {
    $secure = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
        'cookie_secure' => $secure,
    ]);
}

require_once __DIR__ . '/../config.php';

$lang = $lang ?? 'ro';
$catalog = require __DIR__ . '/i18n.php';
if (!isset($catalog[$lang])) {
    $lang = 'ro';
}
$t = $catalog[$lang];

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once __DIR__ . '/mail.php';
$statusMessage = handle_contact($t);

$cssPath = __DIR__ . '/../assets/css/site.css';
$jsPath = __DIR__ . '/../assets/js/site.js';
$assetVersion = max(
    is_file($cssPath) ? (int) filemtime($cssPath) : 1,
    is_file($jsPath) ? (int) filemtime($jsPath) : 1
);

$canonical = SITE_URL . '/' . ($lang === 'en' ? 'en.php' : '');
$hreflangRo = SITE_URL . '/';
$hreflangEn = SITE_URL . '/en.php';
$pageFile = $t['page_file'];

require __DIR__ . '/template.php';
