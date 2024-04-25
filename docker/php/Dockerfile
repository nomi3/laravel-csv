FROM php:8.3-fpm-alpine

ENV COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

RUN apk update && \
  apk add --no-cache git unzip libzip-dev icu-dev \
  freetype-dev libjpeg-turbo-dev libpng-dev && \
  docker-php-ext-install intl pdo_mysql zip bcmath && \
  docker-php-ext-configure gd --with-freetype --with-jpeg && \
  docker-php-ext-install gd

COPY ./php.ini /usr/local/etc/php/php.ini

WORKDIR /data