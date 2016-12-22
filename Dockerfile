FROM php:7-apache
RUN a2enmod rewrite
COPY . /var/www
