# Étape 1 : Base PHP
FROM php:8.2-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    build-essential \
    nginx \
    supervisor \
    zip unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installer Node.js (LTS)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Copier le code Laravel
WORKDIR /var/www/html
COPY . .

# Installer les dépendances Laravel
RUN composer install --optimize-autoloader --no-dev

# Compiler les assets
RUN npm install && npm run build

# Optimiser Laravel
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Copier configuration nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Copier configuration supervisor
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Ajouter le certificat SSL pour MySQL Aiven
COPY docker/ca.pem /etc/ssl/certs/ca.pem

EXPOSE 80

CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

