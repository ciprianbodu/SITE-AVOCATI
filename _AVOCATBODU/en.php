<?php
require __DIR__ . '/seo.php';
require __DIR__ . '/includes/head-assets.php';
require_once __DIR__ . '/includes/practices.php';
$seo = seoData('en');

$mailLocale = 'en';
require __DIR__ . '/includes/send-contact-mail.php';
$showFormError = in_array($statusMessage, ['invalid', 'error'], true);
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($seo['title'], ENT_QUOTES, 'UTF-8') ?></title>
    <?php renderSeoHead('en'); ?>
    <?php renderHeadAssets(); ?>
    <?php renderSeoJsonLd('en'); ?>
</head>
<body id="top">
    <a href="#continut" class="skip-link">Skip to content</a>

    <header class="site-header">
        <div class="topbar">
            <div class="wrap topbar__inner">
                <p class="topbar__meta">Bucharest Bar · Business law · Since 1996</p>
                <div class="lang">
                    <a href="/">RO</a>
                    <span aria-hidden="true">|</span>
                    <span class="is-active">EN</span>
                </div>
            </div>
        </div>
        <nav class="nav" aria-label="Main navigation">
            <div class="wrap nav__inner">
                <a href="/en.php" class="brand">
                    <span class="brand__rule" aria-hidden="true"></span>
                    <span class="brand__text">
                        <span class="brand__mark">Bodu</span>
                        <span class="brand__sub">Law Office</span>
                    </span>
                </a>
                <div class="nav__links">
                    <a href="#profil">The firm</a>
                    <a href="#experienta">Practice</a>
                    <a href="#carti">Publications</a>
                    <a href="#contact" class="btn btn-gold">Consultation</a>
                </div>
                <button id="menuToggle" class="menu-toggle" type="button" aria-expanded="false" aria-controls="mobileMenu" data-breakpoint="900" aria-label="Menu">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </nav>
    </header>

    <dialog id="mobileMenu" class="mobile-menu" aria-label="Main navigation">
        <button id="menuClose" class="menu-close" aria-label="Close">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <a href="#profil" class="mobile-nav">The firm</a>
        <a href="#experienta" class="mobile-nav">Practice</a>
        <a href="#carti" class="mobile-nav">Publications</a>
        <a href="#contact" class="mobile-nav">Consultation</a>
        <div class="lang">
            <a href="/">RO</a>
            <span aria-hidden="true">|</span>
            <span class="is-active">EN</span>
        </div>
    </dialog>

    <main id="continut" tabindex="-1">
    <section class="hero">
        <div class="wrap" >
            <p class="kicker">Lawyer in Bucharest · Business and criminal law</p>
            <h1><span class="hero__title">Prof. Dr.</span>Sebastian V.<br><em>Bodu</em></h1>
            <hr class="hero__rule">
            <p class="hero__lead">The firm advises and represents clients in commercial and tax matters. Its criminal practice covers economic offences and cybercrime. It also provides legal advice on managing crypto wallets.</p>
            <div class="hero__actions">
                <a href="#contact" class="btn btn-gold">Request consultation</a>
                <a href="#experienta" class="btn btn-ghost">Practice areas</a>
            </div>
            <aside class="hero-practice" aria-labelledby="hero-practice-title">
                <p class="hero-practice__eyebrow">Legal expertise</p>
                <h2 id="hero-practice-title">Practice areas</h2>
                <a href="/corporate-law"><span>Corporate law</span><span aria-hidden="true">↗</span></a>
                <a href="/commercial-law"><span>Commercial law</span><span aria-hidden="true">↗</span></a>
                <a href="/tax-law"><span>Tax law<small>ANAF audits and anti-fraud inspections</small></span><span aria-hidden="true">↗</span></a>
                <a href="/economic-offences"><span>Business criminal law<small>Defence and criminal risk prevention</small></span><span aria-hidden="true">↗</span></a>
            </aside>
        </div>
    </section>

    <section class="cred">
        <div class="wrap">
            <div class="cred__grid">
                <div class="cred__item" data-aos="fade-up">
                    <strong>1996</strong>
                    <span>Bucharest Bar Member</span>
                </div>
                <div class="cred__item" data-aos="fade-up" data-aos-delay="50">
                    <strong>MBA</strong>
                    <span>Master in Business Administration</span>
                </div>
                <div class="cred__item" data-aos="fade-up" data-aos-delay="100">
                    <strong>PhD</strong>
                    <span>Doctor of Law</span>
                </div>
                <div class="cred__item" data-aos="fade-up" data-aos-delay="150">
                    <strong>Habil.</strong>
                    <span>PhD Supervisor</span>
                </div>
            </div>
        </div>
    </section>

    <section id="profil" class="section section-dark">
        <div class="wrap">
            <div class="profile">
                <div data-aos="fade-right">
                    <div class="section-head">
                        <p class="kicker">The firm</p>
                        <h2>Business law,<br>grounded in academia</h2>
                        <div class="ornament" aria-hidden="true"><i></i><span></span><i></i></div>
                    </div>
                    <div class="prose">
                        <p><strong>Prof. Dr. Sebastian V. Bodu</strong> has been a member of the Bucharest Bar since 1996, with a practice focused on business law: corporate, commercial, tax, banking, economic offences and arbitration.</p>
                        <p>He is a <strong>full professor</strong> at the Bucharest University of Economic Studies, teaching <em>Corporate Law</em> and <em>Commercial Law</em>, and a <strong>PhD supervisor</strong> (habilitated) in law.</p>
                        <p>The firm provides counsel and representation for corporate clients and investors, with emphasis on transaction structuring, governance and regulatory compliance.</p>
                    </div>
                    <dl class="facts">
                        <div>
                            <dt>Professional seat</dt>
                            <dd>Bucharest Bar</dd>
                        </div>
                        <div>
                            <dt>Clients</dt>
                            <dd>Companies and investors</dd>
                        </div>
                        <div>
                            <dt>Focus</dt>
                            <dd>Business law</dd>
                        </div>
                        <div>
                            <dt>Academic work</dt>
                            <dd>ASE Bucharest</dd>
                        </div>
                    </dl>
                </div>
                <figure class="portrait" data-aos="fade-left">
                    <div class="portrait__frame">
                        <picture>
                            <source media="(min-width: 900px)" type="image/webp" srcset="/assets/img/sebastianbodu.webp">
                            <img src="/sebastianbodu.jpg?v=<?= ASSET_VER ?>" alt="Prof. Dr. Sebastian V. Bodu, corporate and commercial lawyer, Bucharest Bar" width="720" height="720" decoding="async" fetchpriority="low">
                        </picture>
                    </div>
                    <figcaption>
                        <strong>Sebastian V. Bodu</strong>
                        <span>Attorney at Law · Bucharest Bar</span>
                    </figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section id="experienta" class="section section-mid">
        <div class="wrap">
            <div class="section-head section-head--center" data-aos="fade-up">
                <p class="kicker">Practice areas</p>
                <h2>Business counsel and criminal defence in Bucharest</h2>
                <p class="deck">Legal assistance with commercial contracts and disputes, Romanian tax audits, criminal cases and disputes involving crypto assets.</p>
                <div class="ornament" aria-hidden="true"><i></i><span></span><i></i></div>
            </div>
            <div class="practice-list">
                <?php $i = 0; foreach (practiceCatalog() as $slug => $item): ?>
                <a class="practice-item" href="/<?= htmlspecialchars($item['en'], ENT_QUOTES, 'UTF-8') ?>" data-aos="fade-up" data-aos-delay="<?= $i * 50 ?>">
                    <span class="practice-item__num"><?= htmlspecialchars($item['num'], ENT_QUOTES, 'UTF-8') ?></span>
                    <div>
                        <h3><?= htmlspecialchars($item['en_copy']['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <p><?= htmlspecialchars($item['en_copy']['short'], ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                </a>
                <?php $i++; endforeach; ?>
            </div>
        </div>
    </section>

    <section id="carti" class="section section-ivory">
        <div class="wrap">
            <div class="section-head section-head--center" data-aos="fade-up">
                <p class="kicker">Legal doctrine</p>
                <h2>Publications &amp; treatises</h2>
                <div class="ornament" aria-hidden="true"><i></i><span></span><i></i></div>
            </div>
            <blockquote class="quote" data-aos="fade-up">
                <p>“Treatises and books are an indispensable tool for practitioners, judges, prosecutors and lawyers.”</p>
                <cite>Reference works in business criminal law, co-authored with Ciprian Bodu (prosecutor, NIM graduate).</cite>
            </blockquote>
            <div class="pub-grid">
                <a class="pub-card" href="https://www.hamangiu.ro/tratat-de-drept-societar" target="_blank" rel="noopener noreferrer" data-aos="fade-up">
                    <small>Hamangiu Bookshop</small>
                    <h3>Treatise on Corporate Law</h3>
                    <p>2025 Edition</p>
                    <span class="more">Order →</span>
                </a>
                <a class="pub-card" href="https://www.ujmag.ro/drept/drept-comercial/tratat-de-drept-societar-editia-2025" target="_blank" rel="noopener noreferrer" data-aos="fade-up" data-aos-delay="60">
                    <small>Universul Juridic</small>
                    <h3>Treatise on Corporate Law</h3>
                    <p>2025 Edition · UJMag.ro</p>
                    <span class="more">Order →</span>
                </a>
                <a class="pub-card" href="https://www.editurarosetti.ro/?id_autor=65" target="_blank" rel="noopener noreferrer" data-aos="fade-up" data-aos-delay="120">
                    <small>Rosetti Publishing</small>
                    <h3>Full collection</h3>
                    <p>All works by the author</p>
                    <span class="more">View all →</span>
                </a>
                <a class="pub-card" href="https://www.juridice.ro/author/sebastian-bodu" target="_blank" rel="noopener noreferrer" data-aos="fade-up" data-aos-delay="180">
                    <small>JURIDICE.ro</small>
                    <h3>Published articles</h3>
                    <p>Company law, corporate will, membership rights</p>
                    <span class="more">Read on JURIDICE →</span>
                </a>
            </div>
        </div>
    </section>

    <section id="faq" class="section section-mid">
        <div class="wrap">
            <div class="section-head section-head--center" data-aos="fade-up">
                <p class="kicker">FAQ</p>
                <h2>Business lawyer in Bucharest</h2>
                <div class="ornament" aria-hidden="true"><i></i><span></span><i></i></div>
            </div>
            <div class="faq-list">
                <?php renderFaqItems('en'); ?>
            </div>
        </div>
    </section>

    <section id="contact" class="section section-dark">
        <div class="wrap">
            <div class="contact-grid">
                <div data-aos="fade-right">
                    <div class="section-head">
                        <p class="kicker">Contact</p>
                        <h2>Request a consultation</h2>
                        <div class="ornament" aria-hidden="true"><i></i><span></span><i></i></div>
                        <p class="deck">Submit a request for legal consultation. You will be contacted as soon as possible.</p>
                    </div>
                    <div class="contact-meta">
                        <div class="contact-row">
                            <div class="contact-ico">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <small>Email</small>
                                <a href="mailto:bodu.sebastian@gmail.com">bodu.sebastian@gmail.com</a>
                            </div>
                        </div>
                        <div class="contact-row">
                            <div class="contact-ico">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                            </div>
                            <div>
                                <small>Phone</small>
                                <a href="tel:<?= htmlspecialchars(SITE_PHONE, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(SITE_PHONE_DISPLAY, ENT_QUOTES, 'UTF-8') ?></a>
                            </div>
                        </div>
                        <div class="contact-row">
                            <div class="contact-ico">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/></svg>
                            </div>
                            <div>
                                <small>Office</small>
                                <a href="https://avocatbodu.ro">avocatbodu.ro</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="letter" id="solicitare">
                    <h3>Write to the practice</h3><p class="form-note">All fields are required.</p>
                    <?php if ($statusMessage === "success"): ?>
                    <div class="alert alert-ok" role="status">Your message was sent successfully. You will be contacted shortly.</div>
                    <?php elseif ($statusMessage === 'invalid'): ?>
                    <div class="alert alert-err" role="alert">Check your name, email address and message, then submit the form again.</div>
                    <?php elseif ($statusMessage === 'error'): ?>
                    <div class="alert alert-err" role="alert">An error occurred while sending. Please try again or write to us by email.</div>
                    <?php endif; ?>
                    <form action="/en.php#solicitare" method="POST">
                        <div class="field">
                            <label for="nume">Full name</label>
                            <input type="text" id="nume" name="nume" required autocomplete="name" maxlength="160" value="<?= htmlspecialchars($showFormError ? ($formValues['nume'] ?? '') : '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                        <div class="field">
                            <label for="email">Email address</label>
                            <input type="email" id="email" name="email" required autocomplete="email" maxlength="254" value="<?= htmlspecialchars($showFormError ? ($formValues['email'] ?? '') : '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                        <div class="field">
                            <label for="mesaj">Case description</label>
                            <textarea id="mesaj" name="mesaj" rows="4" required maxlength="10000" placeholder="Briefly describe your legal situation..."><?= htmlspecialchars($showFormError ? ($formValues['mesaj'] ?? '') : '', ENT_QUOTES, 'UTF-8') ?></textarea>
                        </div>
                        <button type="submit" name="trimite_contact" class="btn btn-navy">Submit inquiry</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    </main>
    <footer class="site-footer">
        <div class="wrap footer__inner">
            <div>
                <p class="footer__brand">Bodu</p>
                <p class="footer__sub">Law Office · Bucharest Bar</p>
            </div>
            <div>
                <nav class="footer__links" aria-label="Practice areas">
                    <?php foreach (practiceCatalog() as $item): ?>
                    <a href="/<?= htmlspecialchars($item['en'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($item['en_copy']['name'], ENT_QUOTES, 'UTF-8') ?></a>
                    <?php endforeach; ?>
                </nav>
                <p>&copy; <?= date('Y') ?> avocatbodu.ro · All rights reserved</p>
            </div>
        </div>
    </footer>

</body>
</html>
