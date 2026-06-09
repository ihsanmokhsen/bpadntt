FROM php:8.4-cli-alpine

RUN apk add --no-cache \
        icu-dev \
        libzip-dev \
        postgresql-dev \
    && docker-php-ext-install \
        intl \
        pdo_pgsql \
        zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
