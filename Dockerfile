FROM php:7.3-cli

RUN apt-get update && apt-get install -y libpq-dev libicu-dev git wget \
    && docker-php-ext-install pcntl intl \
    && pecl install mongodb xdebug \
    && docker-php-ext-enable mongodb xdebug

COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN wget https://getcomposer.org/installer -O - -q | php -- --install-dir=/bin --filename=composer --quiet

ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /var/www/html