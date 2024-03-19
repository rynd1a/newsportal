FROM php:8.1.4-fpm

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y git zip unzip libpq-dev exiftool

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-configure exif \
    && docker-php-ext-install exif \
    && docker-php-ext-enable exif \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD ["php-fpm"]
