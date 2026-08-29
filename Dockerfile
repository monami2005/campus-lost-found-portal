FROM php:8.4-apache

# 1. Install system dependencies and PHP extensions required by Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libsqlite3-dev \
    && docker-php-ext-install \
    pdo_mysql \
    pdo_sqlite \
    zip \
    gd \
    bcmath \
    opcache \
    && rm -rf /var/lib/apt/lists/*

# 2. Configure Apache MPM
# PHP Apache image needs exactly ONE MPM.
RUN a2dismod mpm_event mpm_worker mpm_prefork || true \
    && a2enmod mpm_prefork \
    && a2enmod rewrite

# 3. Configure Apache DocumentRoot to point to Laravel public folder
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' \
    /etc/apache2/sites-available/*.conf

RUN sed -ri -e 's!/var/www/!/var/www/html/public!g' \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# 4. Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 5. Set working directory
WORKDIR /var/www/html

# 6. Copy application files
COPY . .

# 7. Install production Composer dependencies
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-scripts

# Regenerate optimized autoload
RUN composer dump-autoload --no-dev --optimize

# 8. Create Laravel writable directories
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    database \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache database

# 9. Make startup script executable
RUN chmod +x docker-entrypoint.sh

# 10. Start application through entrypoint
ENTRYPOINT ["/var/www/html/docker-entrypoint.sh"]