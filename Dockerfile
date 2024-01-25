FROM php:8.2-apache

# You should mount your source code to this volume
VOLUME ["/var/www/html"]

# Install XDebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Install MySQL drivers
RUN apt-get update && docker-php-ext-install mysqli pdo pdo_mysql

EXPOSE 80