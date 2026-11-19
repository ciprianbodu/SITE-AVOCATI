<?php
/**
 * Copy to mail-config.php and fill in the real values.
 * mail-config.php is gitignored and must never be committed.
 * On Nitro it is supplied as a Coolify File Mount at /var/www/html/mail-config.php.
 */
return [
    'account_id' => 'CLOUDFLARE_ACCOUNT_ID',
    'api_token'  => 'CLOUDFLARE_EMAIL_SENDING_API_TOKEN',
    'from_email' => 'sebastian@avocatbodu.ro',
    'from_name'  => 'Site Avocat Bodu',
    'to_email'   => 'sebastian@avocatbodu.ro',
];
