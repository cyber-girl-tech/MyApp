# Stage 1: Build the PHP environment and install Composer dependencies
FROM php:8.2-fpm-alpine AS composer_stage

# Install necessary system packages and PHP extensions
RUN apk add --no-cache git openssh-client curl \
    && docker-php-ext-install pdo pdo_mysql opcache \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory inside the container
WORKDIR /var/www/html

# Copy application source code
COPY . .

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Run Laravel commands for production optimization
RUN php artisan key:generate --ansi \
    && php artisan config:cache \
    && php artisan route:cache

# --- Stage 2: Production environment with Nginx ---
FROM nginx:alpine

# Remove default Nginx config
RUN rm /etc/nginx/conf.d/default.conf

# Copy custom Nginx configuration from your local project
COPY conf/nginx-site.conf /etc/nginx/conf.d/default.conf

# Copy custom PHP-FPM configuration to override the listen address
# Adjust '8.2' if your PHP version is different
COPY conf/www.conf /etc/php/8.2/fpm/pool.d/www.conf

# Copy compiled source code and vendor files from the build stage
COPY --from=composer_stage /var/www/html /var/www/html

# Set permissions for Laravel (storage and cache must be writable)
# The Nginx/FPM processes run as the 'nginx' or 'www-data' user in Alpine,
# so we ensure the folders are writable.
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache

# Expose port 80 (Nginx listens on this port)
EXPOSE 80

# The Start Command: Run both PHP-FPM and Nginx simultaneously
# php-fpm -D runs PHP-FPM in the background (daemon mode)
# nginx -g "daemon off;" runs Nginx in the foreground, keeping the service alive
CMD php-fpm -D && nginx -g "daemon off