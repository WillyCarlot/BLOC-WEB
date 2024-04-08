FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    && docker-php-ext-configure pdo_mysql \
	&& docker-php-ext-install -j$(nproc) pdo_mysql

ENV STATIC_DOMAIN="static.example.com"
ENV SOURCE_DOMAIN="example.com"

# set ServerName in apache2.conf
RUN echo "ServerName ${SOURCE_DOMAIN}" >> /etc/apache2/apache2.conf

# set up error pages
RUN echo '\
Alias /errors /var/www/html/errors\n\
<Directory /var/www/html/errors>\n\
    Options Indexes FollowSymLinks MultiViews\n\
    Require all granted\n\
</Directory>\n\
ErrorDocument 400 /errors/HTTP400.html\n\
ErrorDocument 401 /errors/HTTP401.html\n\
ErrorDocument 403 /errors/HTTP403.html\n\
ErrorDocument 404 /errors/HTTP404.html\n\
ErrorDocument 500 /errors/HTTP500.html\n\
ErrorDocument 501 /errors/HTTP501.html\n\
ErrorDocument 502 /errors/HTTP502.html\n\
ErrorDocument 503 /errors/HTTP503.html\n\
ErrorDocument 504 /errors/HTTP504.html\n\
' > /etc/apache2/conf-available/error-pages.conf

# create vhosts, using env vars for domain names
RUN echo '\
<VirtualHost *:80>\n\
    ServerName ${SOURCE_DOMAIN}\n\
    \n\
    RewriteEngine On\n\
    \n\
    DocumentRoot /var/www/html/source\n\
    <Directory /var/www/html/source>\n\
        Order allow,deny\n\
        Allow from all\n\
        RewriteBase /\n\
        RewriteCond %{REQUEST_FILENAME} !-d\n\
        RewriteCond %{REQUEST_FILENAME} !-f\n\
        RewriteRule ^(.+)$ index.php [QSA,L]\n\
    </Directory>\n\
    \n\
    <Directory /var/www/html/source/private>\n\
        Order deny,allow\n\
        Deny from all\n\
    </Directory>\n\
</VirtualHost>\
' > /etc/apache2/sites-available/001-${SOURCE_DOMAIN}.conf

RUN echo '\
<VirtualHost *:80>\n\
    ServerName ${STATIC_DOMAIN}\n\
    DocumentRoot /var/www/html/static\n\
    <Directory /var/www/html/static>\n\
        Options Indexes FollowSymLinks MultiViews\n\
        AllowOverride All\n\
        Order allow,deny\n\
        allow from all\n\
    </Directory>\n\
</VirtualHost>\
' > /etc/apache2/sites-available/001-${STATIC_DOMAIN}.conf

# enable vhosts & error pages
RUN a2enmod rewrite
RUN a2ensite 001-${SOURCE_DOMAIN}.conf
RUN a2ensite 001-${STATIC_DOMAIN}.conf
RUN a2enconf error-pages

# copy source code
RUN mkdir -p /var/www/html/source
RUN mkdir -p /var/www/html/static
RUN mkdir -p /var/www/html/errors
COPY source/ /var/www/html/source/
COPY static/ /var/www/html/static/
COPY errors/ /var/www/html/errors

# ensure correct permissions
RUN chown -R www-data:www-data /var/www/html

# expose port 80
EXPOSE 80