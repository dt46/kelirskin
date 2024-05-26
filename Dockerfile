FROM node:14 AS vite-builder
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build

FROM composer:2 AS composer
WORKDIR /app
COPY . .  
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

FROM php:8.1-fpm
WORKDIR /var/www/html
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    nginx \
    && docker-php-ext-install zip pdo_mysql \
    && docker-php-ext-enable pdo_mysql

COPY --from=vite-builder /app/public/dist /var/www/html/public/dist

COPY --from=composer /app/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html/storage

COPY default.conf /etc/nginx/sites-available/default

# CMD service nginx start && php-fpm