# Étape 1 : image PHP avec Apache
FROM php:8.2-apache

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Activer les modules Apache
RUN a2enmod rewrite

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers de l'application
COPY . .

# Définir les permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Installer les dépendances Node
RUN npm install --no-audit --no-fund

# Build les assets
RUN npm run build

# Créer un script de démarrage
RUN echo '#!/bin/bash' > /start.sh && \
    echo 'if [ ! -f .env ]; then cp .env.example .env; fi' >> /start.sh && \
    echo 'if ! grep -q "APP_KEY=base64:" .env; then php artisan key:generate --force; fi' >> /start.sh && \
    echo 'php artisan config:clear' >> /start.sh && \
    echo 'php artisan cache:clear' >> /start.sh && \
    echo 'php artisan view:clear' >> /start.sh && \
    echo 'php artisan route:clear' >> /start.sh && \
    echo 'php artisan storage:link || true' >> /start.sh && \
    echo 'php artisan config:cache' >> /start.sh && \
    echo 'exec apache2-foreground' >> /start.sh && \
    chmod +x /start.sh

# Exposer le port 80
EXPOSE 80

# Point d'entrée
CMD ["/start.sh"]