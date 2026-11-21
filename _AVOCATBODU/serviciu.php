<?php
require_once __DIR__ . '/seo.php';
require_once __DIR__ . '/includes/practices.php';
require_once __DIR__ . '/includes/head-assets.php';
require_once __DIR__ . '/includes/inner-chrome.php';

$slug = $_GET['d'] ?? '';
if (!is_string($slug)) {
    $slug = '';
}
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
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
if (in_array($_SERVER['REQUEST_METHOD'] ?? '', ['GET', 'HEAD'], true)
    && in_array($requestPath, ['/serviciu.php', '/' . $slug . '/'], true)) {
    header('Location: ' . $canonical, true, 301);
    exit;
}
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
    'hreflang_default' => $roUrl,
    'locale' => $lang === 'en' ? 'en_US' : 'ro_RO',
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

$t = innerChromeCopy($lang);
$english = $lang === 'en';
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
        'mainEntity' => ['@id' => $serviceSchema['@id']],
        'skip_faq' => true,
    ]); ?>
</head>
<body id="top">
    <?php renderInnerHeader($lang, [
        'lang_ro' => '/' . $item['slug'],
        'lang_en' => '/' . $item['en'],
        'section' => 'practice',
    ]); ?>
    <main id="continut" class="page" tabindex="-1">
        <div class="wrap">
            <nav class="crumbs" aria-label="<?= $english ? 'Breadcrumb' : 'Ierarhia paginilor' ?>">
                <a href="<?= $esc($home) ?>"><?= $esc($t['crumb_home']) ?></a>
                <span aria-hidden="true">/</span>
                <span aria-current="page"><?= $esc($copy['name']) ?></span>
            </nav>
            <p class="kicker"><?= $english ? 'Practice area' : 'Domeniu de practică' ?></p>
            <h1><?= $esc($copy['h1']) ?></h1>
            <hr class="hero__rule">
            <p class="page__lead"><?= $esc($copy['lead']) ?></p>
            <div class="prose page__body">
                <h2><?= $esc($copy['services_heading'] ?? ($english ? 'How we can assist' : 'Cum vă putem asista')) ?></h2>
                <ul>
                    <?php foreach ($copy['services'] as $service): ?>
                    <li><?= $esc($service) ?></li>
                    <?php endforeach; ?>
                </ul>
                <h2><?= $english ? 'Our approach' : 'Abordarea cabinetului' ?></h2>
                <?php foreach ($copy['body'] as $para): ?>
                <p><?= $esc($para) ?></p>
                <?php endforeach; ?>
            </div>
            <p class="page__cta"><a class="btn btn-gold" href="<?= $esc($contact) ?>"><?= $english ? 'Request consultation' : 'Solicitați consultanță' ?></a></p>

            <h2 class="page__more"><?= $english ? 'Other practice areas' : 'Alte domenii de practică' ?></h2>
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

    <?php renderInnerFooter($lang); ?>
</body>
</html>
