<?php
// Both languages share the same layout and locally served assets.
$en = $seo['lang'] === 'en';
$home = $en ? '/en.php' : '/';
$t = $en ? [
    'skip' => 'Skip to content', 'nav' => 'Main navigation', 'menu' => 'Menu', 'close' => 'Close menu',
    'profile' => 'The practice', 'services' => 'Practice areas', 'contact' => 'Contact',
    'tag' => 'Civil, tax & criminal law', 'role' => 'Lead attorney',
    'lead' => 'A clear understanding of your case. Legal advice and representation, with attention to every detail.',
    'cta' => 'Request a consultation', 'discover' => 'Explore practice areas',
    'phone' => 'Phone', 'national' => 'Nationwide', 'representation' => 'Legal representation',
    'profile_label' => 'Professional profile', 'profile_title' => 'A personal approach.<br>A rigorous practice.',
    'practice_label' => 'Areas of expertise', 'practice_title' => 'Legal support for<br>the decisions that matter.',
    'practice_lead' => 'Advice, assistance and representation tailored to the circumstances of each case.',
    'service_cta' => 'Discuss your case', 'contact_label' => 'Let’s talk',
    'contact_title' => 'Every case starts<br>with a conversation.',
    'contact_lead' => 'Tell us briefly about your legal matter or contact us directly. We will respond as soon as possible.',
    'form_title' => 'Request a consultation', 'required' => 'All fields are required.',
    'name' => 'Full name', 'email' => 'Email address', 'message' => 'Your legal matter',
    'placeholder' => 'Briefly describe the matter you need help with…', 'send' => 'Send your inquiry',
    'success' => 'Your message has been sent successfully. We will contact you shortly.',
    'error' => 'The message could not be sent. Please try again or contact us at contact@mitescu.ro or 0726.055.677.',
    'footer' => 'Law office · Alina-Maria Mitescu', 'rights' => 'All rights reserved', 'top' => 'Back to top',
] : [
    'skip' => 'Salt la conținut', 'nav' => 'Navigare principală', 'menu' => 'Meniu', 'close' => 'Închide meniul',
    'profile' => 'Cabinet', 'services' => 'Arii de practică', 'contact' => 'Contact',
    'tag' => 'Drept civil, fiscal și penal', 'role' => 'Avocat titular',
    'lead' => 'Înțelegerea clară a situației dumneavoastră. Consultanță și reprezentare juridică, cu atenție la fiecare detaliu.',
    'cta' => 'Solicitați o consultanță', 'discover' => 'Descoperiți ariile de practică',
    'phone' => 'Telefon', 'national' => 'La nivel național', 'representation' => 'Reprezentare juridică',
    'profile_label' => 'Profil profesional', 'profile_title' => 'Atenție pentru fiecare caz.<br>Rigoare în fiecare demers.',
    'practice_label' => 'Arii de practică', 'practice_title' => 'Sprijin juridic pentru<br>deciziile care contează.',
    'practice_lead' => 'Consultanță, asistență și reprezentare adaptate împrejurărilor fiecărei spețe.',
    'service_cta' => 'Discutați speța', 'contact_label' => 'Contact direct',
    'contact_title' => 'Fiecare caz începe<br>cu o discuție.',
    'contact_lead' => 'Descrieți pe scurt situația juridică sau contactați-ne direct. Vă vom răspunde în cel mai scurt timp.',
    'form_title' => 'Solicitați o consultanță', 'required' => 'Toate câmpurile sunt obligatorii.',
    'name' => 'Nume complet', 'email' => 'Adresă email', 'message' => 'Descrierea speței',
    'placeholder' => 'Descrieți pe scurt situația pentru care aveți nevoie de sprijin…', 'send' => 'Trimiteți solicitarea',
    'success' => 'Mesajul a fost transmis cu succes. Veți fi contactat în curând.',
    'error' => 'Mesajul nu a putut fi trimis. Încercați din nou sau contactați-ne la contact@mitescu.ro ori 0726.055.677.',
    'footer' => 'Cabinet de avocatură · Alina-Maria Mitescu', 'rights' => 'Toate drepturile rezervate', 'top' => 'Înapoi sus',
];
$assetVersion = '20260913a';
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
                <a href="#contact" class="btn btn-gold"><?= $t['contact'] ?> <span aria-hidden="true">↗</span></a>
            </div>
            <div class="nav-tools">
                <nav class="lang" aria-label="<?= $en ? 'Language' : 'Limbă' ?>">
                    <a href="/" lang="ro" hreflang="ro"<?= !$en ? ' aria-current="page"' : '' ?>>RO</a>
                    <span aria-hidden="true">/</span>
                    <a href="/en.php" lang="en" hreflang="en"<?= $en ? ' aria-current="page"' : '' ?>>EN</a>
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
            <a href="#contact"><?= $t['contact'] ?> <span aria-hidden="true">↗</span></a>
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
                <div class="hero-actions">
                    <a href="#contact" class="btn btn-gold"><?= $t['cta'] ?> <span aria-hidden="true">↗</span></a>
                    <a href="#experienta" class="text-link"><?= $t['discover'] ?> <span aria-hidden="true">↓</span></a>
                </div>
            </div>
            <div class="hero-caption" aria-hidden="true">MITESCU LEGAL · <?= $en ? 'ADVICE & REPRESENTATION' : 'CONSULTANȚĂ ȘI REPREZENTARE' ?></div>
        </section>
        <div class="contact-strip">
            <div class="wrap contact-strip__grid">
                <a href="tel:+40726055677"><small><?= $t['phone'] ?></small><strong>0726.055.677</strong><span aria-hidden="true">↗</span></a>
                <a href="mailto:contact@mitescu.ro"><small>Email</small><strong>contact@mitescu.ro</strong><span aria-hidden="true">↗</span></a>
                <div><small><?= $t['representation'] ?></small><strong><?= $t['national'] ?></strong></div>
            </div>
        </div>
        <section id="profil" class="section profile-section">
            <div class="wrap profile">
                <div class="profile-copy">
                    <p class="eyebrow"><?= $t['profile_label'] ?></p>
                    <h2><?= $t['profile_title'] ?></h2>
                    <div class="prose"><?= $profileCopy ?></div>
                    <a href="#contact" class="text-link"><?= $t['cta'] ?> <span aria-hidden="true">↗</span></a>
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
                <div class="section-heading">
                    <div><p class="eyebrow"><?= $t['practice_label'] ?></p><h2><?= $t['practice_title'] ?></h2></div>
                    <p><?= $t['practice_lead'] ?></p>
                </div>
                <div class="practice-grid">
                    <?php foreach ($exp as $i => $item): ?>
                    <a href="#contact" class="practice-card">
                        <span class="practice-number" aria-hidden="true"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                        <h3><?= $esc($item[0]) ?></h3>
                        <p><?= $esc($item[1]) ?></p>
                        <span class="practice-more"><?= $t['service_cta'] ?> <span aria-hidden="true">↗</span></span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <section id="contact" class="section contact-section">
            <div class="wrap contact-grid">
                <div class="contact-copy">
                    <p class="eyebrow"><?= $t['contact_label'] ?></p>
                    <h2><?= $t['contact_title'] ?></h2>
                    <p class="contact-lead"><?= $t['contact_lead'] ?></p>
                    <div class="contact-details">
                        <a href="tel:+40726055677"><small><?= $t['phone'] ?></small><span>0726.055.677</span><b aria-hidden="true">↗</b></a>
                        <a href="mailto:contact@mitescu.ro"><small>Email</small><span>contact@mitescu.ro</span><b aria-hidden="true">↗</b></a>
                    </div>
                </div>
                <div class="letter">
                    <h3><?= $t['form_title'] ?></h3><p class="form-note"><?= $t['required'] ?></p>
                    <?php if ($statusMessage === 'success'): ?>
                    <div class="alert alert-ok" role="status"><?= $t['success'] ?></div>
                    <?php elseif ($statusMessage === 'error'): ?>
                    <div class="alert alert-err" role="alert"><?= $t['error'] ?></div>
                    <?php endif; ?>
                    <form action="<?= $home ?>#contact" method="POST">
                        <div class="field"><label for="nume"><?= $t['name'] ?></label><input type="text" id="nume" name="nume" required autocomplete="name" maxlength="160" value="<?= $esc($statusMessage === 'error' ? ($formValues['nume'] ?? '') : '') ?>"></div>
                        <div class="field"><label for="email"><?= $t['email'] ?></label><input type="email" id="email" name="email" required autocomplete="email" maxlength="254" value="<?= $esc($statusMessage === 'error' ? ($formValues['email'] ?? '') : '') ?>"></div>
                        <div class="field"><label for="mesaj"><?= $t['message'] ?></label><textarea id="mesaj" name="mesaj" rows="4" required maxlength="10000" placeholder="<?= $t['placeholder'] ?>"><?= $esc($statusMessage === 'error' ? ($formValues['mesaj'] ?? '') : '') ?></textarea></div>
                        <button type="submit" name="trimite_contact" class="btn btn-dark"><?= $t['send'] ?> <span aria-hidden="true">↗</span></button>
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
        <div class="wrap footer-bottom"><p>&copy; <?= date('Y') ?> MITESCU LEGAL · <?= $t['rights'] ?></p><a href="#top"><?= $t['top'] ?> <span aria-hidden="true">↑</span></a></div>
    </footer>
</body>
</html>
