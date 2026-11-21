<?php
declare(strict_types=1);

// IIS URL Rewrite păstrează aici adresa publică folosită de router.
$requestUri = $_SERVER['UNENCODED_URL'] ?? $_SERVER['REQUEST_URI'] ?? '/';
$requestedPath = parse_url($requestUri, PHP_URL_PATH);
$requestedPath = is_string($requestedPath) ? $requestedPath : '';

if (PHP_SAPI === 'cli-server') {
    $assetPath = preg_match('~^/assets/(?:[\w-]+/)*[\w.-]+\.(?:css|js|webp|woff2|mp4|mp3)$~D', $requestedPath);
    if (($assetPath || $requestedPath === '/robots.txt') && is_file(__DIR__ . $requestedPath)) {
        return false;
    }
}

require __DIR__ . '/partials/content.php';

$home = ['ro' => '/', 'en' => '/en/'];
$routes = [
    '/' => ['ro', null],
    '/en/' => ['en', null],
];
foreach ($practiceAreas as $key => $area) {
    foreach ($area as $language => $translation) {
        $routes[$translation['path']] = [$language, $key];
    }
}

function esc(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

if ($requestedPath === '/sitemap.xml') {
    header('Content-Type: application/xml; charset=UTF-8');
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
    foreach (array_keys($routes) as $path) {
        echo '  <url><loc>' . esc($site['url'] . $path) . "</loc></url>\n";
    }
    echo "</urlset>\n";
    return;
}

$path = match ($requestedPath) {
    '/index.php' => '/',
    '/en', '/en.php' => '/en/',
    default => $requestedPath,
};
if (!isset($routes[$path]) && isset($routes[rtrim($path, '/')])) {
    $path = rtrim($path, '/');
}
if ($path !== $requestedPath && isset($routes[$path])) {
    header('Location: ' . $path, true, 301);
    return;
}

$notFound = !isset($routes[$path]);
if ($notFound) {
    http_response_code(404);
}
[$language, $practiceKey] = $routes[$path] ?? [str_starts_with($path, '/en/') ? 'en' : 'ro', null];
$labels = $copy[$language];
$otherLanguage = $language === 'ro' ? 'en' : 'ro';
$practice = $practiceKey === null ? null : $practiceAreas[$practiceKey][$language];
$alternates = $practiceKey === null ? $home : [
    'ro' => $practiceAreas[$practiceKey]['ro']['path'],
    'en' => $practiceAreas[$practiceKey]['en']['path'],
];
$place = $language === 'ro' ? 'Avocat Constanța' : 'Constanța Lawyer';
$title = $notFound ? $labels['notFound'] . ' | ' . $site['name'] : $labels['title'];
if ($practice !== null) {
    $title = $practice['title'] . ' | ' . $place . ' · ' . $site['name'];
}
$description = $practice['description'] ?? $labels['description'];
$canonical = $site['url'] . $path;
$homePath = $home[$language];
$contactPath = $notFound ? $homePath . '#contact' : '#contact';
$navLinks = [
    $homePath . '#practica' => $labels['practice'],
    $homePath . '#presa' => $labels['press'],
];
$telephoneHref = 'tel:' . $site['telephone'];
$schema = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'LegalService',
            '@id' => $site['url'] . '/#cabinet',
            'name' => $site['name'] . ' – Cabinet de avocat',
            'url' => $site['url'] . '/',
            'telephone' => $site['telephone'],
            'areaServed' => ['@type' => 'Country', 'name' => 'România'],
        ],
        [
            '@type' => 'Person',
            '@id' => $site['url'] . '/#avocat',
            'name' => $site['name'],
            'jobTitle' => $language === 'ro' ? 'Avocat' : 'Lawyer',
            'worksFor' => ['@id' => $site['url'] . '/#cabinet'],
            'memberOf' => ['@type' => 'Organization', 'name' => 'Baroul Constanța'],
        ],
        [
            '@type' => 'WebPage',
            '@id' => $canonical . '#pagina',
            'url' => $canonical,
            'name' => $title,
            'inLanguage' => $language,
            'mainEntity' => ['@id' => $practice ? $canonical . '#serviciu' : $site['url'] . '/#avocat'],
        ],
    ],
];
if ($practice !== null) {
    $schema['@graph'][] = [
        '@type' => 'Service',
        '@id' => $canonical . '#serviciu',
        'name' => $practice['title'],
        'description' => $practice['description'],
        'provider' => ['@id' => $site['url'] . '/#cabinet'],
    ];
}

require __DIR__ . '/partials/page.php';
