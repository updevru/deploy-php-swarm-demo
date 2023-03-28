FROM composer:latest AS composer
FROM php:8.2-fpm

ENV TZ="Europe/Moscow"

RUN apt-get update \
    && apt-get install -y curl sed zlib1g-dev libzip-dev \
    && docker-php-ext-install zip

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY ./ /var/www/

WORKDIR /var/www/

RUN cp .env.default .env
RUN composer install
RUN chmod +x entrypoint.sh

ENTRYPOINT ["/var/www/entrypoint.sh"]
CMD ["php-fpm"]