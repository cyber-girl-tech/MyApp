# --- STAGE 1: Build the code artifacts (Install Composer dependencies) ---
# Use the Composer image to install dependencies efficiently and separately
FROM composer:2 AS composer_stage

# Set the working directory
WORKDIR /app

# Copy necessary files for Composer and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Copy the rest of the application code
COPY . .


# --- STAGE 2: Create the production runtime environment ---
# Use a slim PHP-FPM image (with Alpine Linux) for a smaller final container
FROM php:8.2-fpm-alpine AS final_stage

# Install necessary system dependencies and PHP extensions for Laravel
# Includes Nginx to serve the app and common Laravel extensions
RUN apk add --no-cache \
    nginx \
    oniguruma-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl \
    && docker-php-ext-configure gd --with-webp --with-jpeg \
    && docker-php-ext-install gd

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the application files and vendors from the build stage
COPY --from=composer_stage /app /var/www/html

# Set the correct permissions for Laravel
# This is CRUCIAL for resolving 'storage' and 'bootstrap/cache' write errors.
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Copy Nginx configuration file
# This assumes you create a folder named .docker in your root.
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Expose the port Nginx will listen on
EXPOSE 8080

# The startup command: start PHP-FPM in the background and then Nginx in the foreground
CMD sh -c "php-fpm & nginx -g 'daemon off;'"