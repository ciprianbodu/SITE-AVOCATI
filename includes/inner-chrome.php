<?php

function innerChromeCopy(string $lang): array
{
    if ($lang === 'en') {
        return [
            'skip' => 'Skip to content',
            'top' => 'Bucharest Bar · Business law · Since 1996',
            'brand' => 'Law Office',
            'nav_firm' => 'The firm',
            'nav_practice' => 'Practice',
            'nav_pub' => 'Publications',
            'nav_notes' => 'Notes',
            'nav_cta' => 'Consultation',
            'menu' => 'Menu',
            'close' => 'Close',
            'crumb_home' => 'Home',
            'footer' => 'Law Office · Bucharest Bar',
            'rights' => 'All rights reserved',
            'home' => '/en.php',
            'contact' => '/en.php#contact',
            'aria_nav' => 'Main navigation',
            'aria_practice' => 'Practice areas',
        ];
    }
    return [
        'skip' => 'Salt la conținut',
        'top' => 'Baroul București · Avocatură de afaceri · Din 1996',
        'brand' => 'Cabinet de Avocat',
        'nav_firm' => 'Cabinet',
        'nav_practice' => 'Practică',
        'nav_pub' => 'Publicații',
        'nav_notes' => 'Articole',
        'nav_cta' => 'Consultanță',
        'menu' => 'Meniu',
        'close' => 'Închide',
        'crumb_home' => 'Acasă',
        'footer' => 'Cabinet de Avocat · Baroul București',
        'rights' => 'Toate drepturile rezervate',
        'home' => '/',
        'contact' => '/#contact',
        'aria_nav' => 'Navigare principală',
        'aria_practice' => 'Domenii de practică',
    ];
}

function renderInnerHeader(string $lang, array $opts = []): void
{
    require_once __DIR__ . '/practices.php';
    $t = innerChromeCopy($lang);
    $esc = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
    $home = $opts['home'] ?? $t['home'];
    $contact = $opts['contact'] ?? $t['contact'];
    $langRo = $opts['lang_ro'] ?? '/';
    $langEn = $opts['lang_en'] ?? '/en.php';
    ?>
    <a href="#continut" class="skip-link"><?= $esc($t['skip']) ?></a>
    <header class="site-header">
        <div class="topbar">
            <div class="wrap topbar__inner">
                <p class="topbar__meta"><?= $esc($t['top']) ?></p>
                <div class="lang">
                    <?php if ($lang === 'ro'): ?>
                    <span class="is-active">RO</span><span aria-hidden="true">|</span><a href="<?= $esc($langEn) ?>">EN</a>
                    <?php else: ?>
                    <a href="<?= $esc($langRo) ?>">RO</a><span aria-hidden="true">|</span><span class="is-active">EN</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <nav class="nav" aria-label="<?= $esc($t['aria_nav']) ?>">
            <div class="wrap nav__inner">
                <a href="<?= $esc($home) ?>" class="brand">
                    <span class="brand__rule" aria-hidden="true"></span>
                    <span class="brand__text">
                        <span class="brand__mark">Bodu</span>
                        <span class="brand__sub"><?= $esc($t['brand']) ?></span>
                    </span>
                </a>
                <div class="nav__links">
                    <a href="<?= $esc($home) ?>#profil"><?= $esc($t['nav_firm']) ?></a>
                    <a href="<?= $esc($home) ?>#experienta"><?= $esc($t['nav_practice']) ?></a>
                    <a href="<?= $esc($home) ?>#carti"><?= $esc($t['nav_pub']) ?></a>
                    <?php if ($lang === 'ro'): ?>
                    <a href="/articole/"><?= $esc($t['nav_notes']) ?></a>
                    <?php endif; ?>
                    <a href="<?= $esc($contact) ?>" class="btn btn-gold"><?= $esc($t['nav_cta']) ?></a>
                </div>
                <button id="menuToggle" class="menu-toggle" type="button" aria-expanded="false" aria-controls="mobileMenu" data-breakpoint="900" aria-label="<?= $esc($t['menu']) ?>">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </nav>
    </header>
    <dialog id="mobileMenu" class="mobile-menu" aria-label="<?= $esc($t['aria_nav']) ?>">
        <button id="menuClose" class="menu-close" aria-label="<?= $esc($t['close']) ?>">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <a href="<?= $esc($home) ?>#profil" class="mobile-nav"><?= $esc($t['nav_firm']) ?></a>
        <a href="<?= $esc($home) ?>#experienta" class="mobile-nav"><?= $esc($t['nav_practice']) ?></a>
        <a href="<?= $esc($home) ?>#carti" class="mobile-nav"><?= $esc($t['nav_pub']) ?></a>
        <?php if ($lang === 'ro'): ?>
        <a href="/articole/" class="mobile-nav"><?= $esc($t['nav_notes']) ?></a>
        <?php endif; ?>
        <a href="<?= $esc($contact) ?>" class="mobile-nav"><?= $esc($t['nav_cta']) ?></a>
    </dialog>
    <?php
}

function renderInnerFooter(string $lang): void
{
    require_once __DIR__ . '/practices.php';
    $t = innerChromeCopy($lang);
    $esc = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
    ?>
    <footer class="site-footer">
        <div class="wrap footer__inner">
            <div>
                <p class="footer__brand">Bodu</p>
                <p class="footer__sub"><?= $esc($t['footer']) ?></p>
            </div>
            <div>
                <nav class="footer__links" aria-label="<?= $esc($t['aria_practice']) ?>">
                    <?php foreach (practiceCatalog() as $roSlug => $item):
                        $href = $lang === 'en' ? $item['en'] : $roSlug;
                        $name = $lang === 'en' ? $item['en_copy']['name'] : $item['ro']['name'];
                    ?>
                    <a href="/<?= $esc($href) ?>"><?= $esc($name) ?></a>
                    <?php endforeach; ?>
                    <?php if ($lang === 'ro'): ?>
                    <a href="/articole/">Articole</a>
                    <?php endif; ?>
                </nav>
                <p>&copy; <?= date('Y') ?> avocatbodu.ro · <?= $esc($t['rights']) ?></p>
            </div>
        </div>
    </footer>
    <?php
}
