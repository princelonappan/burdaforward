FROM php:7.4-apache
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip
RUN mkdir -p /var/www/html/dynamic-router/
WORKDIR /var/www/html/dynamic-router/
COPY . /var/www/html/dynamic-router/

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN composer install