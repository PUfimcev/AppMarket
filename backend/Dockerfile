FROM php:8.5.12-fpm

ARG REDIS_PECL_VERSION=6.3.0

RUN apt-get update && apt-get install -y --no-install-recommends \
    curl unzip zip \
    libpq-dev libzip-dev libicu-dev \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    $PHPIZE_DEPS \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql gd intl zip bcmath \
    && pecl install "redis-${REDIS_PECL_VERSION}" \
    && docker-php-ext-enable redis \
    && apt-get purge -y --auto-remove $PHPIZE_DEPS \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2.8.12 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-dev --optimize-autoloader --no-scripts
COPY . .
RUN composer dump-autoload --optimize \
    && php artisan package:discover --ansi
RUN chown -R www-data:www-data storage bootstrap/cache
EXPOSE 9000
CMD ["php-fpm"]
