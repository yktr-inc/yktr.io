FROM php:7.2-fpm-alpine

RUN apk update \
    && apk add --no-cache git mysql-client yarn postgresql-dev curl libmcrypt libmcrypt-dev openssh-client icu-dev \
    libxml2-dev freetype-dev libpng-dev libjpeg-turbo-dev g++ make autoconf \
    && docker-php-source extract \
    && docker-php-source delete \
    && docker-php-ext-install exif gd pdo_mysql pgsql soap intl zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && rm -rf /tmp/*

CMD ["php-fpm", "-F"]

WORKDIR /var/www/yktr/
RUN chmod -R 777 /var/www/yktr/

EXPOSE 9000
