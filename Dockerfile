# Stage 1 - Build Frontend (Vite)
FROM node:22-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2 - Backend (Laravel + PHP + Composer)
FROM php:8.2-fpm-alpine AS backend

# Install system dependencies
RUN apk-get update && apk add --no-cache \
    git curl unzip libonig libzip-dev  \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy Laravel app
COPY . .

# Copy built frontend from Stage 1
COPY --from=frontend /app/public/dist ./public/dist

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel setup
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

# Set permissions for Laravel (CRITICAL - uses standard web user: www-data)
RUN chown -R www-data:www-data /var/www/storage \
    && chown -R www-data:www-data /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage

# Expose PHP-FPM port
EXPOSE 9000

# ----------------------------------------------------------------------
# Stage 3 - Web Server (Nginx) - Necessary for production HTTP service
FROM nginx:alpine AS final

# Copy custom Nginx configuration (must be present in your repo)
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Copy application files from the backend stage
COPY --from=backend /var/www /var/www

# Expose the port Render expects (10000)
EXPOSE 10000 

# Start Nginx
CMD ["nginx", "-g", "daemon off;"]
