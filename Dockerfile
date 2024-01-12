FROM php:7.4-apache

RUN a2enmod rewrite
RUN service apache2 restart

WORKDIR /var/www/html

COPY public /var/www/html
COPY src /var/www/html
COPY .env /var/www/html

RUN apt-get update && apt-get install -y mysql-client

RUN docker-php-ext-install mysqli pdo_mysql

EXPOSE 80

CMD ["apache2-foreground"]
