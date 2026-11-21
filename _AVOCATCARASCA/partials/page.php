<!doctype html>
<html lang="<?= esc($language) ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#292a2e">
    <title><?= esc($title) ?></title>
    <?php if ($notFound): ?>
        <meta name="robots" content="noindex, follow">
    <?php else: ?>
        <meta name="description" content="<?= esc($description) ?>">
        <link rel="canonical" href="<?= esc($canonical) ?>">
        <?php foreach ($alternates as $locale => $alternate): ?>
            <link rel="alternate" hreflang="<?= esc($locale) ?>" href="<?= esc($site['url'] . $alternate) ?>">
        <?php endforeach; ?>
        <link rel="alternate" hreflang="x-default" href="<?= esc($site['url'] . $alternates['ro']) ?>">
        <meta property="og:type" content="website">
        <meta property="og:title" content="<?= esc($title) ?>">
        <meta property="og:description" content="<?= esc($description) ?>">
        <meta property="og:url" content="<?= esc($canonical) ?>">
        <meta property="og:image" content="<?= esc($site['url']) ?>/assets/img/hero-books.webp">
        <meta property="og:locale" content="<?= $language === 'ro' ? 'ro_RO' : 'en_GB' ?>">
        <script type="application/ld+json"><?= json_encode($schema, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
    <?php endif; ?>
    <link rel="stylesheet" href="/assets/css/site.css">
    <script src="/assets/js/site.js" defer></script>
</head>
<body>
<a class="skip-link" href="#main-content"><?= esc($labels['skip']) ?></a>
<header class="site-header">
    <div class="topbar">
        <div class="container topbar-inner">
            <p><?= esc($labels['role']) ?></p>
            <div class="locale">
                <span aria-current="true"><?= esc(strtoupper($language)) ?></span>
                <span aria-hidden="true">|</span>
                <a class="language" aria-label="<?= esc($labels['language']) ?>" hreflang="<?= esc($otherLanguage) ?>" lang="<?= esc($otherLanguage) ?>" href="<?= esc($alternates[$otherLanguage]) ?>"><?= esc(strtoupper($otherLanguage)) ?></a>
            </div>
        </div>
    </div>
    <nav class="header-nav" aria-label="<?= esc($labels['navigation']) ?>">
        <div class="container header-inner">
            <a class="brand" href="<?= esc($homePath) ?>">
                <span class="brand-name"><?= esc($site['brandName']) ?></span>
                <span class="brand-legal">LEGAL</span>
            </a>
            <div class="brand-crest" aria-hidden="true">
                <img src="/assets/img/crest.webp" width="160" height="160" alt="">
                <span><?= esc($site['brandName']) ?> LEGAL</span>
            </div>
            <div class="nav-links">
                <?php foreach ($navLinks as $href => $label): ?>
                    <a href="<?= esc($href) ?>"><?= esc($label) ?></a>
                <?php endforeach; ?>
                <a class="button" href="<?= esc($contactPath) ?>"><?= esc($labels['contact']) ?></a>
            </div>
            <button id="menuToggle" class="menu-toggle" type="button" aria-controls="mobileMenu" aria-expanded="false" aria-label="<?= esc($labels['menu']) ?>" hidden><span class="menu-bars" aria-hidden="true"></span></button>
        </div>
    </nav>
</header>
<dialog id="mobileMenu" class="mobile-menu" aria-label="<?= esc($labels['navigation']) ?>">
    <button id="menuClose" class="menu-close" type="button" aria-label="<?= esc($labels['closeMenu']) ?>" autofocus>×</button>
    <?php foreach ($navLinks as $href => $label): ?>
        <a href="<?= esc($href) ?>"><?= esc($label) ?></a>
    <?php endforeach; ?>
    <a href="<?= esc($contactPath) ?>"><?= esc($labels['contact']) ?></a>
</dialog>
<main id="main-content" tabindex="-1">
    <?php if ($notFound): ?>
        <section class="page-heading">
            <div class="container">
                <h1><?= esc($labels['notFound']) ?></h1>
                <a class="text-link" href="<?= esc($homePath) ?>"><?= esc($labels['backHome']) ?> <span class="arrow" aria-hidden="true"></span></a>
            </div>
        </section>
    <?php elseif ($practice !== null): ?>
        <section class="page-heading">
            <div class="container">
                <a class="eyebrow breadcrumb" href="<?= esc($homePath . '#practica') ?>"><span class="arrow arrow-back" aria-hidden="true"></span> <?= esc($labels['practice']) ?></a>
                <h1><?= esc($practice['title']) ?></h1>
                <p class="intro"><?= esc($practice['description']) ?></p>
            </div>
        </section>
        <section class="band">
            <div class="container practice-detail">
                <h2><?= esc($labels['topics']) ?></h2>
                <div>
                    <ul class="topics">
                        <?php foreach ($practice['topics'] as $topic): ?>
                            <li><?= esc($topic) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <a class="text-link" href="<?= esc($homePath . '#practica') ?>"><?= esc($labels['allPractice']) ?> <span class="arrow" aria-hidden="true"></span></a>
                </div>
            </div>
        </section>
    <?php else: ?>
        <section class="hero">
            <picture class="hero-photo">
                <source media="(max-width: 700px)" srcset="/assets/img/hero-books-sm.webp">
                <img src="/assets/img/hero-books.webp" width="1536" height="1024" alt="" fetchpriority="high">
            </picture>
            <div class="container hero-inner">
                <div class="hero-copy">
                    <p class="eyebrow"><?= esc($labels['role']) ?></p>
                    <h1><?= esc($site['givenName']) ?><br><em><?= esc($site['surname']) ?></em></h1>
                    <div class="hero-rule" aria-hidden="true"></div>
                    <p class="intro"><?= esc($labels['heroIntro']) ?></p>
                    <div class="hero-actions">
                        <a class="button" href="#contact"><?= esc($labels['consultation']) ?></a>
                        <a class="button button-outline" href="#practica"><?= esc($labels['practice']) ?></a>
                    </div>
                </div>
                <aside class="hero-practice" aria-labelledby="hero-practice-title">
                    <h2 id="hero-practice-title"><?= esc($labels['practice']) ?></h2>
                    <?php
                    $sliderId = 'hero-practice-track';
                    $compactSlider = true;
                    require __DIR__ . '/practice-slider.php';
                    ?>
                </aside>
            </div>
        </section>
        <section id="practica" class="band">
            <div class="container">
                <h2><?= esc($labels['practice']) ?></h2>
                <?php
                $sliderId = 'practice-track';
                $compactSlider = false;
                require __DIR__ . '/practice-slider.php';
                ?>
            </div>
        </section>
        <div class="credentials">
            <dl class="container credentials-grid">
                <div><dt><?= esc($labels['bar']) ?></dt><dd><?= esc($site['region']) ?></dd></div>
                <div><dt><?= esc($labels['professionalStatus']) ?></dt><dd><?= esc($labels['status']) ?></dd></div>
            </dl>
        </div>
        <section id="profil" class="band profile">
            <div class="container profile-inner">
                <div>
                    <h2><?= esc($labels['profile']) ?></h2>
                    <p><?= esc($labels['profileText']) ?></p>
                    <a class="text-link" href="<?= esc($site['barUrl']) ?>" target="_blank" rel="noopener"><?= esc($labels['barLink']) ?> <span class="arrow arrow-up" aria-hidden="true"></span></a>
                </div>
                <article id="presa" class="press">
                    <h3 class="eyebrow"><?= esc($labels['press']) ?></h3>
                    <time datetime="2021-03-11"><?= esc($labels['pressDate']) ?></time>
                    <p class="press-title"><?= esc($labels['pressTitle']) ?></p>
                    <p><?= esc($labels['pressExcerpt']) ?></p>
                    <a class="text-link" href="<?= esc($site['pressUrl']) ?>" target="_blank" rel="noopener"><?= esc($labels['pressLink']) ?> <span class="arrow arrow-up" aria-hidden="true"></span></a>
                </article>
            </div>
        </section>
    <?php endif; ?>
    <?php if (!$notFound): ?>
        <section id="contact" class="contact band">
            <div class="container contact-inner">
                <div>
                    <h2><?= esc($labels['contact']) ?></h2>
                    <a class="button" href="<?= esc($telephoneHref) ?>"><?= esc($labels['phoneAction']) ?> <span class="arrow arrow-up" aria-hidden="true"></span></a>
                    <a class="phone" href="<?= esc($telephoneHref) ?>"><?= esc($site['telephoneDisplay']) ?></a>
                </div>
                <div class="office-card">
                    <h3><?= esc($labels['serviceArea']) ?></h3>
                    <p><?= esc($labels['county']) ?></p>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>
<footer class="site-footer">
    <div class="container footer-inner">
        <div>
            <a class="footer-brand" href="<?= esc($homePath) ?>"><?= esc($site['name']) ?></a>
            <p><?= esc($labels['role']) ?></p>
        </div>
        <nav class="footer-links" aria-label="<?= esc($labels['practice']) ?>">
            <?php foreach ($practiceAreas as $area): ?>
                <a href="<?= esc($area[$language]['path']) ?>"><?= esc($area[$language]['title']) ?></a>
            <?php endforeach; ?>
        </nav>
    </div>
</footer>
</body>
</html>
