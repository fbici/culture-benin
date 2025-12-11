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
    default-mysql-client \
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

# Définir les permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Installer les dépendances PHP (en production)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Installer les dépendances Node.js
RUN npm install --production --no-audit --no-fund

# Construire les assets
RUN npm run build

# Créer un script de démarrage
RUN echo '#!/bin/bash' > /start.sh && \
    echo 'echo "🚀 Démarrage de l\'application..."' >> /start.sh && \
    echo 'if [ ! -f .env ]; then' >> /start.sh && \
    echo '    echo "📝 Création du fichier .env..."' >> /start.sh && \
    echo '    cp .env.example .env' >> /start.sh && \
    echo 'fi' >> /start.sh && \
    echo 'if ! grep -q "APP_KEY=base64:" .env; then' >> /start.sh && \
    echo '    echo "🔑 Génération de la clé d\'application..."' >> /start.sh && \
    echo '    php artisan key:generate --force' >> /start.sh && \
    echo 'fi' >> /start.sh && \
    echo 'php artisan config:clear' >> /start.sh && \
    echo 'php artisan cache:clear' >> /start.sh && \
    echo 'php artisan view:clear' >> /start.sh && \
    echo 'php artisan route:clear' >> /start.sh && \
    echo 'php artisan storage:link || true' >> /start.sh && \
    echo 'php artisan config:cache' >> /start.sh && \
    echo 'php artisan route:cache' >> /start.sh && \
    echo 'php artisan view:cache' >> /start.sh && \
    echo 'echo "✅ Application prête!"' >> /start.sh && \
    echo 'exec apache2-foreground' >> /start.sh && \
    chmod +x /start.sh

# Point d'entrée
CMD ["/start.sh"]