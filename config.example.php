<?php
/**
 * Config template — copy to config.php and fill real values.
 * config.php is gitignored and must never be committed.
 * On Nitro it is supplied as a Coolify File Mount at /var/www/html/config.php.
 * The code always uses SMTPS, so the port must be 465.
 */
return [
    'smtp_host'     => 'smtp.gmail.com',
    'smtp_port'     => 465,
    'smtp_user'     => 'SENDER_ACCOUNT@gmail.com',
    'smtp_pass'     => 'GMAIL_APP_PASSWORD_HERE',
    'smtp_secure'   => 'ssl', // unused: the code always uses SMTPS
    'from_email'    => 'SENDER_ACCOUNT@gmail.com', // Gmail only sends as the logged-in account or its aliases
    'from_name'     => 'Site Avocat Bodu',
    'to_email'      => 'bodu.sebastian@gmail.com',
];
