FROM composer:2.6 as composer-build
WORKDIR /app

COPY . .
RUN composer install

FROM php:8.1-fpm as app
WORKDIR /var/www/html
COPY . .
COPY --from=composer-build /app/vendor ./vendor