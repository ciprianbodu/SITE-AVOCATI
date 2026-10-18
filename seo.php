<?php
define('SITE_URL', 'https://avocatbodu.ro');
define('SITE_NAME', 'Cabinet de Avocat Prof. univ. dr. Sebastian V. Bodu');

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
            'title'      => 'Avocat drept societar și comercial București | Sebastian V. Bodu',
            'description'=> 'Avocat definitiv Baroul București din 1996. Drept societar, comercial, fiscal, bancar, criminalitate economică și arbitraj. Consultanță pentru societăți și investitori.',
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
            'title'      => 'Corporate & commercial lawyer in Bucharest | Sebastian V. Bodu',
            'description'=> 'Attorney at the Bucharest Bar since 1996. Corporate, commercial, tax, banking law, economic offences and arbitration. Counsel for companies and investors.',
            'keywords'   => 'lawyer Bucharest, corporate lawyer Romania, commercial lawyer, business attorney, Sebastian Bodu, tax law, white-collar crime, commercial arbitration, Bucharest Bar',
            'og_title'   => 'Corporate & commercial lawyer in Bucharest | Bodu Law Office',
            'job_title'  => 'Attorney at Law, Full Professor',
            'org_name'   => 'Law Office of Prof. Dr. Sebastian V. Bodu',
        ],
    ];
    return $data[$lang] ?? $data['ro'];
}

function renderSeoHead(string $lang, ?array $override = null): void
{
    $s = $override ? array_merge(seoData($lang), $override) : seoData($lang);
    $image = SITE_URL . '/sebastianbodu.jpg';
    $esc = fn($v) => htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
    ?>
    <meta name="description" content="<?= $esc($s['description']) ?>">
    <meta name="keywords" content="<?= $esc($s['keywords'] ?? seoData($lang)['keywords']) ?>">
    <meta name="author" content="Prof. univ. dr. Sebastian V. Bodu">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    <meta name="bingbot" content="index, follow">
    <meta name="geo.region" content="RO-B">
    <meta name="geo.placename" content="București">
    <link rel="canonical" href="<?= $esc($s['canonical']) ?>">
    <link rel="alternate" hreflang="ro" href="<?= $esc($s['hreflang_ro'] ?? SITE_URL . '/') ?>">
    <link rel="alternate" hreflang="en" href="<?= $esc($s['hreflang_en'] ?? SITE_URL . '/en.php') ?>">
    <link rel="alternate" hreflang="x-default" href="<?= $esc(SITE_URL . '/') ?>">
    <meta property="og:type" content="<?= $esc($s['og_type'] ?? 'website') ?>">
    <meta property="og:site_name" content="<?= $esc(SITE_NAME) ?>">
    <meta property="og:locale" content="<?= $esc($s['locale']) ?>">
    <meta property="og:locale:alternate" content="<?= $esc($lang === 'ro' ? 'en_US' : 'ro_RO') ?>">
    <meta property="og:title" content="<?= $esc($s['og_title'] ?? $s['title']) ?>">
    <meta property="og:description" content="<?= $esc($s['description']) ?>">
    <meta property="og:url" content="<?= $esc($s['canonical']) ?>">
    <meta property="og:image" content="<?= $esc($image) ?>">
    <meta property="og:image:width" content="720">
    <meta property="og:image:height" content="720">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:alt" content="Prof. univ. dr. Sebastian V. Bodu, avocat Baroul București">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $esc($s['og_title'] ?? $s['title']) ?>">
    <meta name="twitter:description" content="<?= $esc($s['description']) ?>">
    <meta name="twitter:image" content="<?= $esc($image) ?>">
    <meta name="theme-color" content="#0B1320">
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
                'logo' => SITE_URL . '/favicon.svg',
                'email' => 'bodu.sebastian@gmail.com',
                'areaServed' => [
                    ['@type' => 'City', 'name' => 'București'],
                    ['@type' => 'Country', 'name' => 'Romania'],
                ],
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => 'București',
                    'addressCountry' => 'RO',
                ],
                'knowsAbout' => [
                    'Drept societar', 'Drept comercial', 'Drept fiscal',
                    'Drept bancar', 'Criminalitate economică', 'Arbitraj comercial',
                ],
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
                ],
            ],
            [
                '@type' => 'Person',
                '@id' => SITE_URL . '/#person',
                'name' => 'Sebastian V. Bodu',
                'honorificPrefix' => 'Prof. univ. dr.',
                'jobTitle' => $s['job_title'],
                'image' => $image,
                'email' => 'bodu.sebastian@gmail.com',
                'url' => SITE_URL . '/',
                'worksFor' => ['@id' => SITE_URL . '/#organization'],
                'alumniOf' => [
                    ['@type' => 'CollegeOrUniversity', 'name' => 'Academia de Studii Economice din București'],
                ],
                'memberOf' => [
                    ['@type' => 'Organization', 'name' => 'Baroul București'],
                ],
                'knowsAbout' => ['Drept societar', 'Drept comercial', 'Dreptul afacerilor'],
                'sameAs' => [
                    'https://www.editurarosetti.ro/?id_autor=65',
                ],
            ],
            [
                '@type' => 'Book',
                '@id' => SITE_URL . '/#tratat',
                'name' => 'Tratat de drept societar',
                'datePublished' => '2025',
                'inLanguage' => 'ro',
                'author' => ['@id' => SITE_URL . '/#person'],
                'publisher' => ['@type' => 'Organization', 'name' => 'Editura Rosetti'],
                'url' => 'https://www.ujmag.ro/drept/drept-comercial/tratat-de-drept-societar-editia-2025',
            ],
            [
                '@type' => 'WebPage',
                '@id' => ($extra['canonical'] ?? $s['canonical']) . '#webpage',
                'url' => $extra['canonical'] ?? $s['canonical'],
                'name' => $extra['title'] ?? $s['title'],
                'description' => $extra['description'] ?? $s['description'],
                'inLanguage' => $lang,
                'isPartOf' => ['@id' => SITE_URL . '/#website'],
                'about' => ['@id' => SITE_URL . '/#person'],
                'primaryImageOfPage' => $image,
            ],
            [
                '@type' => 'BreadcrumbList',
                '@id' => ($extra['canonical'] ?? $s['canonical']) . '#breadcrumb',
                'itemListElement' => $extra['breadcrumbs'] ?? [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => $homeCrumbName, 'item' => SITE_URL . '/'],
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

    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
}

function sitemapUrls(): array
{
    require_once __DIR__ . '/includes/practices.php';
    $today = date('Y-m-d');
    $urls = [
        ['loc' => SITE_URL . '/', 'lastmod' => $today, 'priority' => '1.0', 'hreflang_ro' => SITE_URL . '/', 'hreflang_en' => SITE_URL . '/en.php'],
        ['loc' => SITE_URL . '/en.php', 'lastmod' => $today, 'priority' => '0.9', 'hreflang_ro' => SITE_URL . '/', 'hreflang_en' => SITE_URL . '/en.php'],
    ];
    foreach (practiceCatalog() as $slug => $item) {
        $urls[] = [
            'loc' => SITE_URL . '/' . $slug,
            'lastmod' => $today,
            'priority' => '0.85',
            'hreflang_ro' => SITE_URL . '/' . $slug,
            'hreflang_en' => SITE_URL . '/' . $item['en'],
        ];
        $urls[] = [
            'loc' => SITE_URL . '/' . $item['en'],
            'lastmod' => $today,
            'priority' => '0.8',
            'hreflang_ro' => SITE_URL . '/' . $slug,
            'hreflang_en' => SITE_URL . '/' . $item['en'],
        ];
    }
    return $urls;
}
