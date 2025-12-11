#!/bin/bash

echo "🚀 Exécution du script de démarrage..."

# Créer .env si inexistant
if [ ! -f .env ]; then
    echo "📝 Création du fichier .env..."
    cp .env.example .env
fi

# Générer la clé d'application si vide
if ! grep -q '^APP_KEY=base64:' .env; then
    echo "🔑 Génération de la clé d'application..."
    php artisan key:generate --force
fi

# Nettoyer le cache
echo "🧹 Nettoyage du cache..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Créer le lien de stockage
echo "🔗 Création du lien de stockage..."
php artisan storage:link || true

# Optimiser pour la production
echo "⚙️  Optimisation pour la production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Application prête !"