# avocatbodu.ro - plain PHP site on Apache, for Coolify (Dockerfile build pack).
# Runtime path: Cloudflare edge -> cloudflared -> Traefik (entrypoint "http", plain HTTP) -> this container :80
# PHP 8.4: active support until 2026-12-31, security fixes until 2028-12-31 (php.net/supported-versions.php).
FROM php:8.4-apache-trixie

RUN set -eux; \
    a2enmod rewrite headers expires deflate remoteip; \
    sed -ri -e 's/^ServerTokens .*/ServerTokens Prod/' -e 's/^ServerSignature .*/ServerSignature Off/' \
        /etc/apache2/conf-available/security.conf; \
    { \
      echo 'ServerName avocatbodu.ro'; \
      echo 'ServerTokens Prod'; \
      echo 'ServerSignature Off'; \
      echo 'TraceEnable Off'; \
      echo '<Directory /var/www/html>'; \
      echo '    Options -Indexes +FollowSymLinks'; \
      echo '    AllowOverride All'; \
      echo '    Require all granted'; \
      echo '</Directory>'; \
      echo '# Real visitor IP: Cloudflare sends CF-Connecting-IP; only Traefik / the docker bridge talk to us'; \
      echo 'RemoteIPHeader CF-Connecting-IP'; \
      echo 'RemoteIPTrustedProxy 10.0.0.0/8 172.16.0.0/12 192.168.0.0/16 127.0.0.1 fd00::/8 ::1'; \
      echo 'LogFormat "%a %l %u %t \"%r\" %>s %O \"%{Referer}i\" \"%{User-Agent}i\"" combined'; \
    } > /etc/apache2/conf-available/zz-avocatbodu.conf; \
    a2enconf zz-avocatbodu; \
    { \
      echo '<VirtualHost *:80>'; \
      echo '    # TLS ends at Cloudflare. The https:// scheme here makes Apache build its own redirects'; \
      echo '    # (mod_dir trailing slash, relative R=301 targets) as https://<Host>/... instead of http://'; \
      echo '    ServerName https://avocatbodu.ro'; \
      echo '    ServerAlias www.avocatbodu.ro'; \
      echo '    UseCanonicalName Off'; \
      echo '    DocumentRoot /var/www/html'; \
      echo '    ErrorLog ${APACHE_LOG_DIR}/error.log'; \
      echo '    CustomLog ${APACHE_LOG_DIR}/access.log combined'; \
      echo '</VirtualHost>'; \
    } > /etc/apache2/sites-available/000-default.conf; \
    mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"; \
    { \
      echo 'expose_php = Off'; \
      echo 'display_errors = Off'; \
      echo 'log_errors = On'; \
      echo 'date.timezone = Europe/Bucharest'; \
      echo 'opcache.enable = 1'; \
    } > "$PHP_INI_DIR/conf.d/zz-avocatbodu.ini"; \
    apache2ctl -t

COPY --chown=root:root . /var/www/html/

# Belt and braces: even if .dockerignore is bypassed, never ship secrets or build files.
# config.php is supplied at runtime (Coolify file mount at /var/www/html/config.php).
RUN set -eux; \
    cd /var/www/html; \
    rm -rf config.php sftp.json .vscode .git .gitignore .dockerignore Dockerfile *.code-workspace; \
    chown root:root /var/www/html; \
    find . -type d -exec chmod 755 {} +; \
    find . -type f -exec chmod 644 {} +

EXPOSE 80

# Sends CF-Visitor so the HTTPS redirect is skipped and index.php really executes (PHP + Apache).
HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
    CMD ["curl", "-fsS", "-o", "/dev/null", "-H", "Host: avocatbodu.ro", "-H", "CF-Visitor: {\"scheme\":\"https\"}", "http://127.0.0.1/"]
