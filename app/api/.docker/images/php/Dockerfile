FROM php:8.0-apache

# WORKDIR /var/www/html

ENV APACHE_DOCUMENT_ROOT /var/www/html

RUN apt-get update -y && apt-get install -y libmariadb-dev
RUN docker-php-ext-install mysqli

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf && a2enmod rewrite && a2dissite 000-default && service apache2 restart

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN docker-php-ext-install mysqli pdo pdo_mysql 
RUN docker-php-ext-enable mysqli pdo pdo_mysql

RUN a2enmod ssl && a2enmod rewrite
RUN mkdir -p /etc/apache2/ssl
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

COPY ./fullchain.pem /etc/ssl/certs/
COPY ./privkey.pem /etc/ssl/private/
COPY ./keywords.conf /etc/apache2/sites-available/

RUN a2enmod rewrite && a2enmod ssl && a2enmod socache_shmcb
RUN sed -i '/SSLCertificateFile.*snakeoil\.pem/c\SSLCertificateFile \/etc\/ssl\/certs\/fullchain.pem' /etc/apache2/sites-available/default-ssl.conf && sed -i '/SSLCertificateKeyFile.*snakeoil\.key/cSSLCertificateKeyFile /etc/ssl/private/privkey.pem\' /etc/apache2/sites-available/default-ssl.conf
RUN a2ensite default-ssl.conf
RUN a2ensite keywords.conf
RUN apt-get update && apt-get upgrade -y

EXPOSE 80
EXPOSE 443

