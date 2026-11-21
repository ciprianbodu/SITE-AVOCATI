# Ionuț-Cosmin Carașca

Site bilingv pentru cabinetul de avocat din județul Constanța. Conținutul și datele de contact se editează în `partials/content.php`.

Pentru previzualizare locală, din acest folder, rulează `php -S 127.0.0.1:8080 index.php` cu PHP 8.2 sau mai nou și deschide `http://127.0.0.1:8080/`.

Pe Nitro, site-ul IIS folosește acest folder ca rădăcină și servește PHP 8.2 sau mai nou prin FastCGI. `web.config` folosește modulul URL Rewrite pentru rutele PHP și redirecționează `www.avocat-carasca.ro` și cererile HTTP către `https://avocat-carasca.ro`. Configurează bindinguri IIS și un certificat HTTPS pentru ambele nume înainte de a direcționa Cloudflare către origine prin HTTPS.

În zona Cloudflare dedicată domeniului, configurează `avocat-carasca.ro` și `www.avocat-carasca.ro` să ajungă la site-ul IIS de pe Nitro. Folosește în ROTLD nameserverele atribuite de Cloudflare acestei zone. Verifică după publicare `/`, `/en/`, `/drept-penal`, `/robots.txt` și `/sitemap.xml`.

Pentru instalările Apache rămân disponibile regulile din `.htaccess`, cu `mod_rewrite` și `AllowOverride All`.

## Surse publice

- Statut, barou, telefon și adresă profesională. [LaTermen](https://latermen.ro/avocati/carasca-ionut-cosmin-7776)
- Denumirea cabinetului și adresa profesională. [Termene](https://termene.ro/firma/55515675-CARASCA-IONUT-COSMIN-CABINET-DE-AVOCAT)
- Ariile de practică indicate în profil. [Avocatnet](https://www.avocatnet.ro/consultant/Ionut-Carasca.html*2535)
- Interviul din 11 martie 2021 despre darea în plată. [Ziua de Constanța](https://www.ziuaconstanta.ro/stiri/interviu-online/interviu-online-cu-ionut-carasca-avocat-in-cadrul-baroului-constanta-modificarile-legii-darii-in-plata-aspecte-esentiale-741923.html)
- Activitatea avocatului Diana RAISCHI în cauze penale. [Curtea de Apel Constanța](https://portal.just.ro/36/Documents/ANUNTURI_SEDINTE/PENAL/_lista_sedinte_2025/lista%20apeluri%2015.01.2025.pdf)
