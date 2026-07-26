FROM php:8.3-fpm-alpine AS runtime

RUN apk add --no-cache git icu-libs libzip libpng libjpeg-turbo freetype libxml2 oniguruma \
    && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS icu-dev libzip-dev libpng-dev libjpeg-turbo-dev freetype-dev libxml2-dev oniguruma-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" bcmath gd intl mbstring mysqli opcache pcntl pdo_mysql soap zip \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del .build-deps

FROM runtime AS vendor

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress --optimize-autoloader

FROM node:24-alpine AS assets

WORKDIR /var/www/html
COPY package.json package-lock.json ./
RUN npm ci
COPY resources ./resources
COPY vite.config.js ./
RUN npm run build

FROM runtime

WORKDIR /var/www/html
COPY --from=vendor /var/www/html/vendor ./vendor
COPY --from=assets /var/www/html/public/css ./public/css
COPY --from=assets /var/www/html/public/js ./public/js
COPY . .
RUN mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache
COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint
USER www-data
ENTRYPOINT ["entrypoint"]
CMD ["php-fpm"]
