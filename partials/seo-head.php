<?php
/**
 * SEO meta tags — setează $seo înainte de include.
 * @var array $seo
 */
$seo = array_merge([
    'lang' => 'ro',
    'title' => 'Alina-Maria Mitescu | MITESCU LEGAL',
    'description' => '',
    'keywords' => '',
    'canonical' => 'https://www.mitescu.ro/',
    'robots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
    'og_type' => 'website',
    'og_image' => 'https://www.mitescu.ro/alina-mitescu.jpg',
    'og_locale' => 'ro_RO',
    'alternate_en' => 'https://www.mitescu.ro/en.php',
    'alternate_ro' => 'https://www.mitescu.ro/',
    'jsonld_name' => 'MITESCU LEGAL',
], $seo ?? []);

$esc = static fn(string $s): string => htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
?>
    <meta name="description" content="<?= $esc($seo['description']) ?>">
    <meta name="keywords" content="<?= $esc($seo['keywords']) ?>">
    <meta name="author" content="Alina-Maria Mitescu">
    <meta name="robots" content="<?= $esc($seo['robots']) ?>">
    <meta name="googlebot" content="<?= $esc($seo['robots']) ?>">
    <meta name="bingbot" content="<?= $esc($seo['robots']) ?>">
    <meta name="geo.region" content="RO">
    <meta name="geo.placename" content="România">
    <title><?= $esc($seo['title']) ?></title>
    <link rel="canonical" href="<?= $esc($seo['canonical']) ?>">
    <link rel="alternate" hreflang="ro" href="<?= $esc($seo['alternate_ro']) ?>">
    <link rel="alternate" hreflang="en" href="<?= $esc($seo['alternate_en']) ?>">
    <link rel="alternate" hreflang="x-default" href="<?= $esc($seo['alternate_ro']) ?>">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <meta property="og:site_name" content="MITESCU LEGAL">
    <meta property="og:type" content="<?= $esc($seo['og_type']) ?>">
    <meta property="og:url" content="<?= $esc($seo['canonical']) ?>">
    <meta property="og:title" content="<?= $esc($seo['title']) ?>">
    <meta property="og:description" content="<?= $esc($seo['description']) ?>">
    <meta property="og:image" content="<?= $esc($seo['og_image']) ?>">
    <meta property="og:locale" content="<?= $esc($seo['og_locale']) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $esc($seo['title']) ?>">
    <meta name="twitter:description" content="<?= $esc($seo['description']) ?>">
    <meta name="twitter:image" content="<?= $esc($seo['og_image']) ?>">
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "LegalService",
                "@id": "https://www.mitescu.ro/#organization",
                "name": "MITESCU LEGAL",
                "url": "https://www.mitescu.ro/",
                "logo": "https://www.mitescu.ro/logo.svg",
                "image": "https://www.mitescu.ro/alina-mitescu.jpg",
                "description": <?= json_encode($seo['description'], JSON_UNESCAPED_UNICODE) ?>,
                "telephone": "+40-726-055-677",
                "email": "contact@mitescu.ro",
                "areaServed": { "@type": "Country", "name": "România" },
                "address": { "@type": "PostalAddress", "addressCountry": "RO" },
                "priceRange": "$$",
                "knowsAbout": ["Drept civil", "Optimizare fiscală", "Evaziune fiscală", "Drept penal", "Infracțiuni de serviciu", "Corupție"],
                "sameAs": ["https://www.mitescu.ro/"]
            },
            {
                "@type": "Attorney",
                "@id": "https://www.mitescu.ro/#attorney",
                "name": "Alina-Maria Mitescu",
                "jobTitle": "Avocat titular",
                "worksFor": { "@id": "https://www.mitescu.ro/#organization" },
                "image": "https://www.mitescu.ro/alina-mitescu.jpg",
                "url": "https://www.mitescu.ro/"
            },
            {
                "@type": "WebSite",
                "@id": "https://www.mitescu.ro/#website",
                "url": "https://www.mitescu.ro/",
                "name": "MITESCU LEGAL",
                "publisher": { "@id": "https://www.mitescu.ro/#organization" },
                "inLanguage": ["ro", "en"]
            },
            {
                "@type": "WebPage",
                "@id": "<?= $esc($seo['canonical']) ?>#webpage",
                "url": "<?= $esc($seo['canonical']) ?>",
                "name": <?= json_encode($seo['title'], JSON_UNESCAPED_UNICODE) ?>,
                "description": <?= json_encode($seo['description'], JSON_UNESCAPED_UNICODE) ?>,
                "isPartOf": { "@id": "https://www.mitescu.ro/#website" },
                "about": { "@id": "https://www.mitescu.ro/#organization" },
                "inLanguage": "<?= $esc($seo['lang']) ?>"
            }
        ]
    }
    </script>
