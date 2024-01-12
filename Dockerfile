FROM php:7.4-cli

WORKDIR /var/www/html

COPY public /var/www/html/public
COPY src /var/www/html/src
COPY .env /var/www/html/.env

RUN docker-php-ext-install mysqli pdo_mysql
