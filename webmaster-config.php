<?php
/**
 * Verificare domeniu — Google Search Console & Bing Webmaster Tools
 *
 * 1. Google: https://search.google.com/search-console
 *    → Adaugă proprietate → Prefix URL → https://avocatbodu.ro
 *    → Verificare → „Etichetă HTML” → copiază DOAR codul din content="..."
 *    → Lipește mai jos la GOOGLE_SITE_VERIFICATION
 *
 * 2. Bing: https://www.bing.com/webmasters
 *    → Adaugă site → Verificare meta tag → copiază content="..."
 *    → Lipește la BING_SITE_VERIFICATION
 *
 * 3. Upload pe server, apoi apasă „Verifică” în Google/Bing.
 */

// Exemplu: define('GOOGLE_SITE_VERIFICATION', 'aBcDeFgHiJkLmNoPqRsTuVwXyZ1234567890');
define('GOOGLE_SITE_VERIFICATION', '2ne_mFDmEK8H5LesW-0uQZ7KLLhulX7OpsrFm_IHSIM');

// Exemplu: define('BING_SITE_VERIFICATION', '1A2B3C4D5E6F7G8H9I0J');
define('BING_SITE_VERIFICATION', '');
