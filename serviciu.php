<?php
require_once __DIR__ . '/seo.php';
require_once __DIR__ . '/includes/practices.php';
require_once __DIR__ . '/includes/head-assets.php';

$slug = preg_replace('/[^a-z-]/', '', (string)($_GET['d'] ?? ''));
$item = practiceBySlug($slug, 'ro');
$lang = 'ro';
if (!$item) {
    $item = practiceBySlug($slug, 'en');
    $lang = 'en';
}
if (!$item) {
    require __DIR__ . '/404.php';
    exit;
}

$copy = $item['copy'];
$roUrl = SITE_URL . '/' . $item['slug'];
$enUrl = SITE_URL . '/' . $item['en'];
$canonical = $lang === 'en' ? $enUrl : $roUrl;
$home = $lang === 'en' ? '/en.php' : '/';
$contact = $lang === 'en' ? '/en.php#contact' : '/#contact';
$esc = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

$override = [
    'title' => $copy['title'],
    'description' => $copy['description'],
    'og_title' => $copy['title'],
    'canonical' => $canonical,
    'hreflang_ro' => $roUrl,
    'hreflang_en' => $enUrl,
    'locale' => $lang === 'en' ? 'en_US' : 'ro_RO',
    'keywords' => $copy['name'] . ', avocat București, Sebastian Bodu, avocatură de afaceri',
];

$breadcrumbs = [
    ['@type' => 'ListItem', 'position' => 1, 'name' => $lang === 'en' ? 'Home' : 'Acasă', 'item' => $lang === 'en' ? SITE_URL . '/en.php' : SITE_URL . '/'],
    ['@type' => 'ListItem', 'position' => 2, 'name' => $copy['name'], 'item' => $canonical],
];
$serviceSchema = [
    '@type' => 'Service',
    '@id' => $canonical . '#service',
    'name' => $copy['name'],
    'description' => $copy['description'],
    'url' => $canonical,
    'provider' => ['@id' => SITE_URL . '/#organization'],
    'areaServed' => ['@type' => 'City', 'name' => 'București'],
];

$t = $lang === 'en' ? [
    'top' => 'Bucharest Bar · Business law · Since 1996',
    'brand' => 'Law Office',
    'nav_firm' => 'The firm',
    'nav_practice' => 'Practice',
    'nav_pub' => 'Publications',
    'nav_cta' => 'Consultation',
    'menu' => 'Menu',
    'close' => 'Close',
    'crumb_home' => 'Home',
    'kicker' => 'Practice area',
    'cta' => 'Request consultation',
    'other' => 'Other practice areas',
    'footer' => 'Law Office · Bucharest Bar',
    'rights' => 'All rights reserved',
    'lang_ro' => '/',
    'lang_en' => '/en.php',
] : [
    'top' => 'Baroul București · Avocatură de afaceri · Din 1996',
    'brand' => 'Cabinet de Avocat',
    'nav_firm' => 'Cabinet',
    'nav_practice' => 'Practică',
    'nav_pub' => 'Publicații',
    'nav_cta' => 'Consultanță',
    'menu' => 'Meniu',
    'close' => 'Închide',
    'crumb_home' => 'Acasă',
    'kicker' => 'Domeniu de practică',
    'cta' => 'Solicitați consultanță',
    'other' => 'Alte domenii de practică',
    'footer' => 'Cabinet de Avocat · Baroul București',
    'rights' => 'Toate drepturile rezervate',
    'lang_ro' => '',
    'lang_en' => 'en.php',
];
?>
<!DOCTYPE html>
<html lang="<?= $esc($lang) ?>" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $esc($copy['title']) ?></title>
    <?php renderSeoHead($lang, $override); ?>
    <?php renderHeadAssets(false); ?>
    <?php renderSeoJsonLd($lang, [
        'canonical' => $canonical,
        'title' => $copy['title'],
        'description' => $copy['description'],
        'breadcrumbs' => $breadcrumbs,
        'service' => $serviceSchema,
        'skip_faq' => true,
    ]); ?>
</head>
<body id="top">
    <a href="#continut" class="skip-link"><?= $lang === 'en' ? 'Skip to content' : 'Salt la conținut' ?></a>
    <header class="site-header">
        <div class="topbar">
            <div class="wrap topbar__inner">
                <p class="topbar__meta"><?= $esc($t['top']) ?></p>
                <div class="lang">
                    <?php if ($lang === 'ro'): ?>
                    <span class="is-active">RO</span><span aria-hidden="true">|</span><a href="/<?= $esc($item['en']) ?>">EN</a>
                    <?php else: ?>
                    <a href="/<?= $esc($item['slug']) ?>">RO</a><span aria-hidden="true">|</span><span class="is-active">EN</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <nav class="nav" aria-label="<?= $lang === 'en' ? 'Main navigation' : 'Navigare principală' ?>">
            <div class="wrap nav__inner">
                <a href="<?= $esc($home) ?>" class="brand">
                    <span class="brand__rule" aria-hidden="true"></span>
                    <span class="brand__text">
                        <span class="brand__mark">Bodu</span>
                        <span class="brand__sub"><?= $esc($t['brand']) ?></span>
                    </span>
                </a>
                <div class="nav__links">
                    <a href="<?= $esc($home) ?>#profil"><?= $esc($t['nav_firm']) ?></a>
                    <a href="<?= $esc($home) ?>#experienta"><?= $esc($t['nav_practice']) ?></a>
                    <a href="<?= $esc($home) ?>#carti"><?= $esc($t['nav_pub']) ?></a>
                    <?php if ($lang === 'ro'): ?>
                    <a href="/articole/">Articole</a>
                    <?php endif; ?>
                    <a href="<?= $esc($contact) ?>" class="btn btn-gold"><?= $esc($t['nav_cta']) ?></a>
                </div>
                <button id="menuToggle" class="menu-toggle" type="button" aria-expanded="false" aria-controls="mobileMenu" data-breakpoint="900" aria-label="<?= $esc($t['menu']) ?>">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </nav>
    </header>
    <dialog id="mobileMenu" class="mobile-menu" aria-label="<?= $lang === 'en' ? 'Main navigation' : 'Navigare principală' ?>">
        <button id="menuClose" class="menu-close" aria-label="<?= $esc($t['close']) ?>">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <a href="<?= $esc($home) ?>#profil" class="mobile-nav"><?= $esc($t['nav_firm']) ?></a>
        <a href="<?= $esc($home) ?>#experienta" class="mobile-nav"><?= $esc($t['nav_practice']) ?></a>
        <a href="<?= $esc($home) ?>#carti" class="mobile-nav"><?= $esc($t['nav_pub']) ?></a>
        <?php if ($lang === 'ro'): ?>
        <a href="/articole/" class="mobile-nav">Articole</a>
        <?php endif; ?>
        <a href="<?= $esc($contact) ?>" class="mobile-nav"><?= $esc($t['nav_cta']) ?></a>
    </dialog>

    <main id="continut" class="page" tabindex="-1">
        <div class="wrap">
            <nav class="crumbs" aria-label="Breadcrumb">
                <a href="<?= $esc($home) ?>"><?= $esc($t['crumb_home']) ?></a>
                <span aria-hidden="true">/</span>
                <span><?= $esc($copy['name']) ?></span>
            </nav>
            <p class="kicker"><?= $esc($t['kicker']) ?> · <?= $esc($item['num']) ?></p>
            <h1><?= $esc($copy['h1']) ?></h1>
            <hr class="hero__rule">
            <p class="page__lead"><?= $esc($copy['lead']) ?></p>
            <div class="prose page__body">
                <?php foreach ($copy['body'] as $para): ?>
                <p><?= $esc($para) ?></p>
                <?php endforeach; ?>
            </div>
            <p class="page__cta"><a class="btn btn-gold" href="<?= $esc($contact) ?>"><?= $esc($t['cta']) ?></a></p>

            <h2 class="page__more"><?= $esc($t['other']) ?></h2>
            <div class="practice-list">
                <?php foreach (practiceCatalog() as $roSlug => $other):
                    if ($roSlug === $item['slug']) continue;
                    $oc = $lang === 'en' ? $other['en_copy'] : $other['ro'];
                    $href = $lang === 'en' ? $other['en'] : $roSlug;
                ?>
                <a class="practice-item" href="/<?= $esc($href) ?>">
                    <span class="practice-item__num"><?= $esc($other['num']) ?></span>
                    <div>
                        <h3><?= $esc($oc['name']) ?></h3>
                        <p><?= $esc($oc['short']) ?></p>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <footer class="site-footer">
        <div class="wrap footer__inner">
            <div>
                <p class="footer__brand">Bodu</p>
                <p class="footer__sub"><?= $esc($t['footer']) ?></p>
            </div>
            <p><?php if ($lang === 'ro'): ?><a href="/articole/">Articole</a> · <?php endif; ?>&copy; <?= date('Y') ?> avocatbodu.ro · <?= $esc($t['rights']) ?></p>
        </div>
    </footer>
</body>
</html>
