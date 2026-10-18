<?php
$mailLocale = 'en';
require __DIR__ . '/partials/send-contact-mail.php';
$seo = [
    'lang' => 'en',
    'title' => 'Attorney Alina-Maria Mitescu | Civil, Tax & Criminal Law | MITESCU LEGAL',
    'description' => 'MITESCU LEGAL — Alina-Maria Mitescu, lead attorney. Civil law, tax optimization, tax evasion defense, abuse of office, corruption. Nationwide legal representation in Romania.',
    'keywords' => 'Alina-Maria Mitescu attorney, MITESCU LEGAL, Romanian lawyer, tax lawyer Romania, criminal defense attorney, civil law Romania',
    'canonical' => 'https://www.mitescu.ro/en.php',
    'og_locale' => 'en_US',
    'alternate_ro' => 'https://www.mitescu.ro/',
    'alternate_en' => 'https://www.mitescu.ro/en.php',
];

$exp = [
                    ['Civil Law', 'Civil litigation, succession and strategic consultancy.'],
                    ['Tax Optimization', 'Legal structures for maximum financial efficiency.'],
                    ['Tax Evasion', 'Specialized defense in economic criminal cases.'],
                    ['Abuse of Office', 'Assistance in abuse of office or negligence cases.'],
                    ['Corruption', 'Expertise in high-complexity cases (DNA/DIICOT).'],
                    ['Consultancy', 'Direct legal solutions for risk prevention.'],
                ];
$profileCopy = <<<'HTML'
<p><strong>Alina-Maria Mitescu</strong> is the lead attorney at MITESCU LEGAL, providing legal advice and representation tailored to each case.</p>
                        <p>Our professionalism ensures a prompt and appropriate response to any unforeseen issue. A rigorous approach eliminates errors, confusion and ambiguity, gives clients certainty and helps resolve legal matters efficiently.</p>
                        <p>We represent our clients nationwide, with a focus on achieving the best possible legal outcomes.</p>
HTML;
require __DIR__ . '/partials/site.php';
