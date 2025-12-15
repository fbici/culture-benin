#!/bin/bash
set -e

echo "🚀 Laravel deployment starting (Render-compatible)..."

php -v
composer -V

echo "🧹 Clearing old caches..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

echo "🔐 Fixing permissions..."
chmod -R 775 storage bootstrap/cache || true

if [ "$APP_ENV" = "production" ] && [ -n "$APP_KEY" ]; then

    echo "📦 Discovering packages..."
    php artisan package:discover --ansi || echo "⚠️ package:discover skipped"

    echo "⚡ Optimizing Laravel..."
    php artisan config:cache
    php artisan route:cache || echo "⚠️ route:cache skipped"
    php artisan view:cache || echo "⚠️ view:cache skipped"

else
    echo "⚠️ Skipping optimization (APP_ENV or APP_KEY missing)"
fi

echo "✅ Deployment finished. Starting Apache..."
exec apache2-foreground
