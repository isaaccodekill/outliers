FROM php:apache

RUN docker-php-ext-install mysqli

COPY asset-mgmt/ /var/www/html/
