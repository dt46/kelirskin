# Stage 1: Build the Vite app
FROM node:20 AS vite-builder
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build
RUN ls -la /app/public/build
RUN ls -la /app/public/dist

# Stage 2: Setup PHP and Laravel
FROM composer:2 AS composer
WORKDIR /app
COPY . .  
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Stage 3: Setup the final image
FROM php:8.1-fpm
WORKDIR /var/www/html
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    nginx \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-enable pdo_pgsql

# Copy Vite build output
COPY --from=vite-builder /app/public/dist /var/www/html/public/dist
COPY --from=vite-builder /app/public/build /var/www/html/public/build

# Copy Composer dependencies
COPY --from=composer /app/ /var/www/html/

# Change owner to www-data for Laravel storage
RUN chown -R www-data:www-data /var/www/html/storage

# Copy Nginx default configuration
COPY default.conf /etc/nginx/sites-available/default

# Start Nginx and PHP-FPM
CMD service nginx start && php-fpm