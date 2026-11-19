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
    ['Drept civil', 'Consultanță în materie de succesiuni și reprezentare în litigii civile.'],
    ['Optimizare fiscală', 'Consultanță privind implicațiile fiscale ale operațiunilor pe care le aveți în vedere.'],
    ['Evaziune fiscală', 'Asistență și apărare în dosare penale privind evaziunea fiscală.'],
    ['Infracțiuni de serviciu', 'Asistență în cauze privind abuzul în serviciu sau neglijența în serviciu.'],
    ['Corupție', 'Asistență și reprezentare în cauze penale privind infracțiuni de corupție.'],
    ['Consultanță juridică', 'Identificarea riscurilor juridice și analiza opțiunilor înainte de luarea unei decizii.'],
];
$profileCopy = <<<'HTML'
<p><strong>Alina-Maria Mitescu</strong> este avocatul titular al cabinetului MITESCU LEGAL. Practica sa cuprinde litigii civile, chestiuni fiscale și apărarea în cauze penale.</p>
<p>În cadrul consultației puteți prezenta situația și înscrisurile de care dispuneți pentru a discuta opțiunile juridice și demersurile potrivite.</p>
HTML;
require __DIR__ . '/partials/site.php';
