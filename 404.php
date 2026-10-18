<?php
http_response_code(404);
require_once __DIR__ . '/seo.php';
require_once __DIR__ . '/includes/head-assets.php';
require_once __DIR__ . '/includes/inner-chrome.php';

$override = [
    'title' => 'Pagină inexistentă | Cabinet Bodu',
    'description' => 'Pagina solicitată nu există. Reveniți la cabinetul de avocat Prof. univ. dr. Sebastian V. Bodu.',
    'og_title' => 'Pagină inexistentă | Cabinet Bodu',
    'canonical' => SITE_URL . '/404.php',
    'robots' => 'noindex, follow',
    'alternates' => [
        'ro' => SITE_URL . '/',
        'x-default' => SITE_URL . '/',
    ],
];
$esc = fn($v) => htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="ro" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $esc($override['title']) ?></title>
    <?php renderSeoHead('ro', $override); ?>
    <?php renderHeadAssets(false); ?>
</head>
<body id="top">
    <?php renderInnerHeader('ro'); ?>
    <main id="continut" class="page" tabindex="-1">
        <div class="wrap">
            <p class="kicker">Eroare 404</p>
            <h1>Pagina nu există</h1>
            <hr class="hero__rule">
            <p class="page__lead">Adresa nu corespunde unei pagini din site. Puteți reveni la pagina cabinetului sau la domeniile de practică.</p>
            <p class="page__cta">
                <a class="btn btn-gold" href="/">Pagina cabinetului</a>
                <a class="btn btn-ghost" href="/#experienta">Domenii de practică</a>
            </p>
        </div>
    </main>
    <?php renderInnerFooter('ro'); ?>
</body>
</html>
