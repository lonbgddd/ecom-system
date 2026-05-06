# =========================
# 1. Stage: Composer (PHP deps)
# =========================
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --prefer-dist

COPY . .

RUN composer dump-autoload --optimize


# =========================
# 2. Stage: Node (build Vite)
# =========================
FROM node:20-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json* ./

RUN npm ci

COPY . .

RUN npm run build


# =========================
# 3. Stage: Final (PHP runtime)
# =========================
FROM php:8.2-fpm-alpine

# Cài system packages
RUN apk add --no-cache \
    bash \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    postgresql-dev  

RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd
WORKDIR /var/www

# Copy source + vendor + build assets
COPY --from=vendor /app /var/www
COPY --from=frontend /app/public/build /var/www/public/build

# Permission
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8000

# Start (cache đúng thời điểm runtime)
CMD sh -c "php artisan config:clear && \
php artisan cache:clear && \
php artisan config:cache && \
php artisan route:cache && \
php artisan view:cache && \
php artisan migrate --force && \
php artisan storage:link && \
php -S 0.0.0.0:8000 -t public"