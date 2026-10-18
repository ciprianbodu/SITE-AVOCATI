<?php

require_once dirname(__DIR__) . '/seo.php';
require_once __DIR__ . '/head-assets.php';
require_once __DIR__ . '/practices.php';
require_once __DIR__ . '/articles.php';
require_once __DIR__ . '/inner-chrome.php';

function renderArticleBody(array $blocks): void
{
    $esc = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
    foreach ($blocks as $block) {
        $type = $block['type'] ?? 'p';
        if ($type === 'h2') {
            echo '<h2>' . $esc($block['text'] ?? '') . '</h2>';
            continue;
        }
        if ($type === 'ul') {
            echo '<ul>';
            foreach ($block['items'] ?? [] as $item) {
                echo '<li>' . $esc($item) . '</li>';
            }
            echo '</ul>';
            continue;
        }
        if ($type === 'html') {
            echo $block['html'] ?? '';
            continue;
        }
        echo '<p>' . $esc($block['text'] ?? '') . '</p>';
    }
}

function articleJsonLdExtras(array $article, array $breadcrumbs, ?array $extraNode = null): array
{
    $graph = [];
    if ($extraNode) {
        $graph[] = $extraNode;
    } else {
        $modified = seoLastmod($article['file_abs'] ?? __FILE__, __FILE__);
        $graph[] = [
            '@type' => 'Article',
            '@id' => $article['canonical'] . '#article',
            'headline' => $article['h1'],
            'description' => $article['description'],
            'inLanguage' => 'ro',
            'datePublished' => $article['datePublished'],
            'dateModified' => $modified,
            'author' => ['@id' => SITE_URL . '/#person'],
            'publisher' => ['@id' => SITE_URL . '/#organization'],
            'image' => SITE_URL . '/sebastianbodu.jpg',
            'mainEntityOfPage' => ['@id' => $article['canonical'] . '#webpage'],
            'about' => ['@id' => SITE_URL . '/#person'],
        ];
    }
    return [
        'canonical' => $article['canonical'],
        'title' => $article['title'],
        'description' => $article['description'],
        'breadcrumbs' => $breadcrumbs,
        'skip_faq' => true,
        'webpage_type' => 'WebPage',
        'mainEntity' => ['@id' => $article['canonical'] . '#article'],
        'dateModified' => seoLastmod($article['file_abs'] ?? __FILE__),
        'graph' => $graph,
    ];
}

function renderArticlePage(string $slug): void
{
    $article = articleBySlug($slug);
    if (!$article) {
        http_response_code(404);
        require dirname(__DIR__) . '/404.php';
        exit;
    }

    $esc = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
    $override = articleSeoOverride($article);
    $breadcrumbs = [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Acasă', 'item' => SITE_URL . '/'],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Articole', 'item' => SITE_URL . '/articole/'],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $article['h1'], 'item' => $article['canonical']],
    ];
    $t = innerChromeCopy('ro');
    ?>
<!DOCTYPE html>
<html lang="ro" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $esc($article['title']) ?></title>
    <?php renderSeoHead('ro', $override); ?>
    <?php renderHeadAssets(false); ?>
    <?php renderSeoJsonLd('ro', articleJsonLdExtras($article, $breadcrumbs)); ?>
</head>
<body id="top">
    <?php renderInnerHeader('ro'); ?>
    <main id="continut" class="page page--article" tabindex="-1">
        <div class="wrap">
            <nav class="crumbs" aria-label="Breadcrumb">
                <a href="/"><?= $esc($t['crumb_home']) ?></a>
                <span aria-hidden="true">/</span>
                <a href="/articole/">Articole</a>
                <span aria-hidden="true">/</span>
                <span><?= $esc($article['kicker']) ?></span>
            </nav>
            <p class="kicker"><?= $esc($article['kicker']) ?></p>
            <h1><?= $esc($article['h1']) ?></h1>
            <hr class="hero__rule">
            <p class="page__lead"><?= $esc($article['lead']) ?></p>
            <div class="prose page__body">
                <?php renderArticleBody($article['body']); ?>
            </div>
            <p class="page__cta"><a class="btn btn-gold" href="/#contact">Solicitați consultanță</a></p>

            <h2 class="page__more">Alte ghiduri</h2>
            <div class="practice-list">
                <?php foreach (articleCatalog() as $otherSlug => $other):
                    if ($otherSlug === $slug) {
                        continue;
                    }
                ?>
                <a class="practice-item" href="<?= $esc($other['path']) ?>">
                    <span class="practice-item__num">→</span>
                    <div>
                        <h3><?= $esc($other['h1']) ?></h3>
                        <p><?= $esc($other['lead']) ?></p>
                    </div>
                </a>
                <?php endforeach; ?>
                <?php if (!empty($article['practice'])):
                    $practice = practiceCatalog()[$article['practice']] ?? null;
                    if ($practice):
                ?>
                <a class="practice-item" href="/<?= $esc($article['practice']) ?>">
                    <span class="practice-item__num"><?= $esc($practice['num']) ?></span>
                    <div>
                        <h3><?= $esc($practice['ro']['name']) ?></h3>
                        <p><?= $esc($practice['ro']['short']) ?></p>
                    </div>
                </a>
                <?php endif; endif; ?>
            </div>
        </div>
    </main>
    <?php renderInnerFooter('ro'); ?>
</body>
</html>
    <?php
}
