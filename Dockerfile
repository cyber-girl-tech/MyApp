# Stage 1 - Build Frontend (Vite)
# Use Node 22 to match your local version (22.20.0)
FROM node:22-alpine AS frontend 
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
# This must succeed locally before deploying
RUN npm run build 

# ----------------------------------------------------------------------
# Stage 2 - Backend (Laravel + PHP + Composer)
FROM php:8.2-fpm-alpine AS backend 

# Install system dependencies (Use APK for Alpine)
RUN apk update && apk add --no-cache \
    git curl unzip libonig libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy application files (all files from repo root)
COPY . .

# Copy built frontend from Stage 1 (Uses standard 'build' directory)
COPY --from=frontend /app/public/build /var/www/public/build 

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel setup (Clear configs/cache)
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

# Set permissions for Laravel to write logs/cache (CRITICAL)
RUN chown -R www-data:www-data /var/www/storage \
    && chown -R www-data:www-data /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage

# Expose PHP-FPM port
EXPOSE 9000

# ----------------------------------------------------------------------
# Stage 3 - Web Server (Nginx) - Final minimal running image
FROM nginx:alpine AS final

# Copy Nginx configuration (MUST be in your repo root as nginx.conf)
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Copy application files from the backend stage
COPY --from=backend /var/www /var/www

# Expose the port Render expects (10000)
EXPOSE 10000 

# Start Nginx
CMD ["nginx", "-g", "daemon off;"]