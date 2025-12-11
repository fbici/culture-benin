#!/bin/bash

echo "🚀 Démarrage du déploiement Laravel sur Render..."

# Vérifier si on est en production
if [ "${RENDER}" = "true" ]; then
    echo "🌐 Environnement Render détecté"
    
    # Attendre que la base de données soit prête (Render fournit DATABASE_URL)
    if [ -n "${DATABASE_URL}" ]; then
        echo "🗄️  Configuration de la base de données Render..."
        # Extraire les informations de la DATABASE_URL
        DB_HOST=$(echo ${DATABASE_URL} | sed -e 's/.*@\(.*\):.*/\1/')
        DB_PORT=$(echo ${DATABASE_URL} | sed -e 's/.*:\([0-9]*\)\/.*/\1/')
        DB_NAME=$(echo ${DATABASE_URL} | sed -e 's/.*\/\(.*\)$/\1/')
        DB_USER=$(echo ${DATABASE_URL} | sed -e 's/.*\/\/\(.*\):.*/\1/')
        DB_PASSWORD=$(echo ${DATABASE_URL} | sed -e 's/.*:\(.*\)@.*/\1/')
        
        # Créer le fichier .env pour Render
        cat > .env << EOF
APP_NAME="Culture Benin"
APP_ENV=production
APP_KEY=${APP_KEY}
APP_DEBUG=false
APP_URL=${APP_URL}

LOG_CHANNEL=stderr

DB_CONNECTION=mysql
DB_HOST=${DB_HOST}
DB_PORT=${DB_PORT}
DB_DATABASE=${DB_NAME}
DB_USERNAME=${DB_USER}
DB_PASSWORD=${DB_PASSWORD}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
EOF
    fi
else
    echo "💻 Environnement local détecté"
    
    # Créer le fichier .env si inexistant
    if [ ! -f .env ]; then
        echo "📝 Création du fichier .env..."
        cp .env.example .env
    fi
fi

# Générer la clé d'application si elle n'existe pas
if [ -z "$(grep '^APP_KEY=' .env)" ] || [ "$(grep '^APP_KEY=' .env | cut -d= -f2)" = "" ]; then
    echo "🔑 Génération de la clé d'application..."
    php artisan key:generate --force
fi

# Installer les dépendances Node.js
echo "📦 Installation des dépendances Node.js..."
npm install --production --no-audit --no-fund

# Construire les assets
echo "⚡ Construction des assets..."
npm run build

# Nettoyer le cache
echo "🧹 Nettoyage du cache..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Migrations et seeding (en production, seulement si spécifié)
if [ "${RUN_MIGRATIONS}" = "true" ] || [ "${RENDER}" != "true" ]; then
    echo "🗄️  Exécution des migrations..."
    php artisan migrate --force
fi

# Optimiser l'application (production seulement)
if [ "${APP_ENV:-production}" = "production" ]; then
    echo "⚡ Optimisation pour la production..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
fi

# Définir les permissions
echo "🔒 Configuration des permissions..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache public

echo "✅ Déploiement terminé avec succès !"