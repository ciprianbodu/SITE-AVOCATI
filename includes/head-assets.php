<?php
if (!defined('ASSET_VER')) {
    define('ASSET_VER', '20261018a');
}

function renderHeadAssets(bool $preloadHero = true): void
{
    $v = ASSET_VER;
    if ($preloadHero): ?>
    <link rel="preload" as="image" href="/assets/img/hero-books-sm.webp" type="image/webp" media="(max-width: 767px)">
    <link rel="preload" as="image" href="/assets/img/hero-books.webp" type="image/webp" media="(min-width: 768px)">
    <?php endif; ?>
    <meta name="theme-color" content="#070c14">
    <link rel="preload" href="/assets/fonts/cormorant-latin.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/source-sans-latin.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="/assets/css/site.css?v=<?= htmlspecialchars($v, ENT_QUOTES, 'UTF-8') ?>">
    <script src="/assets/js/site.js?v=<?= htmlspecialchars($v, ENT_QUOTES, 'UTF-8') ?>" defer></script>
    <?php
}
