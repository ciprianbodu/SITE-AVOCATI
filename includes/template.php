<?php
if (!defined('SITE_BOOTSTRAP')) {
    http_response_code(403);
    exit;
}
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($t['html_lang'], ENT_QUOTES, 'UTF-8') ?>" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($t['meta_title'], ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="description" content="<?= htmlspecialchars($t['meta_description'], ENT_QUOTES, 'UTF-8') ?>">
    <meta name="keywords" content="<?= htmlspecialchars($t['meta_keywords'], ENT_QUOTES, 'UTF-8') ?>">
    <meta name="author" content="Prof. univ. dr. Sebastian V. Bodu">
    <meta name="theme-color" content="#f3ead9">
    <meta name="robots" content="index, follow">
    <meta name="google-site-verification" content="2ne_mFDmEK8H5LesW-0uQZ7KLLhulX7OpsrFm_IHSIM">
    <link rel="canonical" href="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>">
    <link rel="alternate" hreflang="ro" href="<?= htmlspecialchars($hreflangRo, ENT_QUOTES, 'UTF-8') ?>">
    <link rel="alternate" hreflang="en" href="<?= htmlspecialchars($hreflangEn, ENT_QUOTES, 'UTF-8') ?>">
    <link rel="alternate" hreflang="x-default" href="<?= htmlspecialchars($hreflangRo, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="<?= htmlspecialchars($t['og_locale'], ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:title" content="<?= htmlspecialchars($t['meta_title'], ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:description" content="<?= htmlspecialchars($t['meta_description'], ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:url" content="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:image" content="<?= htmlspecialchars(SITE_URL . '/sebastianbodu.jpg', ENT_QUOTES, 'UTF-8') ?>">
    <meta name="twitter:card" content="summary">
    <link rel="icon" type="image/svg+xml" href="assets/img/favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preload" as="image" href="sebastianbodu.jpg">
    <link rel="stylesheet" href="assets/css/site.css?v=<?= (int) $assetVersion ?>">
    <script type="application/ld+json">
    <?= json_encode([
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'LegalService',
                '@id' => SITE_URL . '/#chambers',
                'name' => SITE_NAME,
                'url' => SITE_URL,
                'email' => PUBLIC_EMAIL,
                'image' => SITE_URL . '/sebastianbodu.jpg',
                'areaServed' => ['RO', 'EU'],
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => 'București',
                    'addressCountry' => 'RO',
                ],
                'founder' => ['@id' => SITE_URL . '/#person'],
            ],
            [
                '@type' => 'Person',
                '@id' => SITE_URL . '/#person',
                'name' => 'Sebastian V. Bodu',
                'honorificPrefix' => 'Prof. univ. dr.',
                'jobTitle' => $t['jsonld_job'],
                'image' => SITE_URL . '/sebastianbodu.jpg',
                'url' => SITE_URL,
                'email' => PUBLIC_EMAIL,
                'worksFor' => ['@id' => SITE_URL . '/#chambers'],
                'alumniOf' => 'Academia de Studii Economice din București',
                'memberOf' => 'Baroul București',
            ],
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_PRETTY_PRINT) ?>
    </script>
</head>
<body>
    <a class="skip-link" href="#continut"><?= htmlspecialchars($t['skip'], ENT_QUOTES, 'UTF-8') ?></a>
    <audio id="bgMusic" loop preload="none"><source src="background-law.mp3" type="audio/mpeg"></audio>
    <div class="topbar" aria-hidden="true"></div>
    <p class="letterhead">
        <span><?= htmlspecialchars($t['letter_1'], ENT_QUOTES, 'UTF-8') ?></span>
        <span><?= htmlspecialchars($t['letter_2'], ENT_QUOTES, 'UTF-8') ?></span>
        <span><?= htmlspecialchars($t['letter_3'], ENT_QUOTES, 'UTF-8') ?></span>
    </p>

    <header class="site-header" id="top">
        <div class="shell header-inner">
            <a class="brand" href="#top">
                <span class="brand-mark" aria-hidden="true">SB</span>
                <span class="brand-text">
                    <strong><?= htmlspecialchars($t['nav_brand'], ENT_QUOTES, 'UTF-8') ?></strong>
                    <small><?= htmlspecialchars($t['brand_sub'], ENT_QUOTES, 'UTF-8') ?></small>
                </span>
            </a>
            <nav class="nav-desktop" aria-label="Principal">
                <a href="#cabinet"><?= htmlspecialchars($t['nav_cabinet'], ENT_QUOTES, 'UTF-8') ?></a>
                <a href="#practici"><?= htmlspecialchars($t['nav_practice'], ENT_QUOTES, 'UTF-8') ?></a>
                <a href="#publicatii"><?= htmlspecialchars($t['nav_books'], ENT_QUOTES, 'UTF-8') ?></a>
                <a href="#monitor"><?= htmlspecialchars($t['nav_monitor'], ENT_QUOTES, 'UTF-8') ?></a>
                <a class="nav-cta" href="#contact"><?= htmlspecialchars($t['nav_contact'], ENT_QUOTES, 'UTF-8') ?></a>
            </nav>
            <div class="header-tools">
                <div class="lang" role="navigation" aria-label="Language">
                    <?php if ($lang === 'ro'): ?>
                        <span class="is-active" aria-current="page">RO</span>
                        <span aria-hidden="true">·</span>
                        <a href="en.php">EN</a>
                    <?php else: ?>
                        <a href="index.php">RO</a>
                        <span aria-hidden="true">·</span>
                        <span class="is-active" aria-current="page">EN</span>
                    <?php endif; ?>
                </div>
                <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="nav-mobile" data-nav-toggle>
                    <span class="sr-only"><?= htmlspecialchars($t['nav_open'], ENT_QUOTES, 'UTF-8') ?></span>
                    <span></span><span></span>
                </button>
            </div>
        </div>
        <nav class="nav-mobile" id="nav-mobile" hidden>
            <a href="#cabinet"><?= htmlspecialchars($t['nav_cabinet'], ENT_QUOTES, 'UTF-8') ?></a>
            <a href="#practici"><?= htmlspecialchars($t['nav_practice'], ENT_QUOTES, 'UTF-8') ?></a>
            <a href="#publicatii"><?= htmlspecialchars($t['nav_books'], ENT_QUOTES, 'UTF-8') ?></a>
            <a href="#monitor"><?= htmlspecialchars($t['nav_monitor'], ENT_QUOTES, 'UTF-8') ?></a>
            <a href="#contact"><?= htmlspecialchars($t['nav_contact'], ENT_QUOTES, 'UTF-8') ?></a>
        </nav>
    </header>

    <main id="continut">
        <section class="hero">
            <div class="shell hero-grid">
                <div class="hero-copy reveal">
                    <p class="kicker"><?= htmlspecialchars($t['hero_kicker'], ENT_QUOTES, 'UTF-8') ?></p>
                    <h1>
                        <span class="hero-prefix"><?= htmlspecialchars($t['hero_name'], ENT_QUOTES, 'UTF-8') ?></span>
                        <span class="hero-name"><?= htmlspecialchars($t['hero_name_accent'], ENT_QUOTES, 'UTF-8') ?></span>
                    </h1>
                    <p class="hero-titles"><?= htmlspecialchars($t['hero_titles'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p class="hero-lead"><?= htmlspecialchars($t['hero_lead'], ENT_QUOTES, 'UTF-8') ?></p>
                    <div class="hero-actions">
                        <a class="btn btn-gold" href="#contact"><?= htmlspecialchars($t['hero_cta'], ENT_QUOTES, 'UTF-8') ?></a>
                        <a class="btn btn-ghost" href="#practici"><?= htmlspecialchars($t['hero_cta_secondary'], ENT_QUOTES, 'UTF-8') ?></a>
                    </div>
                </div>
                <figure class="hero-portrait reveal">
                    <div class="portrait-frame">
                        <img src="sebastianbodu.jpg" width="640" height="800" alt="<?= htmlspecialchars($t['photo_alt'], ENT_QUOTES, 'UTF-8') ?>">
                    </div>
                    <figcaption><?= htmlspecialchars($t['hero_caption'], ENT_QUOTES, 'UTF-8') ?></figcaption>
                </figure>
            </div>
        </section>

        <section class="stats" aria-label="Credentials">
            <div class="shell stats-grid">
                <div class="stat">
                    <strong><?= htmlspecialchars($t['stat_1_value'], ENT_QUOTES, 'UTF-8') ?></strong>
                    <span><?= htmlspecialchars($t['stat_1_label'], ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <div class="stat">
                    <strong><?= htmlspecialchars($t['stat_2_value'], ENT_QUOTES, 'UTF-8') ?></strong>
                    <span><?= htmlspecialchars($t['stat_2_label'], ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <div class="stat">
                    <strong><?= htmlspecialchars($t['stat_3_value'], ENT_QUOTES, 'UTF-8') ?></strong>
                    <span><?= htmlspecialchars($t['stat_3_label'], ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <div class="stat">
                    <strong><?= htmlspecialchars($t['stat_4_value'], ENT_QUOTES, 'UTF-8') ?></strong>
                    <span><?= htmlspecialchars($t['stat_4_label'], ENT_QUOTES, 'UTF-8') ?></span>
                </div>
            </div>
        </section>

        <section class="section section-ink" id="practici">
            <div class="shell">
                <header class="section-head reveal">
                    <p class="kicker"><?= htmlspecialchars($t['practice_kicker'], ENT_QUOTES, 'UTF-8') ?></p>
                    <h2><?= htmlspecialchars($t['practice_title'], ENT_QUOTES, 'UTF-8') ?></h2>
                    <p class="section-lead"><?= htmlspecialchars($t['practice_lead'], ENT_QUOTES, 'UTF-8') ?></p>
                </header>
                <div class="practice-grid">
                    <?php foreach ($t['practices'] as $i => $item): ?>
                    <article class="practice-card reveal" style="--d: <?= (int) $i * 60 ?>ms">
                        <span class="roman" aria-hidden="true"><?= ['I', 'II', 'III', 'IV', 'V', 'VI'][$i] ?></span>
                        <h3><?= htmlspecialchars($item[0], ENT_QUOTES, 'UTF-8') ?></h3>
                        <p><?= htmlspecialchars($item[1], ENT_QUOTES, 'UTF-8') ?></p>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="section section-ivory" id="cabinet">
            <div class="shell split">
                <div class="prose reveal">
                    <p class="kicker kicker-dark"><?= htmlspecialchars($t['profile_kicker'], ENT_QUOTES, 'UTF-8') ?></p>
                    <h2><?= htmlspecialchars($t['profile_title'], ENT_QUOTES, 'UTF-8') ?></h2>
                    <p><?= $t['profile_p1'] ?></p>
                    <p><?= $t['profile_p2'] ?></p>
                    <p><?= $t['profile_p3'] ?></p>
                </div>
                <aside class="profile-aside reveal">
                    <div class="portrait-frame portrait-frame-light">
                        <img src="sebastianbodu.jpg" width="480" height="600" alt="<?= htmlspecialchars($t['photo_alt'], ENT_QUOTES, 'UTF-8') ?>" loading="lazy">
                    </div>
                </aside>
            </div>
            <div class="shell pillars">
                <header class="section-head section-head-compact reveal">
                    <p class="kicker kicker-dark"><?= htmlspecialchars($t['pillars_kicker'], ENT_QUOTES, 'UTF-8') ?></p>
                    <h2><?= htmlspecialchars($t['pillars_title'], ENT_QUOTES, 'UTF-8') ?></h2>
                </header>
                <div class="pillar-grid">
                    <?php foreach ($t['pillars'] as $i => $pillar): ?>
                    <article class="pillar reveal" style="--d: <?= (int) $i * 80 ?>ms">
                        <span class="pillar-index">0<?= $i + 1 ?></span>
                        <h3><?= htmlspecialchars($pillar[0], ENT_QUOTES, 'UTF-8') ?></h3>
                        <p><?= htmlspecialchars($pillar[1], ENT_QUOTES, 'UTF-8') ?></p>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="section section-ink" id="publicatii">
            <div class="shell">
                <header class="section-head reveal">
                    <p class="kicker"><?= htmlspecialchars($t['books_kicker'], ENT_QUOTES, 'UTF-8') ?></p>
                    <h2><?= htmlspecialchars($t['books_title'], ENT_QUOTES, 'UTF-8') ?></h2>
                </header>
                <blockquote class="quote reveal">
                    <p>„<?= htmlspecialchars($t['books_quote'], ENT_QUOTES, 'UTF-8') ?>”</p>
                    <footer><?= $t['books_note'] ?></footer>
                </blockquote>
                <div class="book-grid">
                    <?php foreach ($t['books'] as $i => $book): ?>
                    <a class="book-card reveal" href="<?= htmlspecialchars($book[2], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer" style="--d: <?= (int) $i * 70 ?>ms">
                        <span class="book-source"><?= htmlspecialchars($book[0], ENT_QUOTES, 'UTF-8') ?></span>
                        <h3><?= htmlspecialchars($book[1], ENT_QUOTES, 'UTF-8') ?></h3>
                        <span class="book-cta"><?= htmlspecialchars($book[3] === 'view' ? $t['book_view'] : $t['book_order'], ENT_QUOTES, 'UTF-8') ?> →</span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="monitor" id="monitor">
            <div class="shell monitor-inner reveal">
                <div>
                    <p class="kicker"><?= htmlspecialchars($t['monitor_kicker'], ENT_QUOTES, 'UTF-8') ?></p>
                    <h2><?= htmlspecialchars($t['monitor_title'], ENT_QUOTES, 'UTF-8') ?></h2>
                    <p><?= htmlspecialchars($t['monitor_lead'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
                <a class="btn btn-gold" href="<?= htmlspecialchars(MONITOR_URL, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer"><?= htmlspecialchars($t['monitor_cta'], ENT_QUOTES, 'UTF-8') ?></a>
            </div>
        </section>

        <section class="section section-ivory" id="contact">
            <div class="shell contact-grid">
                <div class="prose reveal">
                    <p class="kicker kicker-dark"><?= htmlspecialchars($t['contact_kicker'], ENT_QUOTES, 'UTF-8') ?></p>
                    <h2><?= htmlspecialchars($t['contact_title'], ENT_QUOTES, 'UTF-8') ?></h2>
                    <p><?= htmlspecialchars($t['contact_lead'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p class="direct-mail">
                        <span><?= htmlspecialchars($t['contact_direct'], ENT_QUOTES, 'UTF-8') ?></span>
                        <a href="mailto:<?= htmlspecialchars(PUBLIC_EMAIL, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(PUBLIC_EMAIL, ENT_QUOTES, 'UTF-8') ?></a>
                    </p>
                </div>
                <div class="contact-card reveal">
                    <?php if ($statusMessage === 'success'): ?>
                        <p class="alert alert-ok" role="status"><?= htmlspecialchars($t['form_success'], ENT_QUOTES, 'UTF-8') ?></p>
                    <?php elseif ($statusMessage === 'error'): ?>
                        <p class="alert alert-err" role="alert"><?= htmlspecialchars($t['form_error'], ENT_QUOTES, 'UTF-8') ?></p>
                    <?php elseif ($statusMessage === 'invalid'): ?>
                        <p class="alert alert-err" role="alert"><?= htmlspecialchars($t['form_invalid'], ENT_QUOTES, 'UTF-8') ?></p>
                    <?php endif; ?>

                    <?php if ($statusMessage !== 'success'): ?>
                    <form action="<?= htmlspecialchars($pageFile, ENT_QUOTES, 'UTF-8') ?>#contact" method="post" novalidate>
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
                        <p class="hp" aria-hidden="true">
                            <label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                        </p>
                        <div class="form-row">
                            <label>
                                <span><?= htmlspecialchars($t['form_name'], ENT_QUOTES, 'UTF-8') ?></span>
                                <input type="text" name="nume" required maxlength="120" autocomplete="name" value="<?= $statusMessage === 'invalid' ? htmlspecialchars((string) ($_POST['nume'] ?? ''), ENT_QUOTES, 'UTF-8') : '' ?>">
                            </label>
                            <label>
                                <span><?= htmlspecialchars($t['form_email'], ENT_QUOTES, 'UTF-8') ?></span>
                                <input type="email" name="email" required maxlength="180" autocomplete="email" value="<?= $statusMessage === 'invalid' ? htmlspecialchars((string) ($_POST['email'] ?? ''), ENT_QUOTES, 'UTF-8') : '' ?>">
                            </label>
                        </div>
                        <label>
                            <span><?= htmlspecialchars($t['form_phone'], ENT_QUOTES, 'UTF-8') ?></span>
                            <input type="tel" name="telefon" maxlength="40" autocomplete="tel" value="<?= $statusMessage === 'invalid' ? htmlspecialchars((string) ($_POST['telefon'] ?? ''), ENT_QUOTES, 'UTF-8') : '' ?>">
                        </label>
                        <label>
                            <span><?= htmlspecialchars($t['form_message'], ENT_QUOTES, 'UTF-8') ?></span>
                            <textarea name="mesaj" rows="5" required minlength="10" maxlength="4000"><?= $statusMessage === 'invalid' ? htmlspecialchars((string) ($_POST['mesaj'] ?? ''), ENT_QUOTES, 'UTF-8') : '' ?></textarea>
                        </label>
                        <label class="consent">
                            <input type="checkbox" name="consent" value="1" required <?= $statusMessage === 'invalid' && isset($_POST['consent']) ? 'checked' : '' ?>>
                            <span><?= htmlspecialchars($t['form_consent'], ENT_QUOTES, 'UTF-8') ?></span>
                        </label>
                        <button class="btn btn-gold btn-block" type="submit" name="trimite_contact" value="1"><?= htmlspecialchars($t['form_submit'], ENT_QUOTES, 'UTF-8') ?></button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="shell footer-inner">
            <div class="brand brand-footer">
                <span class="brand-mark" aria-hidden="true">SB</span>
                <span class="brand-text">
                    <strong><?= htmlspecialchars($t['footer_copy'], ENT_QUOTES, 'UTF-8') ?></strong>
                    <small><?= htmlspecialchars($t['footer_bar'], ENT_QUOTES, 'UTF-8') ?></small>
                </span>
            </div>
            <p><?= htmlspecialchars($t['footer_conf'], ENT_QUOTES, 'UTF-8') ?> · avocatbodu.ro · <?= date('Y') ?></p>
        </div>
    </footer>

    <button class="music-btn" type="button" id="musicBtn" aria-pressed="false" aria-label="<?= htmlspecialchars($t['music_label'], ENT_QUOTES, 'UTF-8') ?>">
        <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.6">
            <path d="M11 5L6 9H3v6h3l5 4V5z"></path>
            <path d="M15.5 8.5a5 5 0 010 7"></path>
        </svg>
    </button>
    <script src="assets/js/site.js?v=<?= (int) $assetVersion ?>" defer></script>
</body>
</html>
