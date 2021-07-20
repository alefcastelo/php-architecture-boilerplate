FROM php:8.0-fpm-alpine

RUN apk update && apk add --update --no-cache \
    $PHPIZE_DEPS \
    postgresql-dev \
    php8-dev \
    php8-curl \
    php8-pdo \
    php8-pdo_pgsql

RUN pecl install xdebug

RUN docker-php-ext-enable xdebug

RUN docker-php-ext-configure pgsql
RUN docker-php-ext-install pgsql pdo_pgsql

COPY ./docker/api/ext/* /usr/local/etc/php/conf.d/

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

WORKDIR /application

COPY . /application/

RUN composer install -n

RUN apk del $PHPIZE_DEPS postgresql-dev
RUN rm -rf /var/cache/apk/*