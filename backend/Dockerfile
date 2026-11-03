FROM node:24-alpine AS node

WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

FROM php:8.5.12-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev

RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg

RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    gd  \
    intl \
    zip \
    bcmath

ARG REDIS_PECL_VERSION=6.2.0

COPY --from=composer:2.8.12 /usr/bin/composer /usr/bin/composer

RUN pecl install "redis-${REDIS_PECL_VERSION}" \
    && docker-php-ext-enable redis

WORKDIR /var/www
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-dev --optimize-autoloader
COPY . .
COPY --from=node /app/public/build ./public/build
RUN chown -R www-data:www-data storage bootstrap/cache
EXPOSE 9000
CMD ["php-fpm"]



