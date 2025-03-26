FROM php:8.4-fpm

# Install necessary packages, including libzip-dev
RUN apt-get update && apt-get install -y zip unzip git libzip-dev
RUN docker-php-ext-install zip

#Installing composer and doing composer install..."

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html/

#RUN apk add bash
RUN docker-php-ext-install pdo pdo_mysql