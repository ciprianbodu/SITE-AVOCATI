<?php
define('SITE_URL', 'https://avocatbodu.ro');
define('SITE_NAME', 'Cabinet de Avocat Prof. univ. dr. Sebastian V. Bodu');
define('SITE_EMAIL', 'bodu.sebastian@gmail.com');
define('SITE_PHONE', '+40722509759');
define('SITE_PHONE_DISPLAY', '+40 722 509 759');

if (file_exists(__DIR__ . '/webmaster-config.php')) {
    require __DIR__ . '/webmaster-config.php';
}
if (!defined('GOOGLE_SITE_VERIFICATION')) {
    define('GOOGLE_SITE_VERIFICATION', '2ne_mFDmEK8H5LesW-0uQZ7KLLhulX7OpsrFm_IHSIM');
}
if (!defined('BING_SITE_VERIFICATION')) {
    define('BING_SITE_VERIFICATION', '');
}

function renderWebmasterVerification(): void
{
    $esc = fn($v) => htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
    if (GOOGLE_SITE_VERIFICATION !== '') {
        echo '<meta name="google-site-verification" content="' . $esc(GOOGLE_SITE_VERIFICATION) . '">' . "\n    ";
    }
    if (BING_SITE_VERIFICATION !== '') {
        echo '<meta name="msvalidate.01" content="' . $esc(BING_SITE_VERIFICATION) . '">' . "\n    ";
    }
}

function seoData(string $lang): array
{
    $data = [
        'ro' => [
            'lang'       => 'ro',
            'locale'     => 'ro_RO',
            'canonical'  => SITE_URL . '/',
            'alternate'  => SITE_URL . '/en.php',
            'title'      => 'Avocat drept societar București | Prof. Sebastian V. Bodu',
            'description'=> 'Avocat definitiv Baroul București din 1996. Drept societar, comercial, fiscal, bancar și arbitraj. Consultanță pentru societăți și investitori.',
            'keywords'   => 'avocat București, avocat drept societar, avocat drept comercial, avocat afaceri, Sebastian Bodu, drept fiscal, criminalitate economică, arbitraj comercial, Baroul București, cabinet avocat',
            'og_title'   => 'Avocat drept societar și comercial București | Cabinet Bodu',
            'job_title'  => 'Avocat definitiv, Profesor universitar',
            'org_name'   => 'Cabinet de Avocat Prof. univ. dr. Sebastian V. Bodu',
        ],
        'en' => [
            'lang'       => 'en',
            'locale'     => 'en_US',
            'canonical'  => SITE_URL . '/en.php',
            'alternate'  => SITE_URL . '/',
            'title'      => 'Corporate lawyer in Bucharest | Prof. Sebastian V. Bodu',
            'description'=> 'Corporate and commercial lawyer in Bucharest. Bucharest Bar since 1996. Tax, banking and arbitration. Counsel for companies and investors.',
            'keywords'   => 'lawyer Bucharest, corporate lawyer Romania, commercial lawyer, business attorney, Sebastian Bodu, tax law, white-collar crime, commercial arbitration, Bucharest Bar',
            'og_title'   => 'Corporate & commercial lawyer in Bucharest | Bodu Law Office',
            'job_title'  => 'Attorney at Law, Full Professor',
            'org_name'   => 'Law Office of Prof. Dr. Sebastian V. Bodu',
        ],
    ];
    return $data[$lang] ?? $data['ro'];
}

function seoLastmod(string ...$files): string
{
    $max = 0;
    foreach ($files as $file) {
        $time = is_file($file) ? (int) filemtime($file) : 0;
        if ($time > $max) {
            $max = $time;
        }
    }
    return $max ? date('Y-m-d', $max) : date('Y-m-d');
}

function renderSeoHead(string $lang, ?array $override = null): void
{
    $s = $override ? array_merge(seoData($lang), $override) : seoData($lang);
    $image = SITE_URL . '/sebastianbodu.jpg';
    $esc = fn($v) => htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
    $robots = $s['robots'] ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
    $alternates = $s['alternates'] ?? [
        'ro' => $s['hreflang_ro'] ?? SITE_URL . '/',
        'en' => $s['hreflang_en'] ?? SITE_URL . '/en.php',
        'x-default' => $s['hreflang_default'] ?? SITE_URL . '/',
    ];
    ?>
    <meta name="description" content="<?= $esc($s['description']) ?>">
    <meta name="keywords" content="<?= $esc($s['keywords'] ?? seoData($lang)['keywords']) ?>">
    <meta name="author" content="Prof. univ. dr. Sebastian V. Bodu">
    <meta name="robots" content="<?= $esc($robots) ?>">
    <meta name="googlebot" content="<?= $esc(str_contains($robots, 'noindex') ? 'noindex, follow' : 'index, follow') ?>">
    <meta name="bingbot" content="<?= $esc(str_contains($robots, 'noindex') ? 'noindex, follow' : 'index, follow') ?>">
    <meta name="geo.region" content="RO-B">
    <meta name="geo.placename" content="București">
    <link rel="canonical" href="<?= $esc($s['canonical']) ?>">
    <?php foreach ($alternates as $hreflang => $href): ?>
    <link rel="alternate" hreflang="<?= $esc((string)$hreflang) ?>" href="<?= $esc((string)$href) ?>">
    <?php endforeach; ?>
    <meta property="og:type" content="<?= $esc($s['og_type'] ?? 'website') ?>">
    <meta property="og:site_name" content="<?= $esc(SITE_NAME) ?>">
    <meta property="og:locale" content="<?= $esc($s['locale']) ?>">
    <?php if (isset($alternates['en']) && isset($alternates['ro'])): ?>
    <meta property="og:locale:alternate" content="<?= $esc($lang === 'ro' ? 'en_US' : 'ro_RO') ?>">
    <?php endif; ?>
    <meta property="og:title" content="<?= $esc($s['og_title'] ?? $s['title']) ?>">
    <meta property="og:description" content="<?= $esc($s['description']) ?>">
    <meta property="og:url" content="<?= $esc($s['canonical']) ?>">
    <meta property="og:image" content="<?= $esc($image) ?>">
    <meta property="og:image:secure_url" content="<?= $esc($image) ?>">
    <meta property="og:image:width" content="720">
    <meta property="og:image:height" content="720">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:alt" content="Prof. univ. dr. Sebastian V. Bodu, avocat Baroul București">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $esc($s['og_title'] ?? $s['title']) ?>">
    <meta name="twitter:description" content="<?= $esc($s['description']) ?>">
    <meta name="twitter:image" content="<?= $esc($image) ?>">
    <meta name="twitter:image:alt" content="Prof. univ. dr. Sebastian V. Bodu, avocat Baroul București">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/sebastianbodu.jpg">
    <?php renderWebmasterVerification(); ?>
    <?php
}

function renderSeoJsonLd(string $lang, array $extra = []): void
{
    require_once __DIR__ . '/includes/practices.php';
    $s = seoData($lang);
    $image = SITE_URL . '/sebastianbodu.jpg';
    $practices = [];
    foreach (practiceCatalog() as $slug => $item) {
        $copy = $lang === 'en' ? $item['en_copy'] : $item['ro'];
        $url = $lang === 'en' ? SITE_URL . '/' . $item['en'] : SITE_URL . '/' . $slug;
        $practices[] = [
            '@type' => 'Offer',
            'itemOffered' => [
                '@type' => 'Service',
                'name' => $copy['name'],
                'description' => $copy['short'],
                'url' => $url,
            ],
        ];
    }

    $faqs = [];
    foreach (faqItems($lang) as $faq) {
        $faqs[] = [
            '@type' => 'Question',
            'name' => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $faq['a'],
            ],
        ];
    }

    $homeCrumbName = $lang === 'en' ? 'Home' : 'Acasă';
    $homeUrl = $lang === 'en' ? SITE_URL . '/en.php' : SITE_URL . '/';
    $canonical = $extra['canonical'] ?? $s['canonical'];
    $webpageType = $extra['webpage_type'] ?? 'WebPage';
    $knowsAbout = $lang === 'en'
        ? ['Corporate law', 'Commercial law', 'Tax law', 'Banking law', 'Economic offences', 'Commercial arbitration']
        : ['Drept societar', 'Drept comercial', 'Drept fiscal', 'Drept bancar', 'Criminalitate economică', 'Arbitraj comercial'];
    $schema = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'WebSite',
                '@id' => SITE_URL . '/#website',
                'url' => SITE_URL . '/',
                'name' => SITE_NAME,
                'alternateName' => ['Cabinet Bodu', 'Avocat Bodu', 'Sebastian Bodu avocat'],
                'inLanguage' => ['ro', 'en'],
                'publisher' => ['@id' => SITE_URL . '/#organization'],
            ],
            [
                '@type' => ['LegalService', 'Attorney'],
                '@id' => SITE_URL . '/#organization',
                'name' => $s['org_name'],
                'url' => SITE_URL . '/',
                'image' => $image,
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => $image,
                ],
                'email' => SITE_EMAIL,
                'telephone' => SITE_PHONE,
                'availableLanguage' => ['Romanian', 'English'],
                'areaServed' => [
                    ['@type' => 'City', 'name' => 'București'],
                    ['@type' => 'Country', 'name' => 'Romania'],
                ],
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => 'București',
                    'addressCountry' => 'RO',
                ],
                'contactPoint' => [
                    '@type' => 'ContactPoint',
                    'contactType' => 'customer service',
                    'email' => SITE_EMAIL,
                    'telephone' => SITE_PHONE,
                    'availableLanguage' => ['Romanian', 'English'],
                    'areaServed' => 'RO',
                ],
                'knowsAbout' => $knowsAbout,
                'hasOfferCatalog' => [
                    '@type' => 'OfferCatalog',
                    'name' => $lang === 'en' ? 'Practice areas' : 'Domenii de practică',
                    'itemListElement' => $practices,
                ],
                'founder' => ['@id' => SITE_URL . '/#person'],
                'employee' => ['@id' => SITE_URL . '/#person'],
                'sameAs' => [
                    'https://www.editurarosetti.ro/?id_autor=65',
                    'https://www.ujmag.ro/drept/drept-comercial/tratat-de-drept-societar-editia-2025',
                    'https://www.juridice.ro/author/sebastian-bodu',
                ],
            ],
            [
                '@type' => 'Person',
                '@id' => SITE_URL . '/#person',
                'name' => 'Sebastian V. Bodu',
                'honorificPrefix' => 'Prof. univ. dr.',
                'jobTitle' => $s['job_title'],
                'description' => $s['description'],
                'image' => $image,
                'email' => SITE_EMAIL,
                'telephone' => SITE_PHONE,
                'url' => SITE_URL . '/',
                'worksFor' => ['@id' => SITE_URL . '/#organization'],
                'alumniOf' => [
                    ['@type' => 'CollegeOrUniversity', 'name' => 'Academia de Studii Economice din București'],
                ],
                'memberOf' => [
                    ['@type' => 'Organization', 'name' => 'Baroul București'],
                ],
                'knowsLanguage' => [
                    ['@type' => 'Language', 'name' => 'Romanian'],
                    ['@type' => 'Language', 'name' => 'English'],
                ],
                'knowsAbout' => $knowsAbout,
                'sameAs' => [
                    'https://www.editurarosetti.ro/?id_autor=65',
                    'https://www.juridice.ro/author/sebastian-bodu',
                ],
            ],
            [
                '@type' => 'Book',
                '@id' => SITE_URL . '/#tratat',
                'name' => 'Tratat de drept societar',
                'isbn' => '978-606-025-137-8',
                'datePublished' => '2025',
                'inLanguage' => 'ro',
                'author' => ['@id' => SITE_URL . '/#person'],
                'publisher' => ['@type' => 'Organization', 'name' => 'Editura Rosetti'],
                'url' => 'https://www.ujmag.ro/drept/drept-comercial/tratat-de-drept-societar-editia-2025',
            ],
            [
                '@type' => $webpageType,
                '@id' => $canonical . '#webpage',
                'url' => $canonical,
                'name' => $extra['title'] ?? $s['title'],
                'description' => $extra['description'] ?? $s['description'],
                'inLanguage' => $lang,
                'isPartOf' => ['@id' => SITE_URL . '/#website'],
                'about' => ['@id' => SITE_URL . '/#person'],
                'primaryImageOfPage' => [
                    '@type' => 'ImageObject',
                    'url' => $image,
                ],
                'dateModified' => $extra['dateModified'] ?? seoLastmod(__DIR__ . '/index.php', __DIR__ . '/en.php', __DIR__ . '/seo.php'),
                'breadcrumb' => ['@id' => $canonical . '#breadcrumb'],
                'mainEntity' => $extra['mainEntity'] ?? ['@id' => SITE_URL . '/#organization'],
            ],
            [
                '@type' => 'BreadcrumbList',
                '@id' => $canonical . '#breadcrumb',
                'itemListElement' => $extra['breadcrumbs'] ?? [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => $homeCrumbName, 'item' => $homeUrl],
                ],
            ],
        ],
    ];

    if (empty($extra['skip_faq'])) {
        $schema['@graph'][] = [
            '@type' => 'FAQPage',
            '@id' => SITE_URL . '/#faq',
            'mainEntity' => $faqs,
        ];
    }

    if (isset($extra['service'])) {
        $schema['@graph'][] = $extra['service'];
    }
    if (!empty($extra['graph']) && is_array($extra['graph'])) {
        foreach ($extra['graph'] as $node) {
            $schema['@graph'][] = $node;
        }
    }

    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
}

function sitemapUrls(): array
{
    require_once __DIR__ . '/includes/practices.php';
    require_once __DIR__ . '/includes/articles.php';
    $homeMod = seoLastmod(__DIR__ . '/index.php', __DIR__ . '/seo.php', __DIR__ . '/includes/practices.php');
    $enMod = seoLastmod(__DIR__ . '/en.php', __DIR__ . '/seo.php', __DIR__ . '/includes/practices.php');
    $practiceMod = seoLastmod(__DIR__ . '/serviciu.php', __DIR__ . '/includes/practices.php');
    $urls = [
        [
            'loc' => SITE_URL . '/',
            'lastmod' => $homeMod,
            'priority' => '1.0',
            'hreflang_ro' => SITE_URL . '/',
            'hreflang_en' => SITE_URL . '/en.php',
            'hreflang_default' => SITE_URL . '/',
        ],
        [
            'loc' => SITE_URL . '/en.php',
            'lastmod' => $enMod,
            'priority' => '0.9',
            'hreflang_ro' => SITE_URL . '/',
            'hreflang_en' => SITE_URL . '/en.php',
            'hreflang_default' => SITE_URL . '/',
        ],
    ];
    foreach (practiceCatalog() as $slug => $item) {
        $urls[] = [
            'loc' => SITE_URL . '/' . $slug,
            'lastmod' => $practiceMod,
            'priority' => '0.85',
            'hreflang_ro' => SITE_URL . '/' . $slug,
            'hreflang_en' => SITE_URL . '/' . $item['en'],
            'hreflang_default' => SITE_URL . '/',
        ];
        $urls[] = [
            'loc' => SITE_URL . '/' . $item['en'],
            'lastmod' => $practiceMod,
            'priority' => '0.8',
            'hreflang_ro' => SITE_URL . '/' . $slug,
            'hreflang_en' => SITE_URL . '/' . $item['en'],
            'hreflang_default' => SITE_URL . '/',
        ];
    }

    $indexMeta = articleIndexMeta();
    $urls[] = [
        'loc' => $indexMeta['canonical'],
        'lastmod' => seoLastmod($indexMeta['file_abs'], __DIR__ . '/includes/articles.php'),
        'priority' => '0.75',
        'hreflang_ro' => $indexMeta['canonical'],
        'hreflang_default' => $indexMeta['canonical'],
    ];
    foreach (articleCatalog() as $item) {
        $canonical = SITE_URL . $item['path'];
        $urls[] = [
            'loc' => $canonical,
            'lastmod' => seoLastmod(__DIR__ . '/articole/' . $item['file'], __DIR__ . '/includes/articles.php'),
            'priority' => '0.7',
            'hreflang_ro' => $canonical,
            'hreflang_default' => $canonical,
        ];
    }
    return $urls;
}
