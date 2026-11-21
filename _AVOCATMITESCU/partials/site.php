<?php
// Both languages share the same layout and locally served assets.
$en = $seo['lang'] === 'en';
$home = $en ? '/en.php' : '/';
$t = $en ? [
    'skip' => 'Skip to content', 'nav' => 'Main navigation', 'menu' => 'Menu', 'close' => 'Close menu',
    'profile' => 'The practice', 'services' => 'Practice areas', 'contact' => 'Contact',
    'tag' => 'Civil, tax & criminal law', 'role' => 'Lead attorney',
    'lead' => 'Legal advice and representation in civil, tax and criminal matters throughout Romania.',
    'consultation_film' => 'A lawyer prepares documents, speaks in court and shakes hands with a client.',
    'cta' => 'Request a consultation', 'discover' => 'Explore practice areas',
    'phone' => 'Phone', 'national' => 'Nationwide', 'representation' => 'Legal representation',
    'profile_title' => 'About the practice', 'practice_title' => 'Practice areas',
    'contact_title' => 'Contact the practice',
    'contact_lead' => 'Call, email or use the form to request a consultation.',
    'form_title' => 'Request a consultation', 'required' => 'All fields are required.',
    'invalid' => 'Check your name, email address and message, then submit the form again.',
    'name' => 'Full name', 'email' => 'Email address', 'message' => 'Your legal matter',
    'placeholder' => 'Briefly describe the matter you need help with…', 'send' => 'Send your inquiry',
    'success' => 'Your message has been sent successfully. We will contact you shortly.',
    'error' => 'The message could not be sent. Please try again or contact us at contact@mitescu.ro or 0726.055.677.',
    'footer' => 'Law office · Alina-Maria Mitescu', 'rights' => 'All rights reserved', 'top' => 'Back to top',
] : [
    'skip' => 'Salt la conținut', 'nav' => 'Navigare principală', 'menu' => 'Meniu', 'close' => 'Închide meniul',
    'profile' => 'Cabinet', 'services' => 'Arii de practică', 'contact' => 'Contact',
    'tag' => 'Drept civil, fiscal și penal', 'role' => 'Avocat titular',
    'lead' => 'Consultanță și reprezentare în cauze civile, fiscale și penale pe întreg teritoriul României.',
    'consultation_film' => 'Un avocat pregătește actele, pledează și dă mâna cu un client.',
    'cta' => 'Solicitați o consultanță', 'discover' => 'Descoperiți ariile de practică',
    'phone' => 'Telefon', 'national' => 'La nivel național', 'representation' => 'Reprezentare juridică',
    'profile_title' => 'Despre cabinet', 'practice_title' => 'Arii de practică',
    'contact_title' => 'Contact',
    'contact_lead' => 'Pentru o consultație, ne puteți suna, ne puteți scrie prin e-mail sau puteți folosi formularul.',
    'form_title' => 'Solicitați o consultanță', 'required' => 'Toate câmpurile sunt obligatorii.',
    'invalid' => 'Verificați numele, adresa de e-mail și mesajul, apoi retrimiteți formularul.',
    'name' => 'Nume complet', 'email' => 'Adresă email', 'message' => 'Descrierea speței',
    'placeholder' => 'Descrieți pe scurt situația pentru care aveți nevoie de sprijin…', 'send' => 'Trimiteți solicitarea',
    'success' => 'Mesajul a fost transmis cu succes. Veți fi contactat în curând.',
    'error' => 'Mesajul nu a putut fi trimis. Încercați din nou sau contactați-ne la contact@mitescu.ro ori 0726.055.677.',
    'footer' => 'Cabinet de avocatură · Alina-Maria Mitescu', 'rights' => 'Toate drepturile rezervate', 'top' => 'Înapoi sus',
];
$showFormError = in_array($statusMessage, ['invalid', 'error'], true);
$assetVersion = '20261121b';
?>
<!DOCTYPE html>
<html lang="<?= $seo['lang'] ?>" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include __DIR__ . '/seo-head.php'; ?>
    <meta name="theme-color" content="#15221f">
    <link rel="preload" href="/assets/fonts/cormorant-latin.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/source-sans-latin.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" as="image" href="/assets/img/hero-law-sm.webp" type="image/webp" media="(max-width: 767px)">
    <link rel="preload" as="image" href="/assets/img/hero-law.webp" type="image/webp" media="(min-width: 768px)">
    <link rel="stylesheet" href="/assets/css/site.css?v=<?= $assetVersion ?>">
    <script src="/assets/js/site.js?v=<?= $assetVersion ?>" defer></script>
</head>
<body id="top">
    <a href="#continut" class="skip-link"><?= $t['skip'] ?></a>
    <header class="site-header">
        <nav class="wrap nav" aria-label="<?= $t['nav'] ?>">
            <?php $brandHref = $home; include __DIR__ . '/brand.php'; ?>
            <div class="nav-links">
                <a href="#profil"><?= $t['profile'] ?></a>
                <a href="#experienta"><?= $t['services'] ?></a>
                <a href="#contact" class="btn btn-gold"><?= $t['contact'] ?></a>
            </div>
            <div class="nav-tools">
                <nav class="lang" aria-label="<?= $en ? 'Language' : 'Limbă' ?>">
                    <a href="/" lang="ro" hreflang="ro" aria-label="Română"<?= !$en ? ' aria-current="page"' : '' ?>>RO</a>
                    <span aria-hidden="true">/</span>
                    <a href="/en.php" lang="en" hreflang="en" aria-label="English"<?= $en ? ' aria-current="page"' : '' ?>>EN</a>
                </nav>
                <button id="menuToggle" class="menu-toggle" type="button" aria-label="<?= $t['menu'] ?>" aria-controls="mobileMenu" aria-expanded="false">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
                </button>
            </div>
        </nav>
    </header>
    <dialog id="mobileMenu" class="mobile-menu" aria-label="<?= $t['nav'] ?>">
        <button id="menuClose" class="menu-close" type="button" aria-label="<?= $t['close'] ?>">×</button>
        <p class="eyebrow">MITESCU LEGAL</p>
        <nav class="mobile-menu__links" aria-label="<?= $t['nav'] ?>">
            <a href="#profil"><?= $t['profile'] ?></a>
            <a href="#experienta"><?= $t['services'] ?></a>
            <a href="#contact"><?= $t['contact'] ?></a>
        </nav>
        <a class="mobile-phone" href="tel:+40726055677">0726.055.677</a>
    </dialog>
    <main id="continut" tabindex="-1">
        <section class="hero" aria-labelledby="hero-title">
            <div class="hero-art" aria-hidden="true"></div>
            <div class="wrap hero-content">
                <p class="eyebrow"><?= $t['tag'] ?></p>
                <h1 id="hero-title"><span class="hero-role"><?= $t['role'] ?></span>Alina-Maria<br><em>Mitescu</em></h1>
                <p class="hero-lead"><?= $t['lead'] ?></p>
                <picture class="hero-film">
                    <source media="(prefers-reduced-motion: reduce)" srcset="/assets/img/consultation-film-poster.webp">
                    <img src="/assets/img/consultation-film-loop.webp?v=2" width="608" height="264" loading="lazy"
                        decoding="async" alt="<?= htmlspecialchars($t['consultation_film']) ?>">
                </picture>
                <div class="hero-actions">
                    <a href="#solicitare" class="btn btn-gold"><?= $t['cta'] ?></a>
                    <a href="#experienta" class="text-link"><?= $t['discover'] ?></a>
                </div>
            </div>
        </section>
        <div class="contact-strip">
            <div class="wrap contact-strip__grid">
                <a href="tel:+40726055677"><small><?= $t['phone'] ?></small><strong>0726.055.677</strong></a>
                <a href="mailto:contact@mitescu.ro"><small>Email</small><strong>contact@mitescu.ro</strong></a>
                <div><small><?= $t['representation'] ?></small><strong><?= $t['national'] ?></strong></div>
            </div>
        </div>
        <section id="profil" class="section profile-section">
            <div class="wrap profile">
                <div class="profile-copy">
                    <h2><?= $t['profile_title'] ?></h2>
                    <div class="prose"><?= $profileCopy ?></div>
                    <a href="#solicitare" class="text-link"><?= $t['cta'] ?></a>
                </div>
                <figure class="portrait">
                    <div class="portrait-frame">
                        <picture>
                            <source srcset="/assets/img/alina-mitescu-sm.webp 480w, /assets/img/alina-mitescu.webp 800w" sizes="(min-width: 1024px) 400px, (min-width: 640px) 380px, calc(100vw - 48px)" type="image/webp">
                            <img src="/assets/img/alina-mitescu.jpg" alt="Alina-Maria Mitescu — <?= $t['role'] ?>" width="800" height="1000" loading="lazy" decoding="async">
                        </picture>
                    </div>
                    <figcaption><strong>Alina-Maria Mitescu</strong><span><?= $t['role'] ?> · MITESCU LEGAL</span></figcaption>
                </figure>
            </div>
        </section>
        <section id="experienta" class="section practice-section">
            <div class="wrap">
                <h2><?= $t['practice_title'] ?></h2>
                <ul class="practice-grid">
                    <?php foreach ($exp as $item): ?>
                    <li class="practice-card">
                        <h3><?= $esc($item[0]) ?></h3>
                        <p><?= $esc($item[1]) ?></p>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <a href="#solicitare" class="btn btn-dark"><?= $t['cta'] ?></a>
            </div>
        </section>
        <section id="contact" class="section contact-section">
            <div class="wrap contact-grid">
                <div class="contact-copy">
                    <h2><?= $t['contact_title'] ?></h2>
                    <p class="contact-lead"><?= $t['contact_lead'] ?></p>
                    <div class="contact-details">
                        <a href="tel:+40726055677"><small><?= $t['phone'] ?></small><span>0726.055.677</span></a>
                        <a href="mailto:contact@mitescu.ro"><small>Email</small><span>contact@mitescu.ro</span></a>
                    </div>
                </div>
                <div id="solicitare" class="letter">
                    <h3><?= $t['form_title'] ?></h3><p class="form-note"><?= $t['required'] ?></p>
                    <?php if ($statusMessage === 'success'): ?>
                    <div class="alert alert-ok" role="status"><?= $t['success'] ?></div>
                    <?php elseif ($showFormError): ?>
                    <div class="alert alert-err" role="alert"><?= $t[$statusMessage] ?></div>
                    <?php endif; ?>
                    <form action="<?= $home ?>#solicitare" method="POST">
                        <div class="field"><label for="nume"><?= $t['name'] ?></label><input type="text" id="nume" name="nume" required autocomplete="name" maxlength="160" value="<?= $esc($showFormError ? ($formValues['nume'] ?? '') : '') ?>"></div>
                        <div class="field"><label for="email"><?= $t['email'] ?></label><input type="email" id="email" name="email" required autocomplete="email" maxlength="254" value="<?= $esc($showFormError ? ($formValues['email'] ?? '') : '') ?>"></div>
                        <div class="field"><label for="mesaj"><?= $t['message'] ?></label><textarea id="mesaj" name="mesaj" rows="4" required maxlength="10000" placeholder="<?= $t['placeholder'] ?>"><?= $esc($showFormError ? ($formValues['mesaj'] ?? '') : '') ?></textarea></div>
                        <button type="submit" name="trimite_contact" class="btn btn-dark"><?= $t['send'] ?></button>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <footer class="site-footer">
        <div class="wrap footer-main">
            <div><?php $brandHref = $home; $brandVariant = 'brand-logo--footer'; include __DIR__ . '/brand.php'; ?><p><?= $t['footer'] ?></p></div>
            <nav aria-label="<?= $en ? 'Footer navigation' : 'Navigare subsol' ?>"><a href="#profil"><?= $t['profile'] ?></a><a href="#experienta"><?= $t['services'] ?></a><a href="#contact"><?= $t['contact'] ?></a></nav>
        </div>
        <div class="wrap footer-bottom"><p>&copy; <?= date('Y') ?> MITESCU LEGAL · <?= $t['rights'] ?></p><a href="#top"><?= $t['top'] ?></a></div>
    </footer>
</body>
</html>
