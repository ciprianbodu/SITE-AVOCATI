<?php
require_once __DIR__ . '/seo.php';
require_once __DIR__ . '/includes/practices.php';

header('Content-Type: application/xml; charset=UTF-8');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
<?php foreach (sitemapUrls() as $u): ?>
    <url>
        <loc><?= htmlspecialchars($u['loc'], ENT_QUOTES, 'UTF-8') ?></loc>
        <xhtml:link rel="alternate" hreflang="ro" href="<?= htmlspecialchars($u['hreflang_ro'], ENT_QUOTES, 'UTF-8') ?>"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?= htmlspecialchars($u['hreflang_en'], ENT_QUOTES, 'UTF-8') ?>"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="<?= htmlspecialchars(SITE_URL . '/', ENT_QUOTES, 'UTF-8') ?>"/>
        <lastmod><?= htmlspecialchars($u['lastmod'], ENT_QUOTES, 'UTF-8') ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority><?= htmlspecialchars($u['priority'], ENT_QUOTES, 'UTF-8') ?></priority>
<?php if ($u['loc'] === SITE_URL . '/'): ?>
        <image:image>
            <image:loc><?= htmlspecialchars(SITE_URL . '/sebastianbodu.jpg', ENT_QUOTES, 'UTF-8') ?></image:loc>
            <image:title>Prof. univ. dr. Sebastian V. Bodu — avocat Baroul București</image:title>
        </image:image>
<?php endif; ?>
    </url>
<?php endforeach; ?>
</urlset>
