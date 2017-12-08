ARG version
FROM php:$version

WORKDIR /var/www

COPY makefile makefile
COPY composer.json composer.json

RUN a2enmod rewrite
RUN apt-get update
RUN apt-get install -y zip unzip
RUN make install
