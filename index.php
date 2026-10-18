<?php
$mailLocale = 'ro';
require __DIR__ . '/partials/send-contact-mail.php';
$seo = [
    'lang' => 'ro',
    'title' => 'Avocat Alina-Maria Mitescu | Drept Civil, Fiscal & Penal | MITESCU LEGAL',
    'description' => 'Cabinet de avocatură MITESCU LEGAL — Alina-Maria Mitescu, avocat titular. Drept civil, optimizare fiscală, evaziune fiscală, infracțiuni de serviciu, corupție. Consultanță la nivel național.',
    'keywords' => 'avocat Alina-Maria Mitescu, avocat mitescu, MITESCU LEGAL, avocat drept civil, avocat evaziune fiscala, optimizare fiscala, avocat penal, avocat Bucuresti, avocat Romania, cabinet avocatura',
    'canonical' => 'https://www.mitescu.ro/',
    'og_locale' => 'ro_RO',
    'alternate_ro' => 'https://www.mitescu.ro/',
    'alternate_en' => 'https://www.mitescu.ro/en.php',
];

$exp = [
                    ['Drept Civil', 'Litigii civile, succesiuni și consultanță strategică.'],
                    ['Optimizare Fiscală', 'Structuri legale pentru eficiență financiară maximă.'],
                    ['Evaziune Fiscală', 'Apărare specializată în cauze penale economice.'],
                    ['Infracțiuni de Serviciu', 'Asistență în cazuri de abuz sau neglijență în serviciu.'],
                    ['Corupție', 'Expertiză în dosare de mare complexitate (DNA/DIICOT).'],
                    ['Consultanță', 'Soluții juridice directe pentru prevenirea riscurilor.'],
                ];
$profileCopy = <<<'HTML'
<p><strong>Alina-Maria Mitescu</strong> este avocat titular al cabinetului MITESCU LEGAL, oferind consultanță și reprezentare juridică adaptată fiecărui caz în parte.</p>
                        <p>Seriozitatea avocaților noștri asigură un răspuns prompt și adecvat la orice problemă neprevăzută. Abordarea profesională elimină erorile, confuziile și neclaritățile, oferă siguranță clientului și contribuie la celeritatea soluționării speței juridice.</p>
                        <p>Reprezentăm interesele clienților noștri la nivel național, cu accent pe rezultate juridice maxime în favoarea clientului.</p>
HTML;
require __DIR__ . '/partials/site.php';
