FROM php:8.2-apache

# For Render
ENV PORT=10000
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# 1. Install system dependencies + Node.js
RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    gnupg \
    ca-certificates \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 2. Configure Apache for Render port AND set correct document root
RUN sed -i "s|Listen 80|Listen ${PORT}|g" /etc/apache2/ports.conf
RUN sed -i "s|:80|:${PORT}|g" /etc/apache2/sites-available/*.conf

# 3. Set Apache DocumentRoot to Laravel's public directory
RUN sed -ri -e "s|/var/www/html|${APACHE_DOCUMENT_ROOT}|g" /etc/apache2/sites-available/*.conf
RUN sed -ri -e "s|/var/www/|${APACHE_DOCUMENT_ROOT}|g" /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 4. Allow .htaccess overrides
RUN echo "<Directory ${APACHE_DOCUMENT_ROOT}>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" >> /etc/apache2/apache2.conf

# 5. Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring gd zip

# 6. Enable Apache modules
RUN a2enmod rewrite headers

# 7. Copy application
COPY . /var/www/html
WORKDIR /var/www/html

# 8. Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# 9. Install npm dependencies if package.json exists
RUN if [ -f "package.json" ]; then \
    npm ci --only=production || echo "npm install failed, continuing..."; \
    fi

# 10. Set CORRECT permissions (critical fix!)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# 11. Create index.php if missing (fallback)
RUN if [ ! -f /var/www/html/public/index.php ]; then \
    echo "<?php echo 'Laravel is setting up...'; ?>" > /var/www/html/public/index.php; \
    fi

CMD ["apache2-foreground"]