# Étape 1 : image PHP avec Apache
FROM php:8.2-apache

# Installer les dépendances système et extensions PHP
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
    mariadb-client \
    libzip-dev \
    libicu-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Activer les modules Apache
RUN a2enmod rewrite headers

# Configurer Apache pour Laravel
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers de l'application
COPY . .

# Rendre le script deploy.sh exécutable
RUN chmod +x deploy.sh

# Définir les permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Installer les dépendances PHP (en production)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Installer les dépendances Node.js (INCLUANT les dépendances de développement pour Vite)
RUN npm install --no-audit --no-fund

# Construire les assets (Vite a besoin des dépendances dev)
RUN npm run build

# Point d'entrée
CMD ["/bin/bash", "-c", "/var/www/html/deploy.sh && exec apache2-foreground"]