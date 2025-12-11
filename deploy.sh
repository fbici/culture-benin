#!/bin/bash

echo "🚀 Démarrage du déploiement Laravel..."

# Vérifier les variables d'environnement
echo "📊 Configuration de l'environnement..."
echo "APP_ENV: ${APP_ENV}"
echo "RENDER: ${RENDER}"

# Créer le fichier .env si inexistant
if [ ! -f .env ]; then
    echo "📝 Création du fichier .env..."
    cp .env.example .env
fi

# Générer la clé d'application si elle n'existe pas
if [ -z "$(grep '^APP_KEY=' .env)" ] || [ "$(grep '^APP_KEY=' .env | cut -d= -f2)" = "" ]; then
    echo "🔑 Génération de la clé d'application..."
    php artisan key:generate --force
fi

# Nettoyer le cache
echo "🧹 Nettoyage du cache..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Installer les dépendances Node.js
echo "📦 Installation des dépendances Node.js..."
npm install --production --no-audit --no-fund

# Construire les assets
echo "⚡ Construction des assets..."
npm run build

# Import de la base de données culture.sql
echo "🗄️  Import de la base de données..."
if [ -f "culture.sql" ]; then
    echo "📂 Fichier culture.sql trouvé, tentative d'import..."
    
    # Vérifier si la base de données existe
    DB_HOST=$(grep 'DB_HOST=' .env | cut -d= -f2)
    DB_PORT=$(grep 'DB_PORT=' .env | cut -d= -f2)
    DB_DATABASE=$(grep 'DB_DATABASE=' .env | cut -d= -f2)
    DB_USERNAME=$(grep 'DB_USERNAME=' .env | cut -d= -f2)
    DB_PASSWORD=$(grep 'DB_PASSWORD=' .env | cut -d= -f2)
    
    if [ -n "$DB_HOST" ] && [ -n "$DB_DATABASE" ] && [ -n "$DB_USERNAME" ]; then
        echo "🔗 Connexion à la base de données: $DB_HOST/$DB_DATABASE"
        
        # Tester la connexion MySQL
        if command -v mysql &> /dev/null; then
            # Essayer d'importer le fichier SQL
            echo "📤 Import du fichier culture.sql..."
            mysql --host="$DB_HOST" --port="${DB_PORT:-3306}" --user="$DB_USERNAME" --password="$DB_PASSWORD" "$DB_DATABASE" < culture.sql
            
            if [ $? -eq 0 ]; then
                echo "✅ Base de données importée avec succès!"
            else
                echo "⚠️  Échec de l'import, utilisation des migrations Laravel..."
                php artisan migrate --force
            fi
        else
            echo "⚠️  Client MySQL non disponible, utilisation des migrations..."
            php artisan migrate --force
        fi
    else
        echo "⚠️  Variables DB non configurées, utilisation des migrations..."
        php artisan migrate --force
    fi
else
    echo "📂 Fichier culture.sql non trouvé, utilisation des migrations..."
    php artisan migrate --force
fi

# Créer le lien symbolique pour le stockage
echo "🔗 Création du lien de stockage..."
php artisan storage:link

# Optimiser l'application (production seulement)
if [ "${APP_ENV:-production}" = "production" ]; then
    echo "⚡ Optimisation pour la production..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
fi

echo "✅ Déploiement terminé avec succès !"