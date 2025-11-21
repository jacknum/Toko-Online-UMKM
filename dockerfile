# Stage 1: Node builder
FROM node:20 AS node-builder
WORKDIR /app
COPY package.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: Composer builder (PHP 8.2 image)
FROM composer:2 AS composer-builder
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader
COPY . .
RUN composer dump-autoload --optimize

# Stage 3: Final image for Laravel
FROM php:8.2-fpm

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring bcmath gd

WORKDIR /var/www

# Copy hasil build Node
COPY --from=node-builder /app/public/build ./public/build

# Copy vendor Composer
COPY --from=composer-builder /app/vendor ./vendor

# Copy seluruh project
COPY . .

# Permissions
RUN chown -R www-data:www-data /var/www
