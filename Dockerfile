# Use the official PHP 8.3 image with extensions
FROM php:8.3-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy everything
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy existing application key or generate one if missing
RUN php artisan key:generate || true

# Expose port 8000
EXPOSE 8000

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000