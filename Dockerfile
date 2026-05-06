# =========================
# 1. Stage: Composer (PHP deps)
# =========================
FROM composer:2 AS vendor

WORKDIR /app

# Chỉ copy file cần để tận dụng cache
COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --prefer-dist

# Copy toàn bộ source rồi dump autoload
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

# Cài extension cần thiết
RUN apk add --no-cache \
    bash \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd

# Set working dir
WORKDIR /var/www

# Copy source + vendor + build assets
COPY --from=vendor /app /var/www
COPY --from=frontend /app/public/build /var/www/public/build

# Permission
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# Laravel optimize (không chạy nếu thiếu ENV → dùng || true)
RUN php artisan config:cache || true \
 && php artisan route:cache || true \
 && php artisan view:cache || true

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]