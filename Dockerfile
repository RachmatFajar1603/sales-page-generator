# Build stage
FROM node:22-alpine AS node-builder

WORKDIR /app
COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build

# PHP stage
FROM php:8.3-apache

# Enable required PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Copy Apache config
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application files
COPY --chown=www-data:www-data . .
COPY --from=node-builder /app/public/build ./public/build

# Install Composer dependencies
RUN composer install --optimize-autoloader --no-dev

# Configure Apache
RUN a2enmod rewrite
RUN echo '<Directory /var/www/html/public>\n\
    Options -Indexes +FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
    <IfModule mod_rewrite.c>\n\
        RewriteEngine On\n\
        RewriteCond %{REQUEST_FILENAME} !-d\n\
        RewriteCond %{REQUEST_FILENAME} !-f\n\
        RewriteRule ^ index.php [L]\n\
    </IfModule>\n\
</Directory>' > /etc/apache2/sites-available/000-default.conf

RUN echo 'DocumentRoot /var/www/html/public' > /etc/apache2/conf-available/docker.conf && \
    a2enconf docker

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/health || exit 1

EXPOSE 80

CMD ["apache2-foreground"]
