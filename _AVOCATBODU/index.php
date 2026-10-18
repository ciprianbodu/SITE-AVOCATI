<?php
require __DIR__ . '/seo.php';
require __DIR__ . '/includes/head-assets.php';
require_once __DIR__ . '/includes/practices.php';
$seo = seoData('ro');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$statusMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['trimite_contact'])) {
$formValues = [];
foreach (['nume', 'email', 'mesaj'] as $field) {
    $formValues[$field] = is_string($_POST[$field] ?? null) ? trim($_POST[$field]) : '';
}
$validContact = $formValues['nume'] !== '' && strlen($formValues['nume']) <= 640
    && !preg_match('/[\r\n]/', $formValues['nume'])
    && strlen($formValues['email']) <= 254 && filter_var($formValues['email'], FILTER_VALIDATE_EMAIL)
    && $formValues['mesaj'] !== '' && strlen($formValues['mesaj']) <= 40000;
if (!$validContact) {
    $statusMessage = 'error';
} else {
    require 'PHPmailer/Exception.php';
    require 'PHPmailer/PHPMailer.php';
    require 'PHPmailer/SMTP.php';
    $nume = strip_tags($formValues['nume']);
    $email_client = $formValues['email'];
    $mesaj_client = strip_tags($formValues['mesaj']);
    $cfg = require __DIR__ . '/config.php';
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->CharSet = PHPMailer::CHARSET_UTF8;
        $mail->Host       = $cfg['smtp_host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $cfg['smtp_user'];
        $mail->Password   = $cfg['smtp_pass'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = $cfg['smtp_port'];
        $mail->setFrom($cfg['from_email'], $cfg['from_name']);
        $mail->addAddress($cfg['to_email']);
        $mail->addReplyTo($email_client, $nume);
        $mail->isHTML(true);
        $mail->Subject = "Solicitare noua: $nume";
        $mail->Body    = "<h3>Mesaj nou de pe avocatbodu.ro</h3><p><strong>Nume:</strong> " . htmlspecialchars($nume, ENT_QUOTES, 'UTF-8') . "</p><p><strong>Email:</strong> " . htmlspecialchars($email_client, ENT_QUOTES, 'UTF-8') . "</p><p><strong>Mesaj:</strong><br>" . nl2br(htmlspecialchars($mesaj_client, ENT_QUOTES, 'UTF-8')) . "</p>";
        $mail->send();
        $statusMessage = "success";
    } catch (Exception $e) { $statusMessage = "error"; }
}
}
?>
<!DOCTYPE html>
<html lang="ro" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($seo['title'], ENT_QUOTES, 'UTF-8') ?></title>
    <?php renderSeoHead('ro'); ?>
    <?php renderHeadAssets(); ?>
    <?php renderSeoJsonLd('ro'); ?>
</head>
<body id="top">
    <a href="#continut" class="skip-link">Salt la conținut</a>

    <header class="site-header">
        <div class="topbar">
            <div class="wrap topbar__inner">
                <p class="topbar__meta">Baroul București · Avocatură de afaceri · Din 1996</p>
                <div class="lang">
                    <span class="is-active">RO</span>
                    <span aria-hidden="true">|</span>
                    <a href="en.php">EN</a>
                </div>
            </div>
        </div>
        <nav class="nav" aria-label="Navigare principală">
            <div class="wrap nav__inner">
                <a href="#" class="brand">
                    <span class="brand__rule" aria-hidden="true"></span>
                    <span class="brand__text">
                        <span class="brand__mark">Bodu</span>
                        <span class="brand__sub">Cabinet de Avocat</span>
                    </span>
                </a>
                <div class="nav__links">
                    <a href="#profil">Cabinet</a>
                    <a href="#experienta">Practică</a>
                    <a href="#carti">Publicații</a>
                    <a href="#articole">Articole</a>
                    <a href="#contact" class="btn btn-gold">Consultanță</a>
                </div>
                <button id="menuToggle" class="menu-toggle" type="button" aria-expanded="false" aria-controls="mobileMenu" data-breakpoint="900" aria-label="Meniu">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </nav>
    </header>

    <dialog id="mobileMenu" class="mobile-menu" aria-label="Navigare principală">
        <button id="menuClose" class="menu-close" aria-label="Închide">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <a href="#profil" class="mobile-nav">Cabinet</a>
        <a href="#experienta" class="mobile-nav">Practică</a>
        <a href="#carti" class="mobile-nav">Publicații</a>
        <a href="#articole" class="mobile-nav">Articole</a>
        <a href="#contact" class="mobile-nav">Consultanță</a>
        <div class="lang">
            <span class="is-active">RO</span>
            <span aria-hidden="true">|</span>
            <a href="en.php">EN</a>
        </div>
    </dialog>

    <main id="continut" tabindex="-1">
    <section class="hero">
        <div class="wrap" >
            <p class="kicker">Drept comercial și societar</p>
            <h1><span class="hero__title">Prof. univ. dr.</span>Sebastian V.<br><em>Bodu</em></h1>
            <hr class="hero__rule">
            <p class="hero__lead">Cabinet de avocat specializat în dreptul afacerilor. Consultanță și reprezentare pentru societăți, investitori și operațiuni comerciale complexe.</p>
            <div class="hero__actions">
                <a href="#contact" class="btn btn-gold">Solicitați consultanță</a>
                <a href="#experienta" class="btn btn-ghost">Domenii de practică</a>
            </div>
        </div>
    </section>

    <section class="cred">
        <div class="wrap">
            <div class="cred__grid">
                <div class="cred__item" data-aos="fade-up">
                    <strong>1996</strong>
                    <span>Membru Baroul București</span>
                </div>
                <div class="cred__item" data-aos="fade-up" data-aos-delay="50">
                    <strong>MBA</strong>
                    <span>Master in Business Administration</span>
                </div>
                <div class="cred__item" data-aos="fade-up" data-aos-delay="100">
                    <strong>PhD</strong>
                    <span>Doctor în Drept</span>
                </div>
                <div class="cred__item" data-aos="fade-up" data-aos-delay="150">
                    <strong>Habil.</strong>
                    <span>Conducător de doctorat</span>
                </div>
            </div>
        </div>
    </section>

    <section id="profil" class="section section-dark">
        <div class="wrap">
            <div class="profile">
                <div data-aos="fade-right">
                    <div class="section-head">
                        <p class="kicker">Cabinetul</p>
                        <h2>Avocatură de afaceri,<br>cu fundament academic</h2>
                        <div class="ornament" aria-hidden="true"><i></i><span></span><i></i></div>
                    </div>
                    <div class="prose">
                        <p>Domnul <strong>Prof. univ. dr. Sebastian V. Bodu</strong> este membru definitiv al Baroului București din 1996, cu practică concentrată în avocatura de afaceri: drept societar, comercial, fiscal, bancar, criminalitate economică și arbitraj.</p>
                        <p>Este <strong>profesor universitar</strong> la Academia de Studii Economice din București, titular al disciplinelor de <em>Drept societar</em> și <em>Drept comercial</em>, și <strong>conducător de doctorat</strong> (habilitat) în drept.</p>
                        <p>Cabinetul oferă consultanță și reprezentare pentru persoane juridice și investitori, cu accent pe structurarea operațiunilor, guvernanță și conformitate.</p>
                    </div>
                    <dl class="facts">
                        <div>
                            <dt>Sediu profesional</dt>
                            <dd>Baroul București</dd>
                        </div>
                        <div>
                            <dt>Clientelă</dt>
                            <dd>Societăți și investitori</dd>
                        </div>
                        <div>
                            <dt>Profil</dt>
                            <dd>Avocatură de afaceri</dd>
                        </div>
                        <div>
                            <dt>Activitate academică</dt>
                            <dd>ASE București</dd>
                        </div>
                    </dl>
                </div>
                <figure class="portrait" data-aos="fade-left">
                    <div class="portrait__frame">
                        <picture>
                            <source srcset="assets/img/sebastianbodu.webp" type="image/webp">
            <img src="sebastianbodu.jpg" alt="Prof. univ. dr. Sebastian V. Bodu, avocat drept societar și comercial, Baroul București" width="720" height="720" loading="lazy" decoding="async">
                        </picture>
                    </div>
                    <figcaption>
                        <strong>Sebastian V. Bodu</strong>
                        <span>Avocat definitiv · Baroul București</span>
                    </figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section id="experienta" class="section section-mid">
        <div class="wrap">
            <div class="section-head section-head--center" data-aos="fade-up">
                <p class="kicker">Domenii de practică</p>
                <h2>Consultanță pentru mediul de afaceri</h2>
                <p class="deck">Asistență juridică pe întregul ciclu al operațiunii comerciale — de la structurare și contracte, până la litigiu și arbitraj.</p>
                <div class="ornament" aria-hidden="true"><i></i><span></span><i></i></div>
            </div>
            <div class="practice-list">
                <?php $i = 0; foreach (practiceCatalog() as $slug => $item): ?>
                <a class="practice-item" href="/<?= htmlspecialchars($slug, ENT_QUOTES, 'UTF-8') ?>" data-aos="fade-up" data-aos-delay="<?= $i * 50 ?>">
                    <span class="practice-item__num"><?= htmlspecialchars($item['num'], ENT_QUOTES, 'UTF-8') ?></span>
                    <div>
                        <h3><?= htmlspecialchars($item['ro']['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <p><?= htmlspecialchars($item['ro']['short'], ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                </a>
                <?php $i++; endforeach; ?>
            </div>
        </div>
    </section>

    <section id="carti" class="section section-ivory">
        <div class="wrap">
            <div class="section-head section-head--center" data-aos="fade-up">
                <p class="kicker">Doctrină</p>
                <h2>Publicații și tratate</h2>
                <div class="ornament" aria-hidden="true"><i></i><span></span><i></i></div>
            </div>
            <blockquote class="quote" data-aos="fade-up">
                <p>„Tratatele și cărțile reprezintă un instrument indispensabil pentru practicieni, judecători, procurori și avocați.”</p>
                <cite>Lucrări de referință în dreptul penal al afacerilor, în coautorat cu Ciprian Bodu (procuror, absolvent INM).</cite>
            </blockquote>
            <div class="pub-grid">
                <a class="pub-card" href="https://www.emag.ro/tratat-de-drept-societar-sebastian-bodu-rosetti-ed-2025-ros978-606-025-137-8/pd/DZDBPJ3BM/" target="_blank" rel="noopener noreferrer" data-aos="fade-up">
                    <small>eMAG · Editura Rosetti</small>
                    <h3>Tratat de drept societar</h3>
                    <p>Ediția 2025</p>
                    <span class="more">Comandă →</span>
                </a>
                <a class="pub-card" href="https://www.ujmag.ro/drept/drept-comercial/tratat-de-drept-societar-editia-2025" target="_blank" rel="noopener noreferrer" data-aos="fade-up" data-aos-delay="60">
                    <small>Universul Juridic</small>
                    <h3>Tratat de drept societar</h3>
                    <p>Ediția 2025 · UJMag.ro</p>
                    <span class="more">Comandă →</span>
                </a>
                <a class="pub-card" href="https://www.editurarosetti.ro/?id_autor=65" target="_blank" rel="noopener noreferrer" data-aos="fade-up" data-aos-delay="120">
                    <small>Editura Rosetti</small>
                    <h3>Colecția completă</h3>
                    <p>Toate lucrările autorului</p>
                    <span class="more">Vezi tot →</span>
                </a>
            </div>
        </div>
    </section>

    
    <section id="articole" class="section section-mid">
        <div class="wrap">
            <div class="section-head section-head--center" data-aos="fade-up">
                <p class="kicker">Publicistică</p>
                <h2>Articole publicate</h2>
                <div class="ornament" aria-hidden="true"><i></i><span></span><i></i></div>
                <p class="deck">Analize și studii în drept societar, comercial și arbitraj.</p>
            </div>

            <div class="pub-grid" data-aos="fade-up">
                <a class="pub-card" href="/articole/arbitraj-comercial-ccir.php">
                    <small>Pe site</small>
                    <h3>Arbitraj Comercial la Curtea de Arbitraj CCIR</h3>
                    <p>Ghid complet — avantaje, procedură, când se recomandă</p>
                    <span class="more">Citește →</span>
                </a>
                <a class="pub-card" href="/articole/drept-societar-ghid.php">
                    <small>Pe site</small>
                    <h3>Drept Societar: Ghid pentru companii</h3>
                    <p>Guvernanță, asociați, fuziuni, litigii corporative</p>
                    <span class="more">Citește →</span>
                </a>
                <a class="pub-card" href="/articole/intrebari-frecvente.php">
                    <small>Pe site</small>
                    <h3>Întrebări frecvente</h3>
                    <p>Răspunsuri despre domenii de practică și contact</p>
                    <span class="more">Citește →</span>
                </a>
            </div>

            <div class="mt-10" data-aos="fade-up">
                <h3 class="text-gold text-lg mb-4">Publicate pe JURIDICE.ro</h3>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a href="https://www.juridice.ro/806273/societati-comerciale-titlurile-de-participare-drepturile-societare-atasate-drepturi-conventionale.html" target="_blank" rel="noopener" class="hover:text-gold">Societăți comerciale. Titlurile de participare. Drepturile societare atașate</a> <span class="text-gray-500">(2025)</span></li>
                    <li><a href="https://www.juridice.ro/765501/societate-comerciala-vointa-sociala.html" target="_blank" rel="noopener" class="hover:text-gold">Societate comercială. Voința socială</a> <span class="text-gray-500">(2024)</span></li>
                    <li><a href="https://www.juridice.ro/714659/plafonarea-folosirii-numerarului-si-a-casei-probleme-de-constitutionalitate-ce-a-fost-si-ce-a-ramas-din-legea-nr-70-2015-dupa-modificarile-si-revenirile-aduse-prin-art-lxiv-din-legea-nr-296-2023.html" target="_blank" rel="noopener" class="hover:text-gold">Plafonarea folosirii numerarului și a casei</a> <span class="text-gray-500">(2023)</span></li>
                    <li><a href="https://www.juridice.ro/654901/arbitrabilitatea-litigiilor-in-materia-societatilor-comerciale-aspecte-corelative-de-drept-material-si-procesual.html" target="_blank" rel="noopener" class="hover:text-gold">Arbitrabilitatea litigiilor în materia societăților comerciale</a> <span class="text-gray-500">(2019)</span></li>
                    <li><a href="https://www.juridice.ro/author/sebastian-bodu" target="_blank" rel="noopener" class="text-gold font-semibold">→ Toate articolele pe JURIDICE.ro</a></li>
                </ul>
            </div>
        </div>
    </section>

    <section id="intrebari" class="section section-mid">
        <div class="wrap">
            <div class="section-head section-head--center" data-aos="fade-up">
                <p class="kicker">Întrebări frecvente</p>
                <h2>Avocat de afaceri în București</h2>
                <div class="ornament" aria-hidden="true"><i></i><span></span><i></i></div>
            </div>
            <div class="faq-list">
                <?php foreach (faqItems('ro') as $faq): ?>
                <details class="faq-item">
                    <summary><?= htmlspecialchars($faq['q'], ENT_QUOTES, 'UTF-8') ?></summary>
                    <p><?= htmlspecialchars($faq['a'], ENT_QUOTES, 'UTF-8') ?></p>
                </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="contact" class="section section-dark">
        <div class="wrap">
            <div class="contact-grid">
                <div data-aos="fade-right">
                    <div class="section-head">
                        <p class="kicker">Contact</p>
                        <h2>Solicitați o consultanță</h2>
                        <div class="ornament" aria-hidden="true"><i></i><span></span><i></i></div>
                        <p class="deck">Transmiteți o solicitare pentru consultanță juridică. Veți fi contactat în cel mai scurt timp.</p>
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
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/></svg>
                            </div>
                            <div>
                                <small>Cabinet</small>
                                <a href="https://avocatbodu.ro">avocatbodu.ro</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="letter">
                    <h3>Scrieți cabinetului</h3><p class="form-note">Toate câmpurile sunt obligatorii.</p>
                    <?php if ($statusMessage === "success"): ?>
                    <div class="alert alert-ok" role="status">Mesajul a fost transmis cu succes. Veți fi contactat în curând.</div>
                    <?php elseif ($statusMessage === "error"): ?>
                    <div class="alert alert-err" role="alert">A apărut o eroare la trimitere. Încercați din nou sau scrieți direct pe email.</div>
                    <?php endif; ?>
                    <form action="index.php#contact" method="POST">
                        <div class="field">
                            <label for="nume">Nume complet</label>
                            <input type="text" id="nume" name="nume" required autocomplete="name" maxlength="160" value="<?= htmlspecialchars($statusMessage === 'error' ? ($formValues['nume'] ?? '') : '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                        <div class="field">
                            <label for="email">Adresă email</label>
                            <input type="email" id="email" name="email" required autocomplete="email" maxlength="254" value="<?= htmlspecialchars($statusMessage === 'error' ? ($formValues['email'] ?? '') : '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                        <div class="field">
                            <label for="mesaj">Descrierea speței</label>
                            <textarea id="mesaj" name="mesaj" rows="4" required maxlength="10000" placeholder="Descrieți pe scurt situația juridică..."><?= htmlspecialchars($statusMessage === 'error' ? ($formValues['mesaj'] ?? '') : '', ENT_QUOTES, 'UTF-8') ?></textarea>
                        </div>
                        <button type="submit" name="trimite_contact" class="btn btn-navy">Transmite solicitarea</button>
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
                <p class="footer__sub">Cabinet de Avocat · Baroul București</p>
            </div>
            <div>
                <nav class="footer__links" aria-label="Domenii de practică">
                    <?php foreach (practiceCatalog() as $slug => $item): ?>
                    <a href="/<?= htmlspecialchars($slug, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($item['ro']['name'], ENT_QUOTES, 'UTF-8') ?></a>
                    <?php endforeach; ?>
                </nav>
                <p>&copy; <?= date('Y') ?> avocatbodu.ro · Toate drepturile rezervate</p>
            </div>
        </div>
    </footer>

</body>
</html>
