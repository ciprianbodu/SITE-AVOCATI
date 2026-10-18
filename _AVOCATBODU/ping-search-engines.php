<?php
/**
 * Rulează o singură dată după deploy pentru a notifica motoarele de căutare.
 * Accesează: https://avocatbodu.ro/ping-search-engines.php
 * Șterge sau protejează fișierul după utilizare.
 */
require __DIR__ . '/seo.php';

header('Content-Type: text/plain; charset=utf-8');
header('X-Robots-Tag: noindex, nofollow');

$urls = array_map(fn($u) => $u['loc'], sitemapUrls());
$urls[] = SITE_URL . '/sitemap.xml';

$results = [];

// Ping sitemap — Google (legacy)
$results['google_sitemap'] = @file_get_contents(
    'https://www.google.com/ping?sitemap=' . urlencode(SITE_URL . '/sitemap.xml')
) !== false ? 'OK' : 'Eșuat';

// Ping sitemap — Bing
$results['bing_sitemap'] = @file_get_contents(
    'https://www.bing.com/ping?sitemap=' . urlencode(SITE_URL . '/sitemap.xml')
) !== false ? 'OK' : 'Eșuat';

// IndexNow (Bing, Yandex și alții)
$indexNowKey = 'avocatbodu-indexnow-key-2026';
$keyFile = __DIR__ . '/' . $indexNowKey . '.txt';
if (!file_exists($keyFile)) {
    file_put_contents($keyFile, $indexNowKey);
}

$payload = json_encode([
    'host' => 'avocatbodu.ro',
    'key' => $indexNowKey,
    'keyLocation' => SITE_URL . '/' . $indexNowKey . '.txt',
    'urlList' => array_values(array_filter($urls, fn($u) => !str_contains($u, 'sitemap.xml'))),
]);

$ch = curl_init('https://api.indexnow.org/indexnow');
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json; charset=utf-8'],
    CURLOPT_POSTFIELDS => $payload,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 15,
]);
$indexNowResponse = curl_exec($ch);
$indexNowCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
$results['indexnow'] = ($indexNowCode >= 200 && $indexNowCode < 300) ? 'OK (HTTP ' . $indexNowCode . ')' : 'Eșuat (HTTP ' . $indexNowCode . ')';

echo "Notificare motoare de căutare — avocatbodu.ro\n";
echo str_repeat('-', 45) . "\n";
foreach ($results as $engine => $status) {
    echo str_pad($engine, 20) . ': ' . $status . "\n";
}
echo "\nRecomandat: înregistrează site-ul în Google Search Console și Bing Webmaster Tools.\n";
echo "Sitemap: " . SITE_URL . "/sitemap.xml\n";
