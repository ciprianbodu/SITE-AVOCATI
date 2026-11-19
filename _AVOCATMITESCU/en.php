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
    ['Civil law', 'Advice on inheritance matters and representation in civil disputes.'],
    ['Tax planning', 'Advice on the tax implications of a proposed transaction.'],
    ['Tax evasion', 'Legal assistance and defense in criminal cases involving tax evasion.'],
    ['Misconduct in office', 'Legal assistance in cases concerning abuse of office or negligence in office.'],
    ['Corruption', 'Advice and representation in criminal proceedings involving corruption offenses.'],
    ['Legal advice', 'Assessment of legal risks and options before you make a decision.'],
];
$profileCopy = <<<'HTML'
<p><strong>Alina-Maria Mitescu</strong> is the lead attorney at MITESCU LEGAL. Her practice covers civil disputes, tax matters and criminal defense.</p>
<p>During a consultation, you can explain your circumstances and review the documents you have with your lawyer to discuss your options and next steps.</p>
HTML;
require __DIR__ . '/partials/site.php';
