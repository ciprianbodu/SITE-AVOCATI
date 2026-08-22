<?php
declare(strict_types=1);

/**
 * Site and mail configuration.
 * SMTP credentials can be overridden via environment variables.
 */
const SITE_NAME = 'Cabinet de Avocat Prof. univ. dr. Sebastian V. Bodu';
const SITE_URL  = 'https://avocatbodu.ro';
const SITE_EMAIL = 'sebastian@avocatbodu.ro';
const PUBLIC_EMAIL = 'bodu.sebastian@gmail.com';
const MONITOR_URL = 'https://avocatbodu.ro/monitor';

const SMTP_HOST = 'mail.avocatbodu.ro';
const SMTP_PORT = 465;
const SMTP_USER = 'sebastian@avocatbodu.ro';
const SMTP_SECURE = 'smtps';

function smtp_password(): string
{
    $fromEnv = getenv('SMTP_PASSWORD');
    return $fromEnv !== false && $fromEnv !== '' ? $fromEnv : 'jing22IT!';
}
