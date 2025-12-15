#!/bin/bash
set -e

echo "🚀 Laravel deployment starting (Render-compatible)..."

# Sanity check
php -v
composer -V

# Clear any stale cache (safe)
echo "🧹 Clearing old caches..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Storage permissions (light, safe)
echo "🔐 Fixing permissions..."
chmod -R 775 storage bootstrap/cache || true

# Only cache config if APP_ENV=production AND APP_KEY exists
if [ "$APP_ENV" = "production" ] && [ -n "$APP_KEY" ]; then

echo "📦 Découverte des packages..."
php artisan package:discover --ansi

    echo "⚡ Optimizing Laravel for production..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
else
    echo "⚠️ Skipping optimization (APP_ENV or APP_KEY missing)"
fi

echo "✅ Deployment finished. Starting Apache..."
exec apache2-foreground
