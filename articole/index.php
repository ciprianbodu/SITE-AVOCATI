<?php
require_once dirname(__DIR__) . '/seo.php';
require_once dirname(__DIR__) . '/includes/head-assets.php';
require_once dirname(__DIR__) . '/includes/articles.php';
require_once dirname(__DIR__) . '/includes/inner-chrome.php';

$meta = articleIndexMeta();
$esc = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
$override = articleSeoOverride($meta + ['og_type' => 'website']);
$override['og_type'] = 'website';
$breadcrumbs = [
    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Acasă', 'item' => SITE_URL . '/'],
    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Articole', 'item' => $meta['canonical']],
];
$listItems = [];
$position = 1;
foreach (articleCatalog() as $item) {
    $listItems[] = [
        '@type' => 'ListItem',
        'position' => $position++,
        'url' => SITE_URL . $item['path'],
        'name' => $item['h1'],
    ];
}
$t = innerChromeCopy('ro');
?>
<!DOCTYPE html>
<html lang="ro" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $esc($meta['title']) ?></title>
    <?php renderSeoHead('ro', $override); ?>
    <?php renderHeadAssets(false); ?>
    <?php renderSeoJsonLd('ro', [
        'canonical' => $meta['canonical'],
        'title' => $meta['title'],
        'description' => $meta['description'],
        'breadcrumbs' => $breadcrumbs,
        'skip_faq' => true,
        'webpage_type' => 'CollectionPage',
        'mainEntity' => ['@id' => $meta['canonical'] . '#list'],
        'dateModified' => seoLastmod($meta['file_abs'], dirname(__DIR__) . '/includes/articles.php'),
        'graph' => [[
            '@type' => 'ItemList',
            '@id' => $meta['canonical'] . '#list',
            'name' => $meta['h1'],
            'itemListElement' => $listItems,
        ]],
    ]); ?>
</head>
<body id="top">
    <?php renderInnerHeader('ro'); ?>
    <main id="continut" class="page page--article" tabindex="-1">
        <div class="wrap">
            <nav class="crumbs" aria-label="Breadcrumb">
                <a href="/"><?= $esc($t['crumb_home']) ?></a>
                <span aria-hidden="true">/</span>
                <span>Articole</span>
            </nav>
            <p class="kicker"><?= $esc($meta['kicker']) ?></p>
            <h1><?= $esc($meta['h1']) ?></h1>
            <hr class="hero__rule">
            <p class="page__lead"><?= $esc($meta['lead']) ?></p>
            <div class="practice-list">
                <?php foreach (articleCatalog() as $item): ?>
                <a class="practice-item" href="<?= $esc($item['path']) ?>">
                    <span class="practice-item__num">→</span>
                    <div>
                        <h2><?= $esc($item['h1']) ?></h2>
                        <p><?= $esc($item['lead']) ?></p>
                    </div>
                </a>
                <?php endforeach; ?>
                <a class="practice-item" href="https://www.juridice.ro/author/sebastian-bodu" target="_blank" rel="noopener noreferrer">
                    <span class="practice-item__num">↗</span>
                    <div>
                        <h2>Articole pe JURIDICE.ro</h2>
                        <p>Studii de drept societar publicate de autor pe JURIDICE.ro — voința socială, titlurile de participare și alte teme de doctrină.</p>
                    </div>
                </a>
            </div>
            <p class="page__cta"><a class="btn btn-gold" href="/#contact">Solicitați consultanță</a></p>
        </div>
    </main>
    <?php renderInnerFooter('ro'); ?>
</body>
</html>
