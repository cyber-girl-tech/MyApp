# Stage 1 - Build Frontend (Vite)
FROM node:18 AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2 - Backend (Laravel + PHP + Composer)
FROM php:8.2-fpm AS backend

# Install system dependencies (Keeping your existing apt-get command)
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy app files
COPY . .

# Corrected asset copy path for the host directory
COPY --from=frontend /app/public/build /var/www/public/build 

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel setup
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

# CRITICAL ADDITION: Add permissions for storage/cache (Essential for runtime)
RUN chown -R www-data:www-data /var/www/storage \
    && chown -R www-data:www-data /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage

EXPOSE 9000

# ----------------------------------------------------------------------
# Stage 3 - Web Server (Nginx) - ADDED TO FIX "NO HTTP PORTS" ERROR
FROM nginx:alpine AS final

# CRITICAL REQUIREMENT: Copy Nginx configuration
# You MUST create an nginx.conf file in your project root for this to work.
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Copy application files from the backend stage
COPY --from=backend /var/www /var/www

# Expose the port Render expects for the HTTP listener
EXPOSE 10000 

# Start Nginx
CMD ["nginx", "-g", "daemon off;"]