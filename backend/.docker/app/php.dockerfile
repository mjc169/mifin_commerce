FROM php:8.4-fpm

#Installing composer and doing composer install..."

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html/

#RUN apk add bash
RUN docker-php-ext-install pdo pdo_mysql